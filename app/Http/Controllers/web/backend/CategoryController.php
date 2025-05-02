<?php

namespace App\Http\Controllers\web\backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    function category()
    {
        // return  DB::table('users')->get();
        return Category::with('user','product')->get();
        // return response->json('');
        // DB::table('categories')->get();
    }

    function userForm(Request $request)
    {
        return User::create($request->input());
    }
    function userFormUpdate(Request $request, $id)
    {
        $id = $request->id;
        $body = $request->input();

        return User::where('id', $id)->update($body);
    }

    function userFormDelete(Request $request)
    {
        $id = $request->id;
        return User::where('id', $id)->delete();
    }
}
