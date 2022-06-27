<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CenterController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/', function () {
    // return view('welcome');
    return redirect('/login');
});

Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function () {
    // ===================== DEPARTMENTS ======================

    Route::get('/departments', [DepartmentController::class, 'index'])->name(
        'department.show'
    );

    Route::get('/departments/create', [
        DepartmentController::class,
        'create',
    ])->name('department.create');

    Route::get('/departments/edit/{id}', [
        DepartmentController::class,
        'edit',
    ])->name('department.edit');

    Route::post('/departments/update/{id}', [
        DepartmentController::class,
        'update',
    ])->name('department.update');

    Route::get('/departments/delete/{id}', [
        DepartmentController::class,
        'destroy',
    ])->name('department.delete');

    // Store the new department from the form posted with the view Above
    Route::post('/departments/store', [
        DepartmentController::class,
        'store',
    ])->name('department.store');

    // ====================  CENTERS ===================

    Route::get('/centers', [CenterController::class, 'index'])->name(
        'center.show'
    );

    Route::get('/centers/create', [CenterController::class, 'create'])->name(
        'center.create'
    );

    Route::get('/centers/edit/{id}', [CenterController::class, 'edit'])->name(
        'center.edit'
    );

    Route::post('/centers/update/{id}', [
        CenterController::class,
        'update',
    ])->name('center.update');

    Route::get('/centers/delete/{id}', [
        CenterController::class,
        'destroy',
    ])->name('center.delete');

    // Store the new department from the form posted with the view Above
    Route::post('/centers/store', [CenterController::class, 'store'])->name(
        'center.store'
    );

    Route::get('/tasks/list/{centerid}', [
        TaskController::class,
        'tasklist',
    ])->name('task.list');

    // ====================  TASKS =======================
    Route::get('/tasks', [TaskController::class, 'index'])->name('task.show');

    Route::get('/tasks/view/{id}', [TaskController::class, 'view'])->name(
        'task.view'
    );

    // Display the Create Task View form
    Route::get('/tasks/create', [TaskController::class, 'create'])->name(
        'task.create'
    );

    // Store the new task from the form posted with the view Above
    Route::post('/tasks/store', [TaskController::class, 'store'])->name(
        'task.store'
    );

    // Search view
    Route::get('/tasks/search', [TaskController::class, 'searchTask'])->name(
        'task.search'
    );

    // Sort Table
    Route::get('/tasks/sort/{key}', [TaskController::class, 'sort'])->name(
        'task.sort'
    );

    Route::get('/tasks/edit/{id}', [TaskController::class, 'edit'])->name(
        'task.edit'
    );

    // Route::get('/tasks/edit/{id}', function () {
    // 	'uses' => 'TaskController@edit',
    // 	'as'  => 'task.edit'
    // });

    Route::get('/tasks/list/{departmentid}', [
        TaskController::class,
        'tasklist',
    ])->name('task.list');
    Route::get('/tasks/delete/{id}', [TaskController::class, 'destroy'])->name(
        'task.delete'
    );
    Route::get('/tasks/deletefile/{id}', [
        TaskController::class,
        'deletefile',
    ])->name('task.deletefile');
    Route::post('/tasks/update/{id}', [TaskController::class, 'update'])->name(
        'task.update'
    );
    Route::get('/tasks/completed/{id}', [
        TaskController::class,
        'completed',
    ])->name('task.completed');

    // =====================  USERS   ============================
    Route::get('/users', [UserController::class, 'index'])->name('user.index');
    Route::get('/users/list/{id}', [
        UserController::class,
        'userTaskList',
    ])->name('user.list');
    Route::get('/users/create', [UserController::class, 'create'])->name(
        'user.create'
    );
    Route::post('/users/store', [UserController::class, 'store'])->name(
        'user.store'
    );
    Route::get('/users/edit/{id}', [UserController::class, 'edit'])->name(
        'user.edit'
    );
    Route::post('/users/update/{id}', [UserController::class, 'update'])->name(
        'user.update'
    );
    Route::get('/users/activate/{id}', [
        UserController::class,
        'activateh',
    ])->name('user.activate');
    Route::get('/users/delete/{id}', [UserController::class, 'destroy'])->name(
        'user.delete'
    );
    Route::get('/users/disable/{id}', [UserController::class, 'disable'])->name(
        'user.disable'
    );
});