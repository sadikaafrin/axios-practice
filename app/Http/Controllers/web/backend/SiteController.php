<?php

namespace App\Http\Controllers\web\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SiteController extends Controller
{
        function home()
    {
        $learner = [
            ['firstName' => 'Sadika', 'lastName' => 'Afrin'],
            ['firstName' => 'Suma', 'lastName' => 'Afrin'],
            ['firstName' => 'Kotha', 'lastName' => 'dsfs'],
        ];
        return view('page.home',['learner' => $learner]);
    }

    function about()
    {
        return view('page.about');
    }

    function course()
    {
        return view('page.course');
    }

    function signin()
    {
        return view('page.signin');
    }

    function signup()
    {
        return view('page.signup');
    }

    function form(Request $request)
    {
        $request->validate([
            'name' => 'required|min:4',
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);
        // return view('form');
        return response("From Submit successfully");
    }
}
