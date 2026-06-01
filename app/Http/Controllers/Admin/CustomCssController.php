<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CustomCss;


class CustomCssController extends Controller
{
    public function index()
    {
        $customCss = CustomCss::latest()->get();

        return view(
            'admin.custom-css.index',
            compact('customCss')
        );
    }

    public function create()
    {
        return view('admin.custom-css.create');
    }

    public function store(Request $request)
    {
        $request->validate([

            'content_css' => 'nullable',

        ]);

        CustomCss::create([

            'content_css' =>
                $request->content_css,

        ]);

        return redirect()
            ->route('admin.custom-css.index')
            ->with(
                'success',
                'Custom CSS created successfully.'
            );
    }

    public function edit($id)
    {
        $customCss = CustomCss::findOrFail($id);

        return view(
            'admin.custom-css.edit',
            compact('customCss')
        );
    }

    public function update(
        Request $request,
        $id
    ) {

        $customCss = CustomCss::findOrFail($id);

        $customCss->update([

            'content_css' =>
                $request->content_css,

        ]);

        return redirect()
            ->route('admin.custom-css.index')
            ->with(
                'success',
                'Custom CSS updated successfully.'
            );
    }

    public function destroy($id)
    {
        $customCss = CustomCss::findOrFail($id);

        $customCss->delete();

        return back()->with(
            'success',
            'Custom CSS deleted successfully.'
        );
    }
}