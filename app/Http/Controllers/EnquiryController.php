<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Enquiry;
use App\Mail\EnquirySubmittedMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class EnquiryController extends Controller
{

    // STORE DATA with CAPTCHA validation
    public function store(Request $request)
    {
        // Validate all fields including CAPTCHA
        $request->validate([
            'name' => 'required|string|max:255',
            'contact_number' => 'required|string|max:20',
            'email' => 'email|max:255',
            'location' => 'nullable|string|max:255',
            'message' => 'nullable|string',
            'captcha' => 'string'
        ]);

        // VERIFY CAPTCHA
        $storedCaptcha = session('captcha_phrase');
        
        if (!$storedCaptcha || strtolower($request->captcha) !== strtolower($storedCaptcha)) {
            return back()
                ->withErrors(['captcha' => 'Invalid CAPTCHA code. Please try again.'])
                ->withInput();
        }

        // Clear CAPTCHA after successful validation
        session()->forget('captcha_phrase');

        // Create enquiry
        $enquiry = Enquiry::create($request->all());

        // Send email to admin
        try {
            Mail::to('jinithamdigitz02@gmail.com')->send(new EnquirySubmittedMail($enquiry));
        } catch (\Exception $e) {
            // Email failed but enquiry is saved
        }

        return back()->with('success', 'Enquiry submitted successfully!');
    }

    // VIEW ALL DATA
    public function index()
    {
        $enquiries = Enquiry::all();
        return view('enquiry-list', compact('enquiries'));
    }

    // DELETE
    public function destroy($id)
    {
        Enquiry::find($id)->delete();
        return back();
    }

    // EDIT PAGE
    public function edit($id)
    {
        $enquiry = Enquiry::find($id);
        return view('edit-enquiry', compact('enquiry'));
    }

    // UPDATE
    public function update(Request $request, $id)
    {
        Enquiry::find($id)->update($request->all());
        return redirect('/enquiry-list');
    }
}