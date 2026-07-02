<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AzkarCategory;
use App\Models\Azkar;
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AzkarController extends Controller
{
    public function index(Request $request)
    {
        $query = Azkar::with('category');

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where('arabic_text', 'like', "%{$search}%")
                  ->orWhere('english_translation', 'like', "%{$search}%")
                  ->orWhere('urdu_translation', 'like', "%{$search}%")
                  ->orWhere('reference', 'like', "%{$search}%");
        }

        if ($request->filled('category_id')) {
            $query->where('category_id', $request->input('category_id'));
        }

        $azkars = $query->latest()->paginate(15)->withQueryString();
        $categories = AzkarCategory::all();

        return view('admin.azkar.index', compact('azkars', 'categories'));
    }

    public function create()
    {
        $categories = AzkarCategory::all();
        return view('admin.azkar.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'category_id' => 'required|exists:azkar_categories,id',
            'arabic_text' => 'required|string',
            'urdu_translation' => 'nullable|string',
            'english_translation' => 'nullable|string',
            'reference' => 'nullable|string|max:255',
            'benefits' => 'nullable|string',
            'repeat_count' => 'required|integer|min:1',
            'is_featured' => 'boolean',
            'audio_file' => 'nullable|file|mimes:mp3,wav|max:5000',
        ]);

        $data['is_featured'] = $request->has('is_featured');

        if ($request->hasFile('audio_file')) {
            $path = $request->file('audio_file')->store('azkar_audio', 'public');
            $data['audio_path'] = $path;
        }

        $azkar = Azkar::create($data);

        ActivityLog::create([
            'user_id' => auth()->id(),
            'action' => 'create',
            'module' => 'azkar',
            'description' => "Added Azkar ID {$azkar->id}.",
        ]);

        return redirect()->route('admin.azkar.index')->with('success', 'Azkar item added successfully.');
    }

    public function edit(Azkar $azkar)
    {
        $categories = AzkarCategory::all();
        return view('admin.azkar.edit', compact('azkar', 'categories'));
    }

    public function update(Request $request, Azkar $azkar)
    {
        $data = $request->validate([
            'category_id' => 'required|exists:azkar_categories,id',
            'arabic_text' => 'required|string',
            'urdu_translation' => 'nullable|string',
            'english_translation' => 'nullable|string',
            'reference' => 'nullable|string|max:255',
            'benefits' => 'nullable|string',
            'repeat_count' => 'required|integer|min:1',
            'is_featured' => 'boolean',
            'audio_file' => 'nullable|file|mimes:mp3,wav|max:5000',
        ]);

        $data['is_featured'] = $request->has('is_featured');

        if ($request->hasFile('audio_file')) {
            $path = $request->file('audio_file')->store('azkar_audio', 'public');
            $data['audio_path'] = $path;
        }

        $azkar->update($data);

        ActivityLog::create([
            'user_id' => auth()->id(),
            'action' => 'update',
            'module' => 'azkar',
            'description' => "Updated Azkar ID {$azkar->id}.",
        ]);

        return redirect()->route('admin.azkar.index')->with('success', 'Azkar item updated successfully.');
    }

    public function destroy(Azkar $azkar)
    {
        $id = $azkar->id;
        $azkar->delete();

        ActivityLog::create([
            'user_id' => auth()->id(),
            'action' => 'delete',
            'module' => 'azkar',
            'description' => "Deleted Azkar ID {$id}.",
        ]);

        return redirect()->route('admin.azkar.index')->with('success', 'Azkar item deleted successfully.');
    }

    // Category methods
    public function categories()
    {
        $categories = AzkarCategory::orderBy('order')->get();
        return view('admin.azkar.categories', compact('categories'));
    }

    public function storeCategory(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|in:morning,evening,prayer,general',
            'icon' => 'nullable|string|max:10',
            'order' => 'nullable|integer',
        ]);

        $data['slug'] = Str::slug($data['name']);
        $data['order'] = $data['order'] ?? 0;

        AzkarCategory::create($data);

        return back()->with('success', 'Azkar Category created.');
    }

    public function updateCategory(Request $request, AzkarCategory $category)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|in:morning,evening,prayer,general',
            'icon' => 'nullable|string|max:10',
            'order' => 'nullable|integer',
        ]);

        $data['slug'] = Str::slug($data['name']);
        $data['order'] = $data['order'] ?? 0;

        $category->update($data);

        return back()->with('success', 'Azkar Category updated.');
    }

    public function destroyCategory(AzkarCategory $category)
    {
        $category->delete();
        return back()->with('success', 'Azkar Category deleted.');
    }
}
