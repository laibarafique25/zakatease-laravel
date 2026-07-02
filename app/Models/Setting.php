<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $table = 'settings';

    protected $fillable = [
        'key',
        'value',
        'group',
        'type',
        'label',
    ];

    public static function get($key, $default = null)
    {
        $setting = self::where('key', $key)->first();
        if (!$setting) return $default;

        if ($setting->type === 'boolean') {
            return filter_var($setting->value, FILTER_VALIDATE_BOOLEAN);
        }
        if ($setting->type === 'json') {
            return json_decode($setting->value, true);
        }
        return $setting->value;
    }

    public static function set($key, $value, $group = 'general', $type = 'text', $label = null)
    {
        $val = is_array($value) ? json_encode($value) : $value;
        return self::updateOrCreate(
            ['key' => $key],
            [
                'value' => $val,
                'group' => $group,
                'type' => $type,
                'label' => $label ?? ucwords(str_replace('_', ' ', $key))
            ]
        );
    }
}
