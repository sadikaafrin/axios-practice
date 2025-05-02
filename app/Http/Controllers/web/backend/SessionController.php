<?php

namespace App\Http\Controllers\web\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SessionController extends Controller
{
    function setSession(Request $request)
    {
        session()->put('name', 'sadika');
        $request->session()->put('email', 'sadika@gmail.com');
        session(['phone' => '1221323']);
        $request->session()->put('age', '26');
        return response("session has been set");
    }
    function getSession(Request $request)
    {
        $name = session()->get('name');
        $email = $request->session()->get('email');
        $phone = session('phone');
        $age = session('age');
        return response("Name: $name, Email: $email, Phone: $phone, Age: $age");
    }

    function viewShow()
    {
        return view('viewShow');
    }

    function updateSession(Request $request)
    {
        session()->put('name', 'Afrin');
        $request->session()->put('email', 'afrin@gmail.com');
        session([
            'phone' => '56946',
            'age' => '29'
        ]);
        return response("Session Has been updated");
    }

    function deleteSession() 
    {
        session()->forget('name');
        session()->forget([
            'age'
        ]);
        return response("Session Delete Successfully");
    }
}
