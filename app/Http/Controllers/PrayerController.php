<?php

namespace App\Http\Controllers;

use App\Models\DailyPrayerTiming;
use App\Models\PrayerLocation;
use App\Models\PrayerLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Arr;

class PrayerController extends Controller
{
    public function timings(Request $request)
    {
        $latitude = $request->query('latitude');
        $longitude = $request->query('longitude');
        $city = $request->query('city');
        $country = $request->query('country');
        $timezone = $request->query('timezone') ?: config('app.timezone', 'UTC');

        if (!$latitude || !$longitude) {
            if ($city && $country) {
                return $this->timingsByCity($city, $country, $timezone);
            }

            $detected = $this->detectLocationFromIp($request->ip());
            if (!$detected) {
                return response()->json(['success' => false, 'message' => 'Unable to detect location from IP.'], 422);
            }

            $latitude = $detected['latitude'];
            $longitude = $detected['longitude'];
            $city = $detected['city'];
            $country = $detected['country'];
            $timezone = $detected['timezone'];
        }

        return $this->timingsByLocation($latitude, $longitude, $timezone, $city, $country);
    }

    public function logs(Request $request)
    {
        $query = PrayerLog::query();
        if (Auth::check()) {
            $query->where('user_id', Auth::id());
        }

        $logs = $query->whereDate('date', now()->toDateString())
            ->orderBy('prayer_name')
            ->get();

        return response()->json(['success' => true, 'logs' => $logs]);
    }

    public function saveLocation(Request $request)
    {
        $payload = $request->validate([
            'city' => 'required|string|max:100',
            'country' => 'required|string|max:100',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
            'timezone' => 'nullable|string|max:100',
        ]);

        $location = PrayerLocation::updateOrCreate(
            ['user_id' => Auth::id()],
            array_merge($payload, ['preferred' => true])
        );

        return response()->json(['success' => true, 'location' => $location]);
    }

    public function storePrayerLog(Request $request)
    {
        $payload = $request->validate([
            'prayer_name' => 'required|string|in:Fajr,Sunrise,Dhuhr,Asr,Maghrib,Isha',
            'status' => 'required|string|in:prayed,jamaat,late,qaza',
            'city' => 'nullable|string|max:100',
            'country' => 'nullable|string|max:100',
            'timezone' => 'nullable|string|max:100',
            'logged_at' => 'nullable|date',
        ]);

        $log = PrayerLog::create([
            'user_id' => Auth::id(),
            'prayer_name' => $payload['prayer_name'],
            'status' => $payload['status'],
            'date' => now()->toDateString(),
            'logged_at' => $payload['logged_at'] ?? now(),
            'city' => $payload['city'] ?? null,
            'country' => $payload['country'] ?? null,
            'timezone' => $payload['timezone'] ?? config('app.timezone'),
            'meta' => ['submitted_at' => now()->toDateTimeString()],
        ]);

        return response()->json(['success' => true, 'log' => $log]);
    }

    protected function timingsByLocation($latitude, $longitude, $timezone, $city = null, $country = null)
    {
        $timestamp = now()->timestamp;
        $response = Http::timeout(12)->get('https://api.aladhan.com/v1/timings/'.$timestamp, [
            'latitude' => $latitude,
            'longitude' => $longitude,
            'method' => 2,
            'timezonestring' => $timezone,
            'school' => 0,
            'adjustment' => 0,
        ]);

        if (!$response->successful() || $response->json('code') !== 200) {
            return response()->json(['success' => false, 'message' => 'Failed to fetch prayer timings.'], 500);
        }

        $data = $response->json('data');
        $date = $data['date'] ?? [];
        $timings = Arr::only($data['timings'] ?? [], ['Fajr', 'Sunrise', 'Dhuhr', 'Asr', 'Maghrib', 'Isha']);

        $payload = [
            'success' => true,
            'timings' => $this->normalizeTimings($timings),
            'date' => [
                'gregorian' => ($date['gregorian']['weekday']['en'] ?? '') . ', ' . ($date['gregorian']['date'] ?? ''),
                'hijri' => ($date['hijri']['day'] ?? '') . ' ' . ($date['hijri']['month']['en'] ?? '') . ' ' . ($date['hijri']['year'] ?? '') . ' AH',
                'gregorian_date' => $date['gregorian']['date'] ?? '',
                'hijri_date' => $date['hijri']['date'] ?? '',
            ],
            'location' => [
                'city' => $city ?: ($data['meta']['timezone'] ?? ''),
                'country' => $country ?: '',
                'latitude' => $latitude,
                'longitude' => $longitude,
                'timezone' => $timezone,
                'method' => [
                    'id' => 2,
                    'name' => $data['meta']['method']['name'] ?? 'Islamic Society of North America (ISNA)',
                ],
            ],
            'meta' => [
                'timezone' => $timezone,
                'timestamp' => $timestamp,
            ],
        ];

        $this->storeTimingCache($payload);

        return response()->json($payload);
    }

    protected function timingsByCity($city, $country, $timezone)
    {
        $response = Http::timeout(12)->get('https://api.aladhan.com/v1/timingsByCity', [
            'city' => $city,
            'country' => $country,
            'method' => 2,
            'timezonestring' => $timezone,
            'school' => 0,
        ]);

        if (!$response->successful() || $response->json('code') !== 200) {
            return response()->json(['success' => false, 'message' => 'Unable to fetch prayer timings for the requested city.'], 500);
        }

        $data = $response->json('data');
        $timings = Arr::only($data['timings'] ?? [], ['Fajr', 'Sunrise', 'Dhuhr', 'Asr', 'Maghrib', 'Isha']);

        $payload = [
            'success' => true,
            'timings' => $this->normalizeTimings($timings),
            'date' => [
                'gregorian' => ($data['date']['gregorian']['weekday']['en'] ?? '') . ', ' . ($data['date']['gregorian']['date'] ?? ''),
                'hijri' => ($data['date']['hijri']['day'] ?? '') . ' ' . ($data['date']['hijri']['month']['en'] ?? '') . ' ' . ($data['date']['hijri']['year'] ?? '') . ' AH',
                'gregorian_date' => $data['date']['gregorian']['date'] ?? '',
                'hijri_date' => $data['date']['hijri']['date'] ?? '',
            ],
            'location' => [
                'city' => $city,
                'country' => $country,
                'latitude' => $data['meta']['latitude'] ?? null,
                'longitude' => $data['meta']['longitude'] ?? null,
                'timezone' => $timezone,
                'method' => [
                    'id' => 2,
                    'name' => $data['meta']['method']['name'] ?? 'Islamic Society of North America (ISNA)',
                ],
            ],
            'meta' => [
                'timezone' => $timezone,
                'timestamp' => now()->timestamp,
            ],
        ];

        $this->storeTimingCache($payload);

        return response()->json($payload);
    }

    protected function detectLocationFromIp(string $ip): ?array
    {
        $response = Http::timeout(8)->get('https://ip-api.com/json/'.$ip, [
            'fields' => 'status,country,city,lat,lon,timezone',
        ]);

        if (!$response->successful() || $response->json('status') !== 'success') {
            return null;
        }

        return [
            'country' => $response->json('country'),
            'city' => $response->json('city'),
            'latitude' => $response->json('lat'),
            'longitude' => $response->json('lon'),
            'timezone' => $response->json('timezone') ?: config('app.timezone', 'UTC'),
        ];
    }

    protected function storeTimingCache(array $payload): void
    {
        DailyPrayerTiming::updateOrCreate(
            [
                'date' => now()->toDateString(),
                'city' => $payload['location']['city'] ?? null,
                'country' => $payload['location']['country'] ?? null,
                'timezone' => $payload['location']['timezone'] ?? null,
            ],
            [
                'date' => now()->toDateString(),
                'city' => $payload['location']['city'] ?? null,
                'country' => $payload['location']['country'] ?? null,
                'latitude' => $payload['location']['latitude'] ?? null,
                'longitude' => $payload['location']['longitude'] ?? null,
                'timezone' => $payload['location']['timezone'] ?? null,
                'method' => $payload['location']['method']['name'] ?? null,
                'timings' => $payload['timings'],
                'meta' => $payload['meta'],
            ]
        );
    }

    protected function normalizeTimings(array $timings): array
    {
        return array_map(fn ($time) => trim(preg_replace('/\s+/', '', $time)), $timings);
    }
}
