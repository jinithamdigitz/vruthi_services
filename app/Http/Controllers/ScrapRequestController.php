<?php

namespace App\Http\Controllers;

use App\Models\ScrapRequest;
use App\Mail\ScrapRequestMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;

class ScrapRequestController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'full_name'   => 'required|string|max:255',
            'phone'       => 'required|string|max:20',
            'email'       => 'nullable|email|max:255',
            'location'    => 'required|string|max:255',
            'scrap_type'  => 'required|array',
            'scrap_type.*' => 'string|max:255',
            'details'     => 'nullable|string',
            'captcha' => 'required',

        ]);

        if ($request->captcha !== session('scrap_captcha')) {

            return back()->withErrors([
                'captcha' => 'Invalid captcha'
            ])->withInput();
        }

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Save to database
        $scrapRequest = ScrapRequest::create([
            'full_name'  => $request->full_name,
            'phone'      => $request->phone,
            'email'      => $request->email,
            'location'   => $request->location,
            'scrap_type' => json_encode($request->scrap_type),
            'details'    => $request->details,
        ]);

        session()->forget('scrap_captcha');
        // Send email to admin
        Mail::to(config('mail.admin_email'))->send(new ScrapRequestMail($scrapRequest));

        return redirect()->back()->with('success', 'We will contact you soon!');
    }
}
