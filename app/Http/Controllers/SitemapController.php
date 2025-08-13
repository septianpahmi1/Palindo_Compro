<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Sitemap\SitemapGenerator;

class SitemapController extends Controller
{
    public function generate()
    {
        SitemapGenerator::create(config('app.url'))
            ->writeToFile(public_path('sitemap.xml'));

        return response()->json(['message' => 'Sitemap generated'], 200);
    }
    
    public function index()
    {
        $pages = [
            ['', '2025-07-30', '1.00'],
            ['about', '2025-07-30', '0.90'],
            ['services', '2025-07-30', '0.90'],
            ['consultation', '2025-07-30', '0.80'],
            ['track', '2025-07-30', '0.80']
        ];

        $xml = view('sitemap', compact('pages'));

        return response($xml, 200)
                ->header('Content-Type', 'application/xml');
    }
}
