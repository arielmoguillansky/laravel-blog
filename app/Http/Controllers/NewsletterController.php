<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\Newsletter;
use Illuminate\Validation\ValidationException;
use Exception;

class NewsletterController extends Controller
{
    public function __invoke(Newsletter $newsletter)//Automatic resolution of dependencies
    {
        request()->validate(['email' => 'required|email']);
       
        try
        {
            // $newsletter = new Newsletter();
            $newsletter->subscribe(request('email'));
    
        } catch(Exception $e) {
            throw ValidationException::withMessages(['email' => 'Email is invalid']);
        }
    
        return redirect('/')->with('success', 'You are now subscribed to our newsletter');
    }
}
