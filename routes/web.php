<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\SkillController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RegistrationController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    if (Auth::user()) {
        return redirect('dashboard');
    }
    return view('auth.login');
});

Route::controller(RegistrationController::class)->group(function () {
    Route::get('/user-registration', 'index');
    Route::post('/check-user-email', 'duplicate')->name('check.user.email');
    Route::post('/user_registration', 'registration')->name('user.registration');
});

Route::middleware(['preventbackhistory', 'auth', 'verified'])->group(function () {
    Route::controller(AdminController::class)->group(function () {
        Route::get('dashboard', 'index')->name('dashboard');
        Route::get('settings', 'settings')->name('settings');
    });

    //Department List Controller
    Route::controller(DepartmentController::class)->group(function () {
        Route::get('/departments', 'index');
        Route::get('/get_department_list', 'show');
        Route::post('/department_store', 'store')->name('department.store');
        Route::get('/get_department_info', 'edit');
        Route::post('/department_update', 'update')->name('department.update');
        Route::get('/department_delete', 'destroy')->name('department.delete');
    });

    //Skill List Controller
    Route::controller(SkillController::class)->group(function () {
        Route::get('/skills', 'index');
        Route::get('/get_skill_list', 'show');
        Route::post('/skill_store', 'store')->name('skill.store');
        Route::get('/get_skill_info', 'edit');
        Route::post('/skill_update', 'update')->name('skill.update');
        Route::get('/skill_delete', 'destroy')->name('skill.delete');
    });

    //Employee List Controller
    Route::controller(EmployeeController::class)->group(function () {
        Route::get('/employees', 'index')->name('employee.index');
        Route::get('/show_employees', 'show');
        Route::get('/create_employee', 'create');
        Route::get('/check_duplicate_email', 'duplicate')->name('check.duplicate.email');
        Route::post('/store_employee', 'store')->name('employee.store');
        Route::get('/view_employee_info/{id}', 'view');
        Route::get('/edit_employee_info/{id}', 'edit');
        Route::get('/manage_employee_status', 'status')->name('manage.employee.status');
        Route::post('/update_employee', 'update')->name('employee.update');
        Route::get('/delete_employee', 'destroy')->name('employee.delete');
    });

    //System User Controller
    Route::controller(UserController::class)->group(function () {
        Route::get('/user_management', 'index');
        Route::get('/get_users_list', 'show');
        Route::post('/store_user_access', 'store')->name('store.user.info');
        Route::get('/change_user_status', 'status')->name('change.user.status');
        Route::get('/get_user_info', 'edit');
        Route::post('/update_user_info', 'update')->name('update.user.info');
        Route::post('/update_user_password', 'password')->name('update.user.password');
        Route::get('/delete_user_access', 'destroy')->name('delete.user.access');
    });
});

Route::get('/clearcache', function () {
    $cacheCommands = array(
        'event:clear',
        'view:clear',
        'cache:clear',
        'route:clear',
        'config:clear',
        'clear-compiled',
        'optimize:clear'
    );
    foreach ($cacheCommands as $command) {
        Artisan::call($command);
    }
    $notification = array(
        'message' => 'Cache cleared successfully',
        'type' => 'success'
    );
    return redirect('/dashboard')->with($notification);
});

require __DIR__ . '/auth.php';
