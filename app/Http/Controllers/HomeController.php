<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    function home(Request $request)
    {
        if($request->isMethod('post'))
        {
            return ("this is post method");
        }
        return view('home');
    }

    // function contact(Request $request)
    // {
    //     if($request->isMethod('post'))
    //     {
    //         $data = [];
    //         $data['name'] = $request->input('name');
    //         $data['email'] = $request->input('email');
    //         $data['message'] = $request->input('message');
    //         return response()->json($data);
    //     }
    //     return view('contact');
    // }

    function contact(Request $request)
    {
        if($request->isMethod('post'))
        {
            $data = [];
            $data['name'] = $request->input('name');
            $data['email'] = $request->input('email');
            $data['message'] = $request->input('message');
            $data['color'] = $request->input('color');
            return response()->json($data);
        }
        return view('contact');
    }

    function test()
    {
        $course = [
            'name' => 'sadika',
            'batch' => 2016,
            'roll' => 1209,
        ];
        return $course;
    }
}
