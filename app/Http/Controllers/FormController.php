<?php

namespace App\Http\Controllers;

use App\Models\Author as ModelsAuthor;
use Illuminate\Http\Request;
use App\Models\Author;
use Illuminate\Support\Facades\Validator ;

class FormController extends Controller
{
    function formCreate(Request $request)
    {
        return view('form.create');
    }

    function storeForm(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422); // Return a JSON response with errors and a 422 status code (Unprocessable Entity)
        }
 
        $name = $request->input('name');
        $author = new Author();
        $author->name = $name;
        $author->save();
        // return response()->json(['message' => 'Data received successfully!']);
    }
}
