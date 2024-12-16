<?php

namespace App\Http\Controllers;

use App\Jobs\ContactFormJob;
use App\Mail\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{

    public function contact()
    {
        return view('contact');
    }

    public function send(Request $request)
    {
        $data = $request->validate([
            'name' => ['required'],
            'email' => ['required', 'email'],
            'message' => ['required'],
        ]);

//        Mail::to(env('MAIL_ADMIN_EMAIL'))->send(new Contact($data));
        ContactFormJob::dispatch($data);

        return redirect()->route('contact')->with('success', 'Спасибо! Письмо отправлено.');
    }

}
