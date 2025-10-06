<?php

use App\Http\Controllers\Blogs\BlogController;
use App\Http\Controllers\Class\LessonClassController;
use App\Http\Controllers\Contact\ContactController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Faq\FaqController;
use App\Http\Controllers\Languages\LanguagesController;
use App\Http\Controllers\Pages\PagesController;
use App\Http\Controllers\Projects\ProjectsController;
use App\Http\Controllers\References\ReferencesController;
use App\Http\Controllers\Services\ServicesController;
use App\Http\Controllers\Student\StudentController;
use App\Http\Controllers\Teams\TeamsController;
use App\Http\Controllers\User\UserController;
use App\Http\Middleware\SharedDatas;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', SharedDatas::class])->prefix('panel')->group(function () {

    Route::get('', [DashboardController::class, 'index'])->name('dashboard.index');


    Route::prefix('languages')->name('languages.')->group(function () {
        Route::get('/', [LanguagesController::class, 'index'])->name('index');
        Route::post('/update', [LanguagesController::class, 'update'])->name('update');
    });

    Route::prefix('users')->name('users.')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('index')->middleware('permission:user');
        Route::get('/create', [UserController::class, 'create'])->name('create')->middleware('permission:user');
        Route::post('/store', [UserController::class, 'store'])->name('store')->middleware('permission:user');
        Route::get('/{id}/edit', [UserController::class, 'edit'])->name('edit')->middleware('permission:user');
        Route::post('/{id}/update', [UserController::class, 'update'])->name('update')->middleware('permission:user');
        Route::delete('/{id}', [UserController::class, 'delete'])->name('delete')->middleware('permission:user_delete');
    });
    Route::prefix('class')->name('class.')->group(function () {
        Route::get('/', [LessonClassController::class, 'index'])->name('index')->middleware('permission:class|class_delete');
        Route::get('/create', [LessonClassController::class, 'create'])->name('create')->middleware('permission:class');
        Route::post('/store', [LessonClassController::class, 'store'])->name('store')->middleware('permission:class');
        Route::get('/{id}/edit', [LessonClassController::class, 'edit'])->name('edit')->middleware('permission:class');
        Route::post('/{id}/update', [LessonClassController::class, 'update'])->name('update')->middleware('permission:class');
        Route::delete('/{id}', [LessonClassController::class, 'delete'])->name('delete')->middleware('permission:class_delete');
    });
    Route::prefix('students')->name('students.')->group(function () {
        Route::get('/', [StudentController::class, 'index'])->name('index')->middleware('permission:student|student_delete|accounting');
        Route::get('/create', [StudentController::class, 'create'])->name('create')->middleware('permission:student');
        Route::post('/store', [StudentController::class, 'store'])->name('store')->middleware('permission:student');
        Route::get('/{id}/edit', [StudentController::class, 'edit'])->name('edit');
        Route::get('/{id}/re-create', [StudentController::class, 'reCreate'])->name('reCreate')->middleware('permission:student');
        Route::post('/{id}/re-create', [StudentController::class, 'reCreateUpdate'])->name('reCreateUpdate')->middleware('permission:student');
        Route::post('/{id}/update', [StudentController::class, 'update'])->name('update')->middleware('permission:student');
        Route::post('/{id}/change-activity', [StudentController::class, 'changeActivity'])->name('changeActivity')->middleware('permission:student');

        Route::get('/{id}/payment', [StudentController::class, 'payment'])->name('payment')->middleware('permission:student|accounting');
        Route::post('/{id}/payment', [StudentController::class, 'paymentUpdate'])->name('paymentUpdate')->middleware('permission:student|accounting');
        Route::get('/{id}/payments', [StudentController::class, 'allPayments'])->name('allPayments')->middleware('permission:student|accounting');

        Route::post('/downloadRegistrationForm', [StudentController::class, 'downloadRegistrationForm'])->name('downloadRegistrationForm')->middleware('permission:student|student_delete|accounting');
        Route::post('/downloadContract', [StudentController::class, 'downloadContract'])->name('downloadContract')->middleware('permission:student|accounting|student_delete');
        Route::post('/downloadPayment', [StudentController::class, 'downloadPayment'])->name('downloadPayment')->middleware('permission:student|accounting|student_delete');

        Route::get('/create-pre-registiration', [StudentController::class, 'createPreRegistiration'])->name('pre.createPreRegistiration')->middleware('permission:student');
        Route::post('/store-pre-registiration', [StudentController::class, 'storePreRegistiration'])->name('pre.storePreRegistiration')->middleware('permission:student');
        Route::get('/{id}/edit-pre-registiration', [StudentController::class, 'editPreRegistiration'])->name('pre.editPreRegistiration')->middleware('permission:student');
        Route::post('/{id}/update-pre-registiration', [StudentController::class, 'updatePreRegistiration'])->name('pre.updatePreRegistiration')->middleware('permission:student');

        Route::get('/{id}/pre-to-normal', [StudentController::class, 'preToNormal'])->name('pre-to-normal')->middleware('permission:student');
        Route::post('/{id}/pre-to-normal', [StudentController::class, 'preToNormalPost'])->name('pre-to-normal.post')->middleware('permission:student');

        Route::get('/pre/students', [StudentController::class, 'preStudents'])->name('pre.students')->middleware('permission:student');
        Route::delete('/{id}', [StudentController::class, 'delete'])->name('delete')->middleware('permission:student_delete');
    });
});
Route::get('/', function () {
    return view('welcome');
});
Route::get('/panel/login', function () {
    return view('auth.login');
})->name('login');
Route::post('/panel/login', [UserController::class, 'login'])->name('loginPost');
Route::post('/panel/logout', [UserController::class, 'logout'])->name('logout');
