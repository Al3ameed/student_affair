<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [ AuthController::class , 'index'])->name("main")->middleware("guest");
Route::post('/login', [ AuthController::class , 'login'])->name("login")->middleware("guest");

// Middle to Admins Only
Route::middleware(['auth'])->group(function () {
    Route::post('/logout', [ AuthController::class , 'logout'])->name("logout");
    Route::get('/home', [ StudentController::class , 'home'])->name("home");
    Route::resource('/students', StudentController::class);
    Route::get('/students/{id}/manage-grades', [StudentController::class , 'grades']);
    Route::post('/update_grades/{id}', [StudentController::class , 'update_grades'])->name("update_grade");

    Route::get('/students/{id}/manage-fees', [StudentController::class , 'fees']);
    Route::post('/update_fees/{id}', [StudentController::class , 'update_fees'])->name("update_fees");

    Route::get('/excellent_students', [ReportController::class , 'excellent_students'])->name("excellent");
    Route::get('/governorates', [ReportController::class , 'governorates'])->name("governorates");
    Route::get('/military_education', [ReportController::class , 'military_education'])->name("military_education");
    Route::get('/military_service', [ReportController::class , 'military_service'])->name("military_service");
    Route::get('/student_ages', [ReportController::class , 'student_ages'])->name("student_ages");
    Route::get('/foreign_students', [ReportController::class , 'foreign_students'])->name("foreign_students");
});
