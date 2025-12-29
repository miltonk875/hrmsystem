<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use DataTables;
use App\Models\User;

class UserController extends Controller {

    public $user;

    public function __construct() {
        $this->middleware(function ($request, $next) {
            if (!Auth::user()) {
                return route('login');
            } else {
                $this->user = Auth::user()->id;
            }
            return $next($request);
        });
    }

    //User List
    public function index() {
        return view('user.index', [
            'title' => 'Manage Users',
        ]);
    }

    //Load User List
    public function show() {
        try {
            if (request()->ajax()) {
                $userprofiles = User::orderBy('id', 'desc')->get();
                return Datatables::of($userprofiles)
                                ->addIndexColumn()
                                ->addColumn('name', function ($row) {
                                    return $row->name ?? '';
                                })
                                ->addColumn('email', function ($row) {
                                    return $row->email ?? '';
                                })
                                ->addColumn('password', function ($row) {
                                    return '**********';
                                })
                                ->addColumn('status', function ($row) {
                                    if ($row->status == 1) {
                                        $status = '<span style="border-radius:10px;background: green;color: #fff;padding: 5px">Active</span>';
                                    } else {
                                        $status = '<span style="border-radius:10px;background: red;color: #fff;padding: 5px">Inactive</span>';
                                    }
                                    return $status;
                                })
                                ->addColumn('action', function ($row) {
                                    $btn = '';
                                    if ($row->special_access != 1) {
                                        if ($row->status == 1) {
                                            $btn = '<button class="btn btn-o btn-success change_user_status" style="border-radius:10px;margin-right:5px;text-align: center" id="' . $row->id . '" value="0" data-toggle="tooltip" title="Inactive"><i class="fa fa-lock"></i></button>';
                                        } else {
                                            $btn = '<button class="btn btn-o btn-danger change_user_status" style="border-radius:10px;margin-right:5px;text-align: center" id="' . $row->id . '" value="1" data-toggle="tooltip" title="Active"><i class="fa fa-unlock"></i></button>';
                                        }
                                        $btn .= '<button class="btn btn-o btn-primary edit_user_data"  style="border-radius:10px;margin-right:5px;text-align: center;" id="' . $row->id . '" data-toggle="tooltip" title="Edit"><i class="fa fa-edit"></i></button>';
                                        $btn .= '<button style="border-radius:10px;margin-right:10px" class="btn btn-danger delete_user" id="' . $row->id . '" title="Delete"><i class="fa fa-trash"></i></button>';
                                    }
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
            return redirect('/user_management')->with($notification);
        }
    }

    //Store New User
    public function store(Request $request) {
        $request->validate([
            'username' => 'required|string|max:100',
            'email' => 'required|string|max:100|unique:users,email',
            'password' => 'required|confirmed|min:6',
            'password_confirmation' => 'required',
        ]);

        $udata = [
            'name' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'status' => 1
        ];
        User::create($udata);

        return response()->json([
                    'message' => "New User Created Successfully",
                    'type' => 'success',
        ]);
    }

    //Manage User Status
    public function status(Request $request) {
        $id = $request->id;
        $value = $request->value;
        $message = $value == 1 ? 'Activated' : 'Deactivated';
        User::where('id', $id)->update(['status' => $value]);
        return response()->json([
                    'message' => "User Status $message Successfully",
                    'type' => 'success',
        ]);
    }

    //Get User Single Info
    public function edit(Request $request) {
        $id = $request->input('id');
        $user = User::where('id', $id)->first();
        return response()->json($user);
    }

    //Update User Info
    public function update(Request $request) {
        $id = $request->user_id;
        $request->validate([
            'username' => 'required|string|max:100',
            'email' => 'required|string|max:100|unique:users,email,' . $id . ',id',
        ]);

        $udata = [
            'name' => $request->username,
            'email' => $request->email,
        ];
        DB::table('users')->where('id', $id)->update($udata);
        return response()->json([
                    'message' => "User Info Updated Successfully",
                    'type' => 'success',
        ]);
    }

    //Update User Password
    public function password(Request $request) {
        $id = $request->user_id;
        $request->validate([
            'password' => 'required|confirmed|min:6',
            'password_confirmation' => 'required',
        ]);

        User::where('id', $id)->update([
            'password' => Hash::make($request->password)
        ]);
        return response()->json([
                    'message' => "User Password Updated Successfully",
                    'type' => 'success',
        ]);
    }

    //Delete User Info
    public function destroy(Request $request) {
        $id = $request->id;
        User::where('id', $id)->delete();
        return response()->json([
                    'message' => "User Access Deleted Successfully",
                    'type' => 'success',
        ]);
    }
}
