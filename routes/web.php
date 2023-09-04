<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

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
Route::post('/admin', [AuthController::class, 'studentRegister'])->name('studentRegister');

//     return view('admin');
// })->name('Admin');

Route::get('/student', function () {
    return view('student');
})->name('Student');
