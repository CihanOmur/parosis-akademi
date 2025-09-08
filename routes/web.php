<?php

use App\Http\Controllers\Blogs\BlogController;
use App\Http\Controllers\Contact\ContactController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Faq\FaqController;
use App\Http\Controllers\Languages\LanguagesController;
use App\Http\Controllers\Pages\PagesController;
use App\Http\Controllers\Projects\ProjectsController;
use App\Http\Controllers\References\ReferencesController;
use App\Http\Controllers\Services\ServicesController;
use App\Http\Controllers\Teams\TeamsController;
use App\Http\Controllers\User\UserController;
use App\Http\Middleware\SharedDatas;
use Illuminate\Support\Facades\Route;

Route::middleware([SharedDatas::class])->group(function () {

    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

    Route::prefix('references')->name('references.')->group(function () {
        Route::get('/', [ReferencesController::class, 'index'])->name('index');
        Route::get('/create', [ReferencesController::class, 'create'])->name('create');
        Route::post('/store', [ReferencesController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [ReferencesController::class, 'edit'])->name('edit');
        Route::post('/{id}/update', [ReferencesController::class, 'update'])->name('update');
        Route::delete('/{id}', [ReferencesController::class, 'delete'])->name('delete');
        Route::get('/{id}/translate', [ReferencesController::class, 'editTranslate'])->name('editTranslate');
        Route::post('/{id}/translate-update', [ReferencesController::class, 'updateTranslate'])->name('updateTranslate');

        Route::prefix('sectors')->name('sectors.')->group(function () {
            Route::get('/', [ReferencesController::class, 'sectorsIndex'])->name('index');
            Route::post('/store', [ReferencesController::class, 'sectorsStore'])->name('store');
            Route::get('/{id}/edit', [ReferencesController::class, 'sectorsEdit'])->name('edit');
            Route::post('/{id}/update', [ReferencesController::class, 'sectorsUpdate'])->name('update');
            Route::delete('/{id}', [ReferencesController::class, 'sectorsDelete'])->name('delete');
            Route::get('/{id}/translate', [ReferencesController::class, 'sectorsEditTranslate'])->name('sectorsEditTranslate');
            Route::post('/{id}/translate-update', [ReferencesController::class, 'sectorsUpdateTranslate'])->name('sectorsUpdateTranslate');
        });
    });
    Route::prefix('teams')->name('teams.')->group(function () {
        Route::get('/', [TeamsController::class, 'index'])->name('index');
        Route::get('/create', [TeamsController::class, 'create'])->name('create');
        Route::post('/store', [TeamsController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [TeamsController::class, 'edit'])->name('edit');
        Route::post('/{id}/update', [TeamsController::class, 'update'])->name('update');
        Route::delete('/{id}', [TeamsController::class, 'delete'])->name('delete');
        Route::get('/{id}/translate', [TeamsController::class, 'editTranslate'])->name('editTranslate');
        Route::post('/{id}/translate-update', [TeamsController::class, 'updateTranslate'])->name('updateTranslate');

        Route::prefix('departments')->name('departments.')->group(function () {
            Route::get('/', [TeamsController::class, 'departmentIndex'])->name('index');
            Route::post('/store', [TeamsController::class, 'departmentStore'])->name('store');
            Route::get('/{id}/edit', [TeamsController::class, 'departmentEdit'])->name('edit');
            Route::post('/{id}/update', [TeamsController::class, 'departmentUpdate'])->name('update');
            Route::delete('/{id}', [TeamsController::class, 'departmentDelete'])->name('delete');
            Route::get('/{id}/translate', [TeamsController::class, 'departmentTranslateIndex'])->name('departmentTranslateIndex');
            Route::post('/{id}/translate-update', [TeamsController::class, 'departmentTranslate'])->name('departmentTranslate');
        });
        Route::prefix('comments')->name('comments.')->group(function () {
            Route::get('/', [TeamsController::class, 'commentIndex'])->name('index');
            Route::get('/create', [TeamsController::class, 'commentCreate'])->name('create');
            Route::post('/store', [TeamsController::class, 'commentStore'])->name('store');
            Route::get('/{id}/edit', [TeamsController::class, 'commentEdit'])->name('edit');
            Route::post('/{id}/update', [TeamsController::class, 'commentUpdate'])->name('update');
            Route::delete('/{id}', [TeamsController::class, 'commentDelete'])->name('delete');
        });
    });
    Route::prefix('services')->name('services.')->group(function () {
        Route::get('/', [ServicesController::class, 'index'])->name('index');
        Route::get('/create', [ServicesController::class, 'create'])->name('create');
        Route::post('/store', [ServicesController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [ServicesController::class, 'edit'])->name('edit');
        Route::post('/{id}/update', [ServicesController::class, 'update'])->name('update');
        Route::delete('/{id}', [ServicesController::class, 'delete'])->name('delete');
        Route::get('/{id}/translate', [ServicesController::class, 'editTranslate'])->name('editTranslate');
        Route::post('/{id}/translate-update', [ServicesController::class, 'updateTranslate'])->name('updateTranslate');

        Route::prefix('categories')->name('categories.')->group(function () {
            Route::get('/', [ServicesController::class, 'categoryIndex'])->name('index');
            Route::post('/store', [ServicesController::class, 'categoryStore'])->name('store');
            Route::get('/{id}/edit', [ServicesController::class, 'categoryEdit'])->name('edit');
            Route::post('/{id}/update', [ServicesController::class, 'categoryUpdate'])->name('update');
            Route::delete('/{id}', [ServicesController::class, 'categoryDelete'])->name('delete');
            Route::get('/{id}/translate', [ServicesController::class, 'categoryEditTranslate'])->name('categoryEditTranslate');
            Route::post('/{id}/translate-update', [ServicesController::class, 'categoryUpdateTranslate'])->name('categoryUpdateTranslate');
        });
    });
    Route::prefix('faq')->name('faq.')->group(function () {
        Route::get('/', [FaqController::class, 'index'])->name('index');
        Route::get('/create', [FaqController::class, 'create'])->name('create');
        Route::post('/store', [FaqController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [FaqController::class, 'edit'])->name('edit');
        Route::post('/{id}/update', [FaqController::class, 'update'])->name('update');
        Route::delete('/{id}', [FaqController::class, 'delete'])->name('delete');
        Route::get('/{id}/translate', [FaqController::class, 'editTranslate'])->name('editTranslate');
        Route::post('/{id}/translate-update', [FaqController::class, 'updateTranslate'])->name('updateTranslate');

        Route::prefix('categories')->name('categories.')->group(function () {
            Route::get('/', [FaqController::class, 'categoryIndex'])->name('index');
            Route::post('/store', [FaqController::class, 'categoryStore'])->name('store');
            Route::get('/{id}/edit', [FaqController::class, 'categoryEdit'])->name('edit');
            Route::post('/{id}/update', [FaqController::class, 'categoryUpdate'])->name('update');
            Route::delete('/{id}', [FaqController::class, 'categoryDelete'])->name('delete');
            Route::get('/{id}/translate', [FaqController::class, 'categoryEditTranslate'])->name('categoryEditTranslate');
            Route::post('/{id}/translate-update', [FaqController::class, 'categoryUpdateTranslate'])->name('categoryUpdateTranslate');
        });
    });
    Route::prefix('blogs')->name('blogs.')->group(function () {
        Route::get('/', [BlogController::class, 'index'])->name('index');
        Route::get('/create', [BlogController::class, 'create'])->name('create');
        Route::post('/store', [BlogController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [BlogController::class, 'edit'])->name('edit');
        Route::post('/{id}/update', [BlogController::class, 'update'])->name('update');
        Route::delete('/{id}', [BlogController::class, 'delete'])->name('delete');
        Route::get('/{id}/translate', [BlogController::class, 'editTranslate'])->name('editTranslate');
        Route::post('/{id}/translate-update', [BlogController::class, 'updateTranslate'])->name('updateTranslate');

        Route::prefix('categories')->name('categories.')->group(function () {
            Route::get('/', [BlogController::class, 'categoryIndex'])->name('index');
            Route::post('/store', [BlogController::class, 'categoryStore'])->name('store');
            Route::get('/{id}/edit', [BlogController::class, 'categoryEdit'])->name('edit');
            Route::post('/{id}/update', [BlogController::class, 'categoryUpdate'])->name('update');
            Route::delete('/{id}', [BlogController::class, 'categoryDelete'])->name('delete');
            Route::get('/{id}/translate', [BlogController::class, 'categoryEditTranslate'])->name('categoryEditTranslate');
            Route::post('/{id}/translate-update', [BlogController::class, 'categoryUpdateTranslate'])->name('categoryUpdateTranslate');
        });
    });
    Route::prefix('projects')->name('projects.')->group(function () {
        Route::get('/', [ProjectsController::class, 'index'])->name('index');
        Route::get('/create', [ProjectsController::class, 'create'])->name('create');
        Route::post('/store', [ProjectsController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [ProjectsController::class, 'edit'])->name('edit');
        Route::post('/{id}/update', [ProjectsController::class, 'update'])->name('update');
        Route::delete('/{id}', [ProjectsController::class, 'delete'])->name('delete');
        Route::post('/gallery-upload', [ProjectsController::class, 'uploadGallery'])->name('gallery.upload');
        Route::get('/{id}/translate', [ProjectsController::class, 'editTranslate'])->name('editTranslate');
        Route::post('/{id}/translate-update', [ProjectsController::class, 'updateTranslate'])->name('updateTranslate');

        Route::prefix('categories')->name('categories.')->group(function () {
            Route::get('/', [ProjectsController::class, 'categoryIndex'])->name('index');
            Route::post('/store', [ProjectsController::class, 'categoryStore'])->name('store');
            Route::get('/{id}/edit', [ProjectsController::class, 'categoryEdit'])->name('edit');
            Route::post('/{id}/update', [ProjectsController::class, 'categoryUpdate'])->name('update');
            Route::delete('/{id}', [ProjectsController::class, 'categoryDelete'])->name('delete');
            Route::get('/{id}/translate', [ProjectsController::class, 'categoryEditTranslate'])->name('categoryEditTranslate');
            Route::post('/{id}/translate-update', [ProjectsController::class, 'categoryUpdateTranslate'])->name('categoryUpdateTranslate');
        });
    });
    Route::prefix('contacts')->name('contacts.')->group(function () {
        Route::get('/', [ContactController::class, 'index'])->name('index');
        Route::post('/store', [ContactController::class, 'store'])->name('store');
    });
    Route::prefix('pages')->name('pages.')->group(function () {
        Route::get('/', [PagesController::class, 'index'])->name('index');
        Route::get('edit/{id}', [PagesController::class, 'edit'])->name('edit');
        Route::post('update/{id}', [PagesController::class, 'update'])->name('update');
        Route::post('/gallery-upload', [PagesController::class, 'uploadGallery'])->name('gallery.upload');
        Route::get('/{id}/translate', [PagesController::class, 'editTranslate'])->name('editTranslate');
        Route::post('/{id}/translate-update', [PagesController::class, 'updateTranslate'])->name('updateTranslate');
    });
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
});
