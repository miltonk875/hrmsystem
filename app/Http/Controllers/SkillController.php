<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DataTables;
use App\Models\Skill;

class SkillController extends Controller {

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

    public function index() {
        return view('skill.index', [
            'title' => 'Manage Skills',
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
            'skill' => 'required|string|max:100|unique:skills,name',
        ]);

        $udata = [
            'name' => $request->skill,
        ];
        Skill::create($udata);

        return response()->json([
                    'message' => "New Skill Created Successfully",
                    'type' => 'success',
        ]);
    }

    /**
     * Display the specified resource.
     */
    //Load User List
    public function show() {
        try {
            if (request()->ajax()) {
                $userprofiles = Skill::orderBy('id', 'desc')->get();
                return Datatables::of($userprofiles)
                                ->addIndexColumn()
                                ->addColumn('name', function ($row) {
                                    return $row->name ?? '';
                                })
                                ->addColumn('action', function ($row) {
                                    $btn = '<button class="btn btn-o btn-primary edit_skill"  style="border-radius:10px;margin-right:5px" style="text-align: center;" id="' . $row->id . '" data-toggle="tooltip" title="Edit"><i class="fa fa-edit"></i></button>';
                                    $btn .= '<button style="border-radius:10px;margin-right:10px" class="btn btn-danger delete_skill" id="' . $row->id . '" title="Delete"><i class="fa fa-trash"></i></button>';
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
            return redirect('/skills')->with($notification);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request) {
        $id = $request->input('id');
        $user = Skill::find($id);
        return response()->json($user);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request) {
        $id = $request->skill_id;
        $request->validate([
            'skill' => 'required|string|max:100|unique:skills,name,' . $id . ',id',
        ]);

        $udata = [
            'name' => $request->skill,
        ];
        Skill::where('id', $id)->update($udata);
        return response()->json([
                    'message' => "Skill Updated Successfully",
                    'type' => 'success',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request) {
        $id = $request->id;
        //Check Child Table Relations

        Skill::where('id', $id)->delete();
        return response()->json([
                    'message' => "Skill Deleted Successfully",
                    'type' => 'success',
        ]);
    }
}
