<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class InfoController extends Controller
{
    // public function privacyPolicy()
    // {
    //     return view('privacy-policy');
    // }

    // public function termsOfService()
    // {
    //     return view('terms-of-service');
    // }

    public function about()
    {
        return view('about');
    }

    public function contactForm()
    {
        return view('contact');
    }

    public function submitContact(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string',
        ]);

        // Store the contact form data in the database
        $submission = Contact::create($validated);

        // Send the contact email
        // Mail::to('your-email@example.com')->send(new ContactMail($validated));

        if ($submission) {
            return back()->with('success', 'Your message has been sent successfully.');
        }else{
            return back()->with('error', 'Something went wrong. Please try again.');
        }
      
    }

    public function show_contact_submissions()
    {
        $submissions = Contact::latest()->paginate(10);
        return view('contact-submissions', compact('submissions'));
    }
}
