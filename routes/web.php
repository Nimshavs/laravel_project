<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use Illuminate\Http\JsonResponse;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('index');
})->name('Home');

Route::get('/admin', [AuthController::class, 'loadRegister'])->name('admin');
Route::post('/admin', [AuthController::class, 'studentRegister'])->name('admin');

Route::get('/login', function () {
    return redirect('/');
});

Route::get('/login', [AuthController::class, 'loadLogin'])->name('login');
Route::post('/login', [AuthController::class, 'loginPost'])->name('login');

Route::get('/logout', [AuthController::class, 'logout']);

Route::get('/forget-password', [AuthController::class, 'forgetpasswordload']);
Route::post('/forget-password', [AuthController::class, 'forgetPassword'])->name('forgetPassword');

Route::group(['middleware' => ['web', 'checkAdmin']], function () {
    Route::get('/admin/dashboard', [AuthController::class, 'adminDashboard']);

    Route::get('/admin/dashboard', [AdminController::class, 'examDashboard']);
    Route::post('/add-exam', [AdminController::class, 'addExam'])->name('addExam');
});

Route::group(['middleware' => ['web', 'checkStudent']], function () {
    Route::get('/dashboard', [AuthController::class, 'loadDashboard']);
});

//     return view('admin');
// })->name('Admin');

// Route::get('/student', function () {
//     return view('login');
// })->name('login');
