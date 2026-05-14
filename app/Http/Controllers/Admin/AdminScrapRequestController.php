<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ScrapRequest;
use Illuminate\Http\Request;

class AdminScrapRequestController extends Controller
{

    // SHOW ALL SCRAP REQUESTS
    public function index()
    {

        $requests = ScrapRequest::latest()->paginate(10);

        return view('admin.scrap_requests.index', compact('requests'));
    }



    // DELETE SCRAP REQUEST
    public function destroy($id)
    {

        $request = ScrapRequest::findOrFail($id);

        $request->delete();

        return redirect()->back()
            ->with('success', 'Scrap Request Deleted Successfully');
    }

    
    public function show($id)
    {

        $request = ScrapRequest::findOrFail($id);

        return view('admin.scrap_requests.show', compact('request'));
    }
}
