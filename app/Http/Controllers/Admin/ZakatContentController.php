<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ZakatRule;
use App\Models\NisabValue;
use App\Models\ZakatFaq;
use App\Models\ActivityLog;
use Illuminate\Http\Request;

class ZakatContentController extends Controller
{
    public function index()
    {
        $rules = ZakatRule::orderBy('order')->get();
        $nisabs = NisabValue::all();
        $faqs = ZakatFaq::orderBy('order')->get();

        return view('admin.zakat.index', compact('rules', 'nisabs', 'faqs'));
    }

    public function updateRule(Request $request, ZakatRule $rule)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'islamic_references' => 'nullable|string',
            'scholarly_explanations' => 'nullable|string',
            'order' => 'required|integer',
            'is_active' => 'boolean',
        ]);

        $data['is_active'] = $request->has('is_active');
        $oldValues = $rule->only(['title', 'content', 'islamic_references', 'scholarly_explanations', 'order', 'is_active']);
        $rule->update($data);

        ActivityLog::create([
            'user_id' => auth()->id(),
            'action' => 'update',
            'module' => 'zakat_rules',
            'description' => "Updated Zakat rule for {$rule->asset_type}.",
            'old_values' => $oldValues,
            'new_values' => $data,
        ]);

        return back()->with('success', 'Zakat rule updated successfully.');
    }

    public function updateNisab(Request $request, NisabValue $nisab)
    {
        $data = $request->validate([
            'weight_grams' => 'required|numeric|min:0.01',
            'value_pkr' => 'required|numeric|min:1',
        ]);

        $data['updated_by'] = auth()->user()->name;
        $oldValues = $nisab->only(['weight_grams', 'value_pkr', 'updated_by']);
        
        $nisab->update($data);

        ActivityLog::create([
            'user_id' => auth()->id(),
            'action' => 'update',
            'module' => 'nisab_values',
            'description' => "Updated Nisab value for {$nisab->type}.",
            'old_values' => $oldValues,
            'new_values' => $data,
        ]);

        return back()->with('success', 'Nisab values updated successfully.');
    }

    public function storeFaq(Request $request)
    {
        $data = $request->validate([
            'question' => 'required|string|max:255',
            'answer' => 'required|string',
            'category' => 'required|string|max:100',
            'order' => 'nullable|integer',
        ]);

        $data['order'] = $data['order'] ?? 0;
        $faq = ZakatFaq::create($data);

        ActivityLog::create([
            'user_id' => auth()->id(),
            'action' => 'create',
            'module' => 'zakat_faqs',
            'description' => "Created Zakat FAQ ID {$faq->id}.",
        ]);

        return back()->with('success', 'Zakat FAQ added successfully.');
    }

    public function updateFaq(Request $request, ZakatFaq $faq)
    {
        $data = $request->validate([
            'question' => 'required|string|max:255',
            'answer' => 'required|string',
            'category' => 'required|string|max:100',
            'order' => 'required|integer',
            'is_active' => 'boolean',
        ]);

        $data['is_active'] = $request->has('is_active');
        $faq->update($data);

        ActivityLog::create([
            'user_id' => auth()->id(),
            'action' => 'update',
            'module' => 'zakat_faqs',
            'description' => "Updated Zakat FAQ ID {$faq->id}.",
        ]);

        return back()->with('success', 'Zakat FAQ updated.');
    }

    public function destroyFaq(ZakatFaq $faq)
    {
        $id = $faq->id;
        $faq->delete();

        ActivityLog::create([
            'user_id' => auth()->id(),
            'action' => 'delete',
            'module' => 'zakat_faqs',
            'description' => "Deleted Zakat FAQ ID {$id}.",
        ]);

        return back()->with('success', 'Zakat FAQ deleted successfully.');
    }
}
