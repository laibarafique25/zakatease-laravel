<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AiKnowledgeBase;
use App\Models\ActivityLog;
use Illuminate\Http\Request;

class AiKnowledgeController extends Controller
{
    public function index(Request $request)
    {
        $query = AiKnowledgeBase::query();

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where('question', 'like', "%{$search}%")
                  ->orWhere('answer', 'like', "%{$search}%")
                  ->orWhere('category', 'like', "%{$search}%");
        }

        $entries = $query->latest()->paginate(15)->withQueryString();

        return view('admin.ai.index', compact('entries'));
    }

    public function create()
    {
        return view('admin.ai.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'category' => 'required|string|max:100',
            'question' => 'required|string',
            'answer' => 'required|string',
            'islamic_reference' => 'nullable|string',
            'suggested_prompt' => 'nullable|string|max:255',
            'is_active' => 'boolean',
        ]);

        $data['is_active'] = $request->has('is_active');
        $item = AiKnowledgeBase::create($data);

        ActivityLog::create([
            'user_id' => auth()->id(),
            'action' => 'create',
            'module' => 'ai_knowledge',
            'description' => "Added AI Knowledge base entry ID {$item->id}.",
        ]);

        return redirect()->route('admin.ai.index')->with('success', 'AI Knowledge Base entry added successfully.');
    }

    public function edit(AiKnowledgeBase $ai)
    {
        return view('admin.ai.edit', compact('ai'));
    }

    public function update(Request $request, AiKnowledgeBase $ai)
    {
        $data = $request->validate([
            'category' => 'required|string|max:100',
            'question' => 'required|string',
            'answer' => 'required|string',
            'islamic_reference' => 'nullable|string',
            'suggested_prompt' => 'nullable|string|max:255',
            'is_active' => 'boolean',
        ]);

        $data['is_active'] = $request->has('is_active');
        $ai->update($data);

        ActivityLog::create([
            'user_id' => auth()->id(),
            'action' => 'update',
            'module' => 'ai_knowledge',
            'description' => "Updated AI Knowledge base entry ID {$ai->id}.",
        ]);

        return redirect()->route('admin.ai.index')->with('success', 'AI Knowledge Base entry updated successfully.');
    }

    public function destroy(AiKnowledgeBase $ai)
    {
        $id = $ai->id;
        $ai->delete();

        ActivityLog::create([
            'user_id' => auth()->id(),
            'action' => 'delete',
            'module' => 'ai_knowledge',
            'description' => "Deleted AI Knowledge base entry ID {$id}.",
        ]);

        return redirect()->route('admin.ai.index')->with('success', 'AI Knowledge Base entry deleted.');
    }
}
