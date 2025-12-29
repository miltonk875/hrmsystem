<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AdminController extends Controller {

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
        $date = date('Y-m-d');
        $totalReg = User::count();
        $totalNew = User::where('status', 1)->whereDate('created_at', $date)->count();
        $totalPending = User::where('status', 0)->whereDate('created_at', $date)->count();
        
        return view('dashboard.index', [
            'totalReg' => $totalReg,
            'totalNew' => $totalNew,
            'totalPending' => $totalPending
        ]);
    }
}
