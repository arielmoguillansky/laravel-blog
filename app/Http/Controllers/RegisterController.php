<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class RegisterController extends Controller
{
    public function create()
    {
        return view('register.create');
    }

    public function store()
    {
        $attributes = request()->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'username' => 'required|max:255|min:3|unique:users,username',
            'password' => 'required|min:6',
            // 'password' => ['required','min:6'] // alternative sintax,
        ]);

        // $attributes['password'] = bcrypt($attributes['password']);

        $user = User::create($attributes);

        // session()->flash('success', 'Registration complete!');// It will show success message for only one request. Meaning that on refresh it will disappear.

        auth()->login($user);

        // return view('register.create');
        return redirect('/posts')->with(session()->flash('success', 'Registration complete!'));
    }
}
