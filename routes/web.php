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
    Route::post('/delete-exam', [AdminController::class, 'deleteExam'])->name('deleteExam');

    // Q&A route
    Route::get('/admin/qna-ans', [AdminController::class, 'qnaDashboard']);
    Route::post('/add-qna-ans', [AdminController::class, 'addQna'])->name('addQna');

    //students routing
    Route::get('/admin/students', [AdminController::class, 'studentsDashboard']);


    //qna exams
    Route::get('/get-questions', [AdminController::class, 'getQuestions'])->name('getQuestions');
    Route::post('/add-questions', [AdminController::class, 'addQuestions'])->name('addQuestions');
});

Route::group(['middleware' => ['web', 'checkStudent']], function () {
    Route::get('/dashboard', [AuthController::class, 'loadDashboard']);
});
