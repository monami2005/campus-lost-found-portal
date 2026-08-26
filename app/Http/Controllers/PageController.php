<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Contact;
use App\Models\ActivityLog;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function home()
    {
        try {
            $featuredItems = Item::with('category')->latest()->take(6)->get();
        } catch (\Throwable $e) {
            $featuredItems = collect();
        }

        return view('welcome', compact('featuredItems'));
    }

    public function about()
    {
        return view('about');
    }

    public function contact()
    {
        return view('contact');
    }

    public function contactSubmit(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string|max:2000',
        ]);

        Contact::create($validated);
        
        ActivityLog::log('Submitted contact message: ' . $validated['email']);

        return back()->with('success', 'Your contact message was successfully submitted to the campus team.');
    }

    public function faq()
    {
        return view('faq');
    }

    public function privacy()
    {
        return view('privacy');
    }

    public function terms()
    {
        return view('terms');
    }
}
