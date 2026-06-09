<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    public function index()
    {
        $faqs = Faq::orderBy('order')->get();
        return view('admin.faqs.index', compact('faqs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'question' => 'required|string|max:500',
            'answer'   => 'required|string',
        ]);
        Faq::create([
            'question' => $request->question,
            'answer'   => $request->answer,
            'order'    => $request->order ?? 0,
            'status'   => $request->boolean('status', true),
        ]);
        return back()->with('success', 'SSS eklendi.');
    }

    public function update(Request $request, Faq $faq)
    {
        $request->validate([
            'question' => 'required|string|max:500',
            'answer'   => 'required|string',
        ]);
        $faq->update([
            'question' => $request->question,
            'answer'   => $request->answer,
            'order'    => $request->order ?? 0,
            'status'   => $request->boolean('status', true),
        ]);
        return back()->with('success', 'SSS güncellendi.');
    }

    public function destroy(Faq $faq)
    {
        $faq->delete();
        return back()->with('success', 'SSS silindi.');
    }
}
