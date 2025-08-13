<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function home()
    {
        return view('frontend.index'); // halaman utama kamu
    }

    public function section($slug)
    {
        return view('frontend.index', compact('slug'));
    }
}
