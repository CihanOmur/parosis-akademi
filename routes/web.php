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
        Route::get('/', [UserController::class, 'index'])->name('index');
        Route::get('/create', [UserController::class, 'create'])->name('create');
        Route::post('/store', [UserController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [UserController::class, 'edit'])->name('edit');
        Route::post('/{id}/update', [UserController::class, 'update'])->name('update');
        Route::delete('/{id}', [UserController::class, 'delete'])->name('delete');
    });
    Route::prefix('class')->name('class.')->group(function () {
        Route::get('/', [LessonClassController::class, 'index'])->name('index');
        Route::get('/create', [LessonClassController::class, 'create'])->name('create');
        Route::post('/store', [LessonClassController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [LessonClassController::class, 'edit'])->name('edit');
        Route::post('/{id}/update', [LessonClassController::class, 'update'])->name('update');
        Route::delete('/{id}', [LessonClassController::class, 'delete'])->name('delete');
    });
    Route::prefix('students')->name('students.')->group(function () {
        Route::get('/', [StudentController::class, 'index'])->name('index');
        Route::get('/create', [StudentController::class, 'create'])->name('create');
        Route::post('/store', [StudentController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [StudentController::class, 'edit'])->name('edit');
        Route::get('/{id}/re-create', [StudentController::class, 'reCreate'])->name('reCreate');
        Route::post('/{id}/re-create', [StudentController::class, 'reCreateUpdate'])->name('reCreateUpdate');
        Route::post('/{id}/update', [StudentController::class, 'update'])->name('update');

        Route::get('/{id}/payment', [StudentController::class, 'payment'])->name('payment');
        Route::post('/{id}/payment', [StudentController::class, 'paymentUpdate'])->name('paymentUpdate');
        Route::get('/{id}/payments', [StudentController::class, 'allPayments'])->name('allPayments');

        Route::post('/downloadRegistrationForm', [StudentController::class, 'downloadRegistrationForm'])->name('downloadRegistrationForm');
        Route::post('/downloadContract', [StudentController::class, 'downloadContract'])->name('downloadContract');
        Route::post('/downloadPayment', [StudentController::class, 'downloadPayment'])->name('downloadPayment');
    });
});
Route::get('/', function () {
    return view('welcome');
});
Route::get('/login', function () {
    return view('auth.login');
})->name('login');
Route::post('/login', [UserController::class, 'login'])->name('loginPost');
Route::post('/logout', [UserController::class, 'logout'])->name('logout');
