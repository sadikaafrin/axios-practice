<?php

namespace App\Http\Controllers;

use App\Models\Author as ModelsAuthor;
use Illuminate\Http\Request;
use App\Models\Author;
use Illuminate\Support\Facades\Validator ;
use Yajra\DataTables\DataTables;

class FormController extends Controller
{
    function formCreate(Request $request)
    {
        return view('form.create');
    }

    function storeForm(Request $request)
    {
      $name = $request->input('name');
      $author = new Author();
      $author->name = $name;
      $author->save();
    }

    function redForm(Request $request){
        if ($request->ajax()) {
        $users = Author::query();

        return DataTables::of($users)
            ->rawColumns(['name', 'action'])
            ->addColumn('action', function($row){
                $editBtn  = '<a href="javascript:void(0)" class="edit btn btn-primary btn-sm">
                <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-edit"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" /><path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" /><path d="M16 5l3 3" /></svg>
                </a>';
              $deleteBtn = '<a href="javascript:void(0)" class="delete btn btn-danger btn-sm" onclick="deleteItem(' . $row->id . ')">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-trash-off">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                    <path d="M3 3l18 18" />
                                    <path d="M4 7h3m4 0h9" />
                                    <path d="M10 11l0 6" />
                                    <path d="M14 14l0 3" />
                                    <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l.077 -.923" />
                                    <path d="M18.384 14.373l.616 -7.373" />
                                    <path d="M9 5v-1a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
                                </svg>
                            </a>';
                return $editBtn . ' ' . $deleteBtn;
        })
            ->make(true);
        }
        return view ('form.read');
    }
    function deleteForm( $id){
        $author = Author::findOrFail($id);
        $author->delete();
        return response()->json(['success' => 'Data deleted successfully.']);
    }
    
}
