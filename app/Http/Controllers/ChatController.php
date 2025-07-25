<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;

class ChatController extends Controller
{
    public function respond(Request $request)
    {
        $message = strtolower($request->input('message'));

        if (str_contains($message, 'kitas')) {
            return response()->json(['reply' => 'We assist with KITAS applications and renewals.']);
        }

        if (str_contains($message, 'npwp')) {
            return response()->json(['reply' => 'We help register NPWP (Tax ID) for individuals and companies.']);
        }

        if (str_contains($message, 'visa')) {
            return response()->json(['reply' => 'We provide visa services: tourist, business, and more.']);
        }

        // default fallback
        return response()->json(['reply' => 'Sorry, I can only answer about PT Ghaleb services and profile.']);
    }

    public function send(Request $request)
    {
        // Validasi
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'subject' => 'nullable|string|max:255',
            'message' => 'required|string',
        ]);

        $message = Message::create($request->all());
        // return redirect('/#consul')
        return redirect('/#consultation')->with('success', 'Message sent successfully!');
    }
}
