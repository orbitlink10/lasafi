<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Review;
use App\Models\Service;

class HomeController extends Controller
{
    public function __invoke()
    {
        return view('home', [
            'categories' => Category::where('is_active', true)->with('services')->take(10)->get(),
            'popularServices' => Service::where('is_active', true)->with('category')->take(6)->get(),
            'testimonials' => Review::with(['customer', 'provider'])->latest()->take(3)->get(),
        ]);
    }
}
