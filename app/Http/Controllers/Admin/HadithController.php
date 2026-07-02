<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HadithCategory;
use App\Models\Hadith;
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class HadithController extends Controller
{
    public function index(Request $request)
    {
        $query = Hadith::with('category');

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where('arabic_text', 'like', "%{$search}%")
                  ->orWhere('english_translation', 'like', "%{$search}%")
                  ->orWhere('urdu_translation', 'like', "%{$search}%")
                  ->orWhere('source', 'like', "%{$search}%");
        }

        if ($request->filled('category_id')) {
            $query->where('category_id', $request->input('category_id'));
        }

        if ($request->filled('grade')) {
            $query->where('grade', $request->input('grade'));
        }

        $hadiths = $query->latest()->paginate(15)->withQueryString();
        $categories = HadithCategory::all();

        return view('admin.hadith.index', compact('hadiths', 'categories'));
    }

    public function create()
    {
        $categories = HadithCategory::all();
        return view('admin.hadith.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'category_id' => 'required|exists:hadith_categories,id',
            'arabic_text' => 'required|string',
            'urdu_translation' => 'nullable|string',
            'english_translation' => 'required|string',
            'source' => 'nullable|string|max:255',
            'hadith_number' => 'nullable|string|max:50',
            'grade' => 'required|in:sahih,hasan,daif,unknown',
            'is_featured' => 'boolean',
        ]);

        $data['is_featured'] = $request->has('is_featured');
        $hadith = Hadith::create($data);

        ActivityLog::create([
            'user_id' => auth()->id(),
            'action' => 'create',
            'module' => 'hadiths',
            'description' => "Added Hadith number {$hadith->hadith_number} under source {$hadith->source}.",
        ]);

        return redirect()->route('admin.hadith.index')->with('success', 'Hadith added successfully.');
    }

    public function edit(Hadith $hadith)
    {
        $categories = HadithCategory::all();
        return view('admin.hadith.edit', compact('hadith', 'categories'));
    }

    public function update(Request $request, Hadith $hadith)
    {
        $data = $request->validate([
            'category_id' => 'required|exists:hadith_categories,id',
            'arabic_text' => 'required|string',
            'urdu_translation' => 'nullable|string',
            'english_translation' => 'required|string',
            'source' => 'nullable|string|max:255',
            'hadith_number' => 'nullable|string|max:50',
            'grade' => 'required|in:sahih,hasan,daif,unknown',
            'is_featured' => 'boolean',
        ]);

        $data['is_featured'] = $request->has('is_featured');
        $hadith->update($data);

        ActivityLog::create([
            'user_id' => auth()->id(),
            'action' => 'update',
            'module' => 'hadiths',
            'description' => "Updated Hadith ID {$hadith->id}.",
        ]);

        return redirect()->route('admin.hadith.index')->with('success', 'Hadith updated successfully.');
    }

    public function destroy(Hadith $hadith)
    {
        $id = $hadith->id;
        $hadith->delete();

        ActivityLog::create([
            'user_id' => auth()->id(),
            'action' => 'delete',
            'module' => 'hadiths',
            'description' => "Deleted Hadith ID {$id}.",
        ]);

        return redirect()->route('admin.hadith.index')->with('success', 'Hadith deleted successfully.');
    }

    // Hadith Category routes
    public function categories()
    {
        $categories = HadithCategory::orderBy('order')->get();
        return view('admin.hadith.categories', compact('categories'));
    }

    public function storeCategory(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'icon' => 'nullable|string|max:10',
            'order' => 'nullable|integer',
        ]);

        $data['slug'] = Str::slug($data['name']);
        $data['order'] = $data['order'] ?? 0;

        HadithCategory::create($data);

        return back()->with('success', 'Hadith Category created successfully.');
    }

    public function updateCategory(Request $request, HadithCategory $category)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'icon' => 'nullable|string|max:10',
            'order' => 'nullable|integer',
        ]);

        $data['slug'] = Str::slug($data['name']);
        $data['order'] = $data['order'] ?? 0;

        $category->update($data);

        return back()->with('success', 'Hadith Category updated successfully.');
    }

    public function destroyCategory(HadithCategory $category)
    {
        $category->delete();
        return back()->with('success', 'Hadith Category deleted successfully.');
    }
}
