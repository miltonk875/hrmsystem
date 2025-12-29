<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DataTables;
use App\Models\Department;

class DepartmentController extends Controller {

    public $user;

    public function __construct() {
        $this->middleware(function ($request, $next) {
            if (!Auth::user()) {
                return route('login');
            } else {
                $this->user = Auth::user()->id;
                $this->role = Auth::user()->role_id;
            }
            return $next($request);
        });
    }

    public function index() {
        return view('department.index', [
            'title' => 'Manage Departments',
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    //Store New User
    public function store(Request $request) {
        $request->validate([
            'department' => 'required|string|max:100|unique:departments,name',
        ]);

        $udata = [
            'name' => $request->department,
        ];
        Department::create($udata);

        return response()->json([
                    'message' => "New Department Created Successfully",
                    'type' => 'success',
        ]);
    }

    /**
     * Display the specified resource.
     */
    //Load User List
    public function show(Department $department) {
        try {
            if (request()->ajax()) {
                $userprofiles = $department->orderBy('id', 'desc')->get();
                return Datatables::of($userprofiles)
                                ->addIndexColumn()
                                ->addColumn('name', function ($row) {
                                    return $row->name ?? '';
                                })
                                ->addColumn('action', function ($row) {
                                    $btn = '<button class="btn btn-o btn-primary edit_department"  style="border-radius:10px;margin-right:5px" style="text-align: center;" id="' . $row->id . '" data-toggle="tooltip" title="Edit"><i class="fa fa-edit"></i></button>';
                                    $btn .= '<button style="border-radius:10px;margin-right:10px" class="btn btn-danger delete_department" id="' . $row->id . '" title="Delete"><i class="fa fa-trash"></i></button>';
                                    return $btn;
                                })
                                ->rawColumns(['status', 'action'])
                                ->make(true);
            }
        } catch (\Exception $exception) {
            $notification = array(
                'message' => $exception->getMessage(),
                'type' => 'error'
            );
            return redirect('/departments')->with($notification);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request) {
        $id = $request->input('id');
        $user = Department::find($id);
        return response()->json($user);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request) {
        $id = $request->department_id;
        $request->validate([
            'department' => 'required|string|max:100|unique:departments,name,' . $id . ',id',
        ]);

        $udata = [
            'name' => $request->department,
        ];
        Department::where('id', $id)->update($udata);
        return response()->json([
                    'message' => "Department Updated Successfully",
                    'type' => 'success',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request) {
        $id = $request->id;
        //Check Child Table Relations

        Department::where('id', $id)->delete();
        return response()->json([
                    'message' => "Department Deleted Successfully",
                    'type' => 'success',
        ]);
    }
}
