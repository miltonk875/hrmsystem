<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DataTables;
use App\Models\Employee;
use App\Models\Department;
use App\Models\Skill;

class EmployeeController extends Controller {

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
        $departments = Department::all();
        return view('employee.index', [
            'title' => 'Manage Employees',
            'departments' => $departments
        ]);
    }

    // Create New Employee
    public function create() {
        $departments = Department::all();
        $skills = Skill::all();

        return view('employee.create', [
            'title' => 'Add New Employee',
            'departments' => $departments,
            'skills' => $skills,
        ]);
    }

    // Check Duplicate Email
    public function duplicate(Request $request) {
        $email = $request->input('email');
        $result = Employee::where('email', $email)->exists();
        return response()->json([
                    'exists' => $result
        ]);
    }

    //Store Employee Info
    public function store(Request $request) {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:employees,email',
            'department' => 'required',
            'skills' => 'nullable|array',
            'skills.*' => 'exists:skills,id',
        ]);

        $employee = Employee::create([
                    'first_name' => $request->first_name,
                    'last_name' => $request->last_name,
                    'email' => $request->email,
                    'department_id' => $request->department,
                    'created_by' => $this->user,
        ]);

        if ($request->has('skills')) {
            $uniqueSkills = array_unique($request->skills);
            $employee->skills()->sync($uniqueSkills);
        }
        return response()->json([
                    'message' => "New Employee Created Successfully",
                    'type' => 'success',
        ]);
    }

    //Show Employee Info
    public function show(Request $request) {
        try {
            if (request()->ajax()) {
                $query = Employee::with(['department', 'skills']);
                if ($request->department_id) {
                    $query->where('department_id', $request->department_id);
                }
                $employeeList = $query->get();
                return Datatables::of($employeeList)
                                ->addIndexColumn()
                                ->addColumn('first_name', function ($row) {
                                    return $row->first_name ?? '';
                                })
                                ->addColumn('last_name', function ($row) {
                                    return $row->last_name ?? '';
                                })
                                ->addColumn('email', function ($row) {
                                    return $row->email ?? '';
                                })
                                ->addColumn('department', function ($row) {
                                    return $row->department->name ?? '';
                                })
                                ->addColumn('skills', function ($row) {
                                    $ul = '<ul>';
                                    foreach ($row->skills as $skill) {
                                        $ul .= '<li>' . e($skill->name) . '</li>';
                                    }
                                    $ul .= '</ul>';
                                    return $ul;
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
                                    if ($row->status == 1) {
                                        $btn = '<button class="btn btn-o btn-success change_employee_status" style="border-radius:10px;margin-right:5px" style="text-align: center" id="' . $row->id . '" value="0" data-toggle="tooltip" title="Inactive"><i class="fa fa-lock"></i></button>';
                                    } else {
                                        $btn = '<button class="btn btn-o btn-danger change_employee_status" style="border-radius:10px;margin-right:5px" style="text-align: center;margin-right:5px" id="' . $row->id . '" value="1" data-toggle="tooltip" title="Active"><i class="fa fa-unlock"></i></button>';
                                    }
                                    $btn .= '<button class="btn btn-o btn-info view_employee"  style="border-radius:10px;margin-right:5px" style="text-align: center;" id="' . $row->id . '" data-toggle="tooltip" title="View"><i class="fa fa-eye"></i></button>';
                                    $btn .= '<button class="btn btn-o btn-primary edit_employee"  style="border-radius:10px;margin-right:5px" style="text-align: center;" id="' . $row->id . '" data-toggle="tooltip" title="Edit"><i class="fa fa-edit"></i></button>';
                                    $btn .= '<button style="border-radius:10px;margin-right:10px" class="btn btn-danger delete_employee" id="' . $row->id . '" title="Delete"><i class="fa fa-trash"></i></button>';
                                    return $btn;
                                })
                                ->rawColumns(['skills', 'status', 'action'])
                                ->make(true);
            }
        } catch (\Exception $exception) {
            $notification = array(
                'message' => $exception->getMessage(),
                'type' => 'error'
            );
            return redirect('/employees')->with($notification);
        }
    }

    //Manage Employee Status
    public function status(Request $request) {
        $id = $request->id;
        $value = $request->value;
        $message = $value == 1 ? 'Activated' : 'Deactivated';
        Employee::where('id', $id)->update(['status' => $value]);
        return response()->json([
                    'message' => "Employee Status $message Successfully",
                    'type' => 'success',
        ]);
    }

    // View Employee Info
    public function view($id) {
        $employeeInfo = Employee::with(['department', 'skills', 'createdBy'])->find($id);
        return view('employee.view', [
            'title' => 'View Employee Info',
            'employeeInfo' => $employeeInfo,
        ]);
    }

    // Edit Employee Info
    public function edit($id) {
        $departments = Department::all();
        $skills = Skill::all();
        $employeeInfo = Employee::with(['department', 'skills'])->find($id);
        return view('employee.edit', [
            'title' => 'Edit Employee Info',
            'departments' => $departments,
            'skills' => $skills,
            'employeeInfo' => $employeeInfo,
        ]);
    }

    //Update Employee Info
    public function update(Request $request) {
        $id = $request->employee_id;
        $employee = Employee::find($id);

        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:employees,email,' . $id . ',id',
            'department' => 'required',
            'skills' => 'nullable|array',
            'skills.*' => 'exists:skills,id',
        ]);

        Employee::where('id', $id)->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'department_id' => $request->department,
            'updated_by' => $this->user,
        ]);

        if ($request->has('skills')) {
            $uniqueSkills = array_unique($request->skills);
            $employee->skills()->sync($uniqueSkills ?? []);
        }
        return response()->json([
                    'message' => "Employee Info Updated Successfully",
                    'type' => 'success',
        ]);
    }

    //Delete Employee Info
    public function destroy(Request $request) {
        $id = $request->id;
        $employee = Employee::find($id);

        //Remove All Skills
        $employee->skills()->detach();
        //Delete Employee
        $employee->delete();
        return response()->json([
                    'message' => "Employee Deleted Successfully",
                    'type' => 'success',
        ]);
    }
}
