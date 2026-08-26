<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ConfirmablePasswordController extends Controller
{
    public function show()
    {
        return view('auth.confirm-password');
    }

    public function store(Request $request)
    {
        if (!Auth::guard('web')->validate(['id' => $request->user()->getAuthIdentifier(), 'password' => $request->password])) {
            return back()->withErrors(['password' => 'The provided password was incorrect.']);
        }

        $request->session()->passwordConfirmed();
        return redirect()->intended();
    }
}
