<?php

namespace App\Http\Controllers;

use App\Models\Employees;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class EmployeeController extends Controller
{
    function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Employees::select(['id', 'first_name', 'last_name', 'avatar'])->get();
            return DataTables::of($data)
                ->addColumn('avatar', function ($row) {
                    if ($row->avatar) {

                        $url = asset('storage/image/' . basename($row->avatar));
                    } else {
                        $url = asset("front/images/product_images/small/no-image.png");
                    }

                    return '<img src="' . $url . '" border="0" width="40" class="img-rounded" />';
                })

                ->addColumn('action', function ($row) {
                    $btn = '<a href="javascript:void(0)" class="edit btn btn-primary btn-sm" data-id="' . $row->id . '">
                           <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-edit"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" /><path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" /><path d="M16 5l3 3" /></svg>
                           </a>';
                    $deleteBtn = '<a href="javascript:void(0)" class="delete btn btn-danger mx-2 btn-sm" data-id="' . $row->id . '">
                  <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-trash"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 7l16 0" /><path d="M10 11l0 6" /><path d="M14 11l0 6" /><path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" /><path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" /></svg>
                           </a>';
                    return $btn . $deleteBtn;
                })
                ->rawColumns(['action', 'avatar'])

                ->make(true);
        }
        return view('employee.index');
    }
    function store(Request $request)
    {
        try {
            $file = $request->file('avatar');
            $fileName = time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('image', $fileName, 'public');
            //    $file->move(public_path('images'), $fileName);


            $empData = [
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'phone' => $request->phone,
                'post' => $request->post,
                'avatar' => $fileName
            ];

            Employees::create($empData);
            return response()->json([
                'status' => 200
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 500,
                'message' => 'Error: ' . $e->getMessage()
            ], 500);
        }
    }
    function edit(Request $request)
    {
        $id = $request->id;
        $allForm = Employees::findOrFail($id);
        return response()->json(['data' => $allForm]);
    }

    public function update(Request $request)
    {
        $emp = Employees::findOrFail($request->id);

        // Initialize with existing avatar
        $avatarName = $emp->avatar;

        // Handle new avatar upload
        if ($request->hasFile('avatar')) {
            $file = $request->file('avatar');
            $avatarName = time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('image', $avatarName, 'public');
            // Store new avatar
            // $file->storeAs('public/images', $avatarName);

            // Delete old avatar if it exists
            if ($emp->avatar && Storage::exists('image/' . $emp->avatar)) {
                Storage::delete('image/' . $emp->avatar);
            }
        }
        // If no new avatar and no existing avatar, this will fail due to NOT NULL constraint

        $empData = [
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'post' => $request->post,
            'avatar' => $avatarName
        ];

        $emp->update($empData);

        return response()->json([
            'status' => 200,
            'message' => 'Employee Updated Successfully'
        ]);
    }

    function delete(Request $request){
        $id = $request->id;
        $emp = Employees::find($id);
        if(Storage::delete('storage/image'. $emp->avatar)){
            Employees::destroy($id);
        }
          return response()->json([
            // 'status' => 200,
            'message' => 'Employee Updated Successfully'
        ]);
    }

    // function update(Request $request)
    // {
    //     $fileName = '';
    //     $emp = Employees::find($request->id);
    //     if ($request->hasFile('avatar')) {
    //         $file = $request->file('avatar');
    //         $fileName = time() . '.' . $file->getClientOriginalExtension();
    //         $file->storeAs('image', $fileName, 'public');
    //         if ($emp->avatar) {
    //             Storage::delete('image' . $emp->avatar);
    //         }
    //     } else {
    //         $fileName = $request->emp_avatar;
    //     }
    //     $empData = [
    //         'first_name' => $request->first_name,
    //         'last_name' => $request->last_name,
    //         'email' => $request->email,
    //         'phone' => $request->phone,
    //         'post' => $request->post,
    //         'avatar' => $fileName
    //     ];
    //     $emp->update($empData);
    //     return response()->json([
    //         'status' => 200,
    //     ]);
    // }
}
