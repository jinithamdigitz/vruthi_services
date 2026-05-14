<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Enquiry;


class EnquiryAdminController extends Controller
{

   public function index(Request $request)
    {
        $query = Enquiry::query();

        if ($request->filled('name')) {
            $query->where('name', 'like', '%' . $request->name . '%');
        }

        if ($request->filled('contact_number')) {
            $query->where('contact_number', 'like', '%' . $request->contact_number . '%');
        }

        if ($request->filled('location')) {
            $query->where('location', 'like', '%' . $request->location . '%');
        }

        $query->orderBy('created_at', 'desc');
        
        $enquiries = $query->paginate(10);

        return view('admin.enquiry.index', compact('enquiries'));
    }

    // VIEW SINGLE ENQUIRY
    public function show($id)
    {
        $enquiry = Enquiry::findOrFail($id);

        return view('admin.enquiry.show', compact('enquiry'));
    }


    // EDIT PAGE
    public function edit($id)
    {
        $enquiry = Enquiry::findOrFail($id);

        return view('admin.enquiry.edit', compact('enquiry'));
    }


    // UPDATE DATA
    public function update(Request $request, $id)
    {

        $enquiry = Enquiry::findOrFail($id);

        $enquiry->update($request->all());

        return redirect()->route('admin.enquiry.index')
        ->with('success', 'Updated successfully');
    }


    // DELETE DATA
    public function destroy($id)
    {
        Enquiry::findOrFail($id)->delete();

        return redirect()->back()
        ->with('success', 'Deleted successfully');
    }

}