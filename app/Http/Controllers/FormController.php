<?php

namespace App\Http\Controllers;

use App\Models\Author as ModelsAuthor;
use Illuminate\Http\Request;
use App\Models\Author;
use Illuminate\Support\Facades\Validator;
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

    function redForm(Request $request)
    {
        if ($request->ajax()) {
            $users = Author::query();

            return DataTables::of($users)
                ->rawColumns(['name', 'action'])
                ->addColumn('action', function ($row) {
                    $editBtn = '<button class="edit-button btn btn-primary btn-sm" data-id="' . $row->id . '">Edit</button>';
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
        return view('form.read');
    }

    function editForm($id)
    {
        $author = Author::findOrFail($id);
        return view('form.edit', compact('author'));
    }

    public function updateForm(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $author = Author::findOrFail($id);
        $author->name = $request->name;
        $author->save();

        return response()->json(['message' => 'Author updated successfully']);
    }

    function deleteForm($id)
    {
        $author = Author::findOrFail($id);
        $author->delete();
        return response()->json(['success' => 'Data deleted successfully.']);
    }
}
