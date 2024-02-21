<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class SessionsController extends Controller
{
    public function create()
    {
        return view('session.create');
    }

    public function store()
    {
        $attributes = request()->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if(!auth()->attempt($attributes))
        {
            // return back()->withErrors(['email' => 'Invalid email or password']);
            throw ValidationException::withMessages(['email' => 'Invalid email or password']);
        }
        session()->regenerate();
        return redirect('/')->with('success', 'Welcome back!');

    }

    public function destroy()
    {
        auth()->logout();
        return redirect('/')->with('success', 'Goodbye');
    }
}
