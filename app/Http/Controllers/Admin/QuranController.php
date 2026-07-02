<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\QuranTopic;
use App\Models\QuranVerse;
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class QuranController extends Controller
{
    public function index(Request $request)
    {
        $query = QuranVerse::with('topic');

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where('arabic_text', 'like', "%{$search}%")
                  ->orWhere('english_translation', 'like', "%{$search}%")
                  ->orWhere('urdu_translation', 'like', "%{$search}%")
                  ->orWhere('surah_name', 'like', "%{$search}%");
        }

        if ($request->filled('topic_id')) {
            $query->where('topic_id', $request->input('topic_id'));
        }

        $verses = $query->latest()->paginate(15)->withQueryString();
        $topics = QuranTopic::all();

        return view('admin.quran.index', compact('verses', 'topics'));
    }

    public function create()
    {
        $topics = QuranTopic::all();
        return view('admin.quran.create', compact('topics'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'topic_id' => 'required|exists:quran_topics,id',
            'surah_name' => 'required|string|max:100',
            'surah_number' => 'required|integer|min:1|max:114',
            'ayah_number' => 'required|integer|min:1|max:286',
            'arabic_text' => 'required|string',
            'urdu_translation' => 'nullable|string',
            'english_translation' => 'required|string',
            'reflection' => 'nullable|string',
            'is_featured' => 'boolean',
        ]);

        $data['is_featured'] = $request->has('is_featured');
        $verse = QuranVerse::create($data);

        ActivityLog::create([
            'user_id' => auth()->id(),
            'action' => 'create',
            'module' => 'quran',
            'description' => "Added Quran Verse: {$verse->surah_name} ({$verse->surah_number}:{$verse->ayah_number}).",
        ]);

        return redirect()->route('admin.quran.index')->with('success', 'Quranic Verse added successfully.');
    }

    public function edit(QuranVerse $verse)
    {
        $topics = QuranTopic::all();
        return view('admin.quran.edit', compact('verse', 'topics'));
    }

    public function update(Request $request, QuranVerse $verse)
    {
        $data = $request->validate([
            'topic_id' => 'required|exists:quran_topics,id',
            'surah_name' => 'required|string|max:100',
            'surah_number' => 'required|integer|min:1|max:114',
            'ayah_number' => 'required|integer|min:1|max:286',
            'arabic_text' => 'required|string',
            'urdu_translation' => 'nullable|string',
            'english_translation' => 'required|string',
            'reflection' => 'nullable|string',
            'is_featured' => 'boolean',
        ]);

        $data['is_featured'] = $request->has('is_featured');
        $verse->update($data);

        ActivityLog::create([
            'user_id' => auth()->id(),
            'action' => 'update',
            'module' => 'quran',
            'description' => "Updated Quran Verse: {$verse->surah_name} ({$verse->surah_number}:{$verse->ayah_number}).",
        ]);

        return redirect()->route('admin.quran.index')->with('success', 'Quranic Verse updated successfully.');
    }

    public function destroy(QuranVerse $verse)
    {
        $ref = "{$verse->surah_name} ({$verse->surah_number}:{$verse->ayah_number})";
        $verse->delete();

        ActivityLog::create([
            'user_id' => auth()->id(),
            'action' => 'delete',
            'module' => 'quran',
            'description' => "Deleted Quran Verse: {$ref}.",
        ]);

        return redirect()->route('admin.quran.index')->with('success', 'Quranic Verse deleted.');
    }

    // Topics methods
    public function topics()
    {
        $topics = QuranTopic::all();
        return view('admin.quran.topics', compact('topics'));
    }

    public function storeTopic(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $data['slug'] = Str::slug($data['name']);
        QuranTopic::create($data);

        return back()->with('success', 'Quran Topic created successfully.');
    }

    public function updateTopic(Request $request, QuranTopic $topic)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $data['slug'] = Str::slug($data['name']);
        $topic->update($data);

        return back()->with('success', 'Quran Topic updated.');
    }

    public function destroyTopic(QuranTopic $topic)
    {
        $topic->delete();
        return back()->with('success', 'Quran Topic deleted.');
    }
}
