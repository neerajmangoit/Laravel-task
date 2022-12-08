<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SuperAdminFunctionalityController;

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

Route::group(['middleware' => ['auth']], function () {
    Route::get('/dashboard', 'App\Http\Controllers\DashboardController@index')->name('dashboard');
});

// Route the login action
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

//Routes for the Super Admin functionality
Route::group(['middleware' => ['role:superAdmin']], function () {

    Route::get('/add_user', function () {
        return view('superAdmin.register');
    });

    Route::post('/add_user', [SuperAdminFunctionalityController::class, 'addUser'])->name('addUser');

    Route::get('/delete_user/{id}', [SuperAdminFunctionalityController::class, 'deleteUser']);

    Route::get('/edit_user/{id}', [SuperAdminFunctionalityController::class, 'editUser']);

    Route::get('/update_user/{id}', [SuperAdminFunctionalityController::class, 'updateUser']);

    Route::post('/update_user', [SuperAdminFunctionalityController::class, 'updateUser'])->name('updateUser');
});


require __DIR__ . '/auth.php';
