<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CustomJavascript;

class CustomJavascriptController extends Controller
{
    public function index()
    {
        $customJavascript = CustomJavascript::latest()->get();

        return view(
            'admin.custom-javascript.index',
            compact('customJavascript')
        );
    }

    public function create()
    {
        return view('admin.custom-javascript.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'content_script' => 'nullable|string',
        ]);

        CustomJavascript::create([
            'content_script' => $request->content_script,
        ]);

        return redirect()
            ->route('admin.custom-javascript.index')
            ->with(
                'success',
                'Custom Javascript created successfully.'
            );
    }

    public function edit($id)
    {
        $customJavascript = CustomJavascript::findOrFail($id);

        return view(
            'admin.custom-javascript.edit',
            compact('customJavascript')
        );
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'content_script' => 'nullable|string',
        ]);

        $customJavascript = CustomJavascript::findOrFail($id);

        $customJavascript->update([
            'content_script' => $request->content_script,
        ]);

        return redirect()
            ->route('admin.custom-javascript.index')
            ->with(
                'success',
                'Custom Javascript updated successfully.'
            );
    }

    public function destroy($id)
    {
        $customJavascript = CustomJavascript::findOrFail($id);

        $customJavascript->delete();

        return redirect()
            ->route('admin.custom-javascript.index')
            ->with(
                'success',
                'Custom Javascript deleted successfully.'
            );
    }
}