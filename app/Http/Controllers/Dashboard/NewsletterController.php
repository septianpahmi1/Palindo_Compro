<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Newslatter;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use App\Mail\NewsletterSubscribedHTML;

class NewsletterController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:newslatters,email',
            'name'  => 'nullable|string|max:255'
        ]);

        if (Newslatter::where('email', $request->email)->exists()) {
            return redirect('/#footer')->with('error', 'Email address is already subscribed!');
        }
        $newslatter = Newslatter::create($request->only('name', 'email'));

        Mail::to($newslatter->email)->send(new NewsletterSubscribedHTML($newslatter));

        return redirect('/')->with('success', 'Successfully subscribed to the newsletter!');
    }
}
