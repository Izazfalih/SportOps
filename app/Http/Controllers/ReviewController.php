<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string',
        ]);

        Review::create([
            'user_id' => Auth::id(),
            'name' => Auth::user()->name,
            'role' => 'Customer',
            'comment' => $request->comment,
            'rating' => $request->rating,
        ]);

        return back()->with('success', 'Thank you for your review!');
    }
}
