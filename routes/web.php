<?php

use App\Http\Controllers\Class\LessonClassController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Faq\FaqController;
use App\Http\Controllers\Front\FrontController;
use App\Http\Controllers\Languages\LanguagesController;
use App\Http\Controllers\Pages\PagesController;
use App\Http\Controllers\Role\RoleController;
use App\Http\Controllers\Blog\BlogController;
use App\Http\Controllers\Blog\BlogCategoryController;
use App\Http\Controllers\Blog\BlogTagController;
use App\Http\Controllers\Course\CourseController;
use App\Http\Controllers\Course\CourseCategoryController;
use App\Http\Controllers\Teacher\TeacherController;
use App\Http\Controllers\Student\PreRegistrationController;
use App\Http\Controllers\Student\StudentController;
use App\Http\Controllers\Student\StudentDocumentController;
use App\Http\Controllers\Student\StudentPaymentController;
use App\Http\Controllers\Student\StudentReCreateController;
use App\Http\Controllers\User\UserController;
use App\Http\Middleware\SharedDatas;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', SharedDatas::class])->prefix('panel')->group(function () {

    Route::get('', [DashboardController::class, 'index'])->name('dashboard.index');

    // ─── Dil Yönetimi ───────────────────────────────────────────────────────────
    Route::prefix('languages')->name('languages.')->group(function () {
        Route::get('/',              [LanguagesController::class, 'index'])->name('index');
        Route::post('/toggle',        [LanguagesController::class, 'toggleActive'])->name('toggle');
        Route::post('/set-default',   [LanguagesController::class, 'setDefault'])->name('setDefault');
        Route::post('/update-order',  [LanguagesController::class, 'updateOrder'])->name('updateOrder');
        Route::get('/create',        [LanguagesController::class, 'create'])->name('create');
        Route::post('/store',        [LanguagesController::class, 'store'])->name('store');
        Route::get('/{id}/edit',     [LanguagesController::class, 'edit'])->name('edit');
        Route::post('/{id}/update',  [LanguagesController::class, 'update'])->name('update');
        Route::delete('/{id}',       [LanguagesController::class, 'delete'])->name('delete');
    });

    // ─── Rol Yönetimi ────────────────────────────────────────────────────────────
    Route::prefix('roles')->name('roles.')->group(function () {
        Route::get('/',              [RoleController::class, 'index'])->name('index')->middleware('permission:user');
        Route::get('/create',        [RoleController::class, 'create'])->name('create')->middleware('permission:user');
        Route::post('/store',        [RoleController::class, 'store'])->name('store')->middleware('permission:user');
        Route::get('/{id}/edit',     [RoleController::class, 'edit'])->name('edit')->middleware('permission:user');
        Route::post('/{id}/update',  [RoleController::class, 'update'])->name('update')->middleware('permission:user');
        Route::delete('/{id}',       [RoleController::class, 'delete'])->name('delete')->middleware('permission:user_delete');
    });

    // ─── Kullanıcı Yönetimi ──────────────────────────────────────────────────────
    Route::prefix('users')->name('users.')->group(function () {
        Route::get('/',              [UserController::class, 'index'])->name('index')->middleware('permission:user');
        Route::get('/create',        [UserController::class, 'create'])->name('create')->middleware('permission:user');
        Route::post('/store',        [UserController::class, 'store'])->name('store')->middleware('permission:user');
        Route::get('/{id}/edit',     [UserController::class, 'edit'])->name('edit')->middleware('permission:user');
        Route::post('/{id}/update',  [UserController::class, 'update'])->name('update')->middleware('permission:user');
        Route::delete('/{id}',       [UserController::class, 'delete'])->name('delete')->middleware('permission:user_delete');
    });

    // ─── Sınıf Yönetimi ──────────────────────────────────────────────────────────
    Route::prefix('class')->name('class.')->group(function () {
        Route::get('/',              [LessonClassController::class, 'index'])->name('index')->middleware('permission:class|class_delete');
        Route::get('/create',        [LessonClassController::class, 'create'])->name('create')->middleware('permission:class');
        Route::post('/store',        [LessonClassController::class, 'store'])->name('store')->middleware('permission:class');
        Route::get('/{id}/edit',     [LessonClassController::class, 'edit'])->name('edit')->middleware('permission:class');
        Route::post('/{id}/update',  [LessonClassController::class, 'update'])->name('update')->middleware('permission:class');
        Route::delete('/{id}',       [LessonClassController::class, 'delete'])->name('delete')->middleware('permission:class_delete');
    });

    // ─── Öğrenci Yönetimi ────────────────────────────────────────────────────────
    Route::prefix('students')->name('students.')->group(function () {
        // Temel CRUD
        Route::get('/',              [StudentController::class, 'index'])->name('index')->middleware('permission:student|student_delete|accounting');
        Route::get('/create',        [StudentController::class, 'create'])->name('create')->middleware('permission:student');
        Route::post('/store',        [StudentController::class, 'store'])->name('store')->middleware('permission:student');
        Route::get('/{id}/edit',     [StudentController::class, 'edit'])->name('edit');
        Route::post('/{id}/update',  [StudentController::class, 'update'])->name('update')->middleware('permission:student');
        Route::post('/{id}/change-activity',[StudentController::class, 'changeActivity'])->name('changeActivity')->middleware('permission:student');
        Route::delete('/{id}',       [StudentController::class, 'delete'])->name('delete')->middleware('permission:student_delete');

        // Kayıt Yenileme
        Route::get('/{id}/re-create',[StudentReCreateController::class, 'show'])->name('reCreate')->middleware('permission:student');
        Route::post('/{id}/re-create',[StudentReCreateController::class, 'update'])->name('reCreateUpdate')->middleware('permission:student');

        // Ödeme İşlemleri
        Route::get('/{id}/payment',  [StudentPaymentController::class, 'payment'])->name('payment')->middleware('permission:student|accounting');
        Route::post('/{id}/payment', [StudentPaymentController::class, 'paymentUpdate'])->name('paymentUpdate')->middleware('permission:student|accounting');
        Route::get('/{id}/payments', [StudentPaymentController::class, 'allPayments'])->name('allPayments')->middleware('permission:student|accounting');

        // PDF İndirme
        Route::post('/downloadRegistrationForm',[StudentDocumentController::class, 'downloadRegistrationForm'])->name('downloadRegistrationForm')->middleware('permission:student|student_delete|accounting');
        Route::post('/downloadContract',        [StudentDocumentController::class, 'downloadContract'])->name('downloadContract')->middleware('permission:student|accounting|student_delete');
        Route::post('/downloadPayment',         [StudentDocumentController::class, 'downloadPayment'])->name('downloadPayment')->middleware('permission:student|accounting|student_delete');

        // Ön Kayıt Yönetimi
        Route::get('/create-pre-registiration', [PreRegistrationController::class, 'create'])->name('pre.createPreRegistiration')->middleware('permission:student');
        Route::post('/store-pre-registiration', [PreRegistrationController::class, 'store'])->name('pre.storePreRegistiration')->middleware('permission:student');
        Route::get('/{id}/edit-pre-registiration',[PreRegistrationController::class, 'edit'])->name('pre.editPreRegistiration')->middleware('permission:student');
        Route::post('/{id}/update-pre-registiration',[PreRegistrationController::class, 'update'])->name('pre.updatePreRegistiration')->middleware('permission:student');

        Route::get('/{id}/pre-to-normal',  [PreRegistrationController::class, 'convertToNormal'])->name('pre-to-normal')->middleware('permission:student');
        Route::post('/{id}/pre-to-normal', [PreRegistrationController::class, 'convertToNormalPost'])->name('pre-to-normal.post')->middleware('permission:student');

        Route::get('/pre/students',  [PreRegistrationController::class, 'index'])->name('pre.students')->middleware('permission:student');
    });

    // ─── SSS Yönetimi (CRUD) ──────────────────────────────────────────────────
    Route::prefix('faq')->name('faq.')->group(function () {
        Route::get('/',              [FaqController::class, 'index'])->name('index');
        Route::get('/create',        [FaqController::class, 'create'])->name('create');
        Route::post('/store',        [FaqController::class, 'store'])->name('store');
        Route::get('/{id}/edit',     [FaqController::class, 'edit'])->name('edit');
        Route::post('/{id}/update',  [FaqController::class, 'update'])->name('update');
        Route::delete('/{id}',       [FaqController::class, 'delete'])->name('delete');
        Route::post('/update-order', [FaqController::class, 'updateOrder'])->name('updateOrder');
        Route::post('/{id}/toggle',  [FaqController::class, 'toggleActive'])->name('toggle');
        Route::get('/{id}/translate/{lang}', [FaqController::class, 'editTranslate'])->name('editTranslate');
        Route::post('/{id}/translate',       [FaqController::class, 'updateTranslate'])->name('updateTranslate');
    });

    // ─── Eğitmen Yönetimi (CRUD) ────────────────────────────────────────────────
    Route::prefix('teachers')->name('teachers.')->group(function () {
        Route::get('/',              [TeacherController::class, 'index'])->name('index');
        Route::get('/create',        [TeacherController::class, 'create'])->name('create');
        Route::post('/store',        [TeacherController::class, 'store'])->name('store');
        Route::get('/{id}/edit',     [TeacherController::class, 'edit'])->name('edit');
        Route::post('/{id}/update',  [TeacherController::class, 'update'])->name('update');
        Route::delete('/{id}',       [TeacherController::class, 'delete'])->name('delete');
        Route::post('/update-order', [TeacherController::class, 'updateOrder'])->name('updateOrder');
        Route::post('/{id}/toggle',  [TeacherController::class, 'toggleActive'])->name('toggle');
        Route::get('/{id}/translate/{lang}', [TeacherController::class, 'editTranslate'])->name('editTranslate');
        Route::post('/{id}/translate',       [TeacherController::class, 'updateTranslate'])->name('updateTranslate');
    });

    // ─── Blog Yönetimi (CRUD) ────────────────────────────────────────────────
    Route::prefix('blogs')->name('blogs.')->group(function () {
        Route::get('/',              [BlogController::class, 'index'])->name('index');
        Route::get('/create',        [BlogController::class, 'create'])->name('create');
        Route::post('/store',        [BlogController::class, 'store'])->name('store');
        Route::get('/{id}/edit',     [BlogController::class, 'edit'])->name('edit');
        Route::post('/{id}/update',  [BlogController::class, 'update'])->name('update');
        Route::delete('/{id}',       [BlogController::class, 'delete'])->name('delete');
        Route::post('/update-order', [BlogController::class, 'updateOrder'])->name('updateOrder');
        Route::post('/{id}/toggle',  [BlogController::class, 'toggleActive'])->name('toggle');
        Route::get('/{id}/translate/{lang}', [BlogController::class, 'editTranslate'])->name('editTranslate');
        Route::post('/{id}/translate',       [BlogController::class, 'updateTranslate'])->name('updateTranslate');
    });

    // ─── Blog Kategorileri ──────────────────────────────────────────────────
    Route::prefix('blog-categories')->name('blogCategories.')->group(function () {
        Route::get('/',              [BlogCategoryController::class, 'index'])->name('index');
        Route::get('/create',        [BlogCategoryController::class, 'create'])->name('create');
        Route::post('/store',        [BlogCategoryController::class, 'store'])->name('store');
        Route::get('/{id}/edit',     [BlogCategoryController::class, 'edit'])->name('edit');
        Route::post('/{id}/update',  [BlogCategoryController::class, 'update'])->name('update');
        Route::delete('/{id}',       [BlogCategoryController::class, 'delete'])->name('delete');
        Route::post('/update-order', [BlogCategoryController::class, 'updateOrder'])->name('updateOrder');
        Route::post('/{id}/toggle',  [BlogCategoryController::class, 'toggleActive'])->name('toggle');
        Route::get('/{id}/translate/{lang}', [BlogCategoryController::class, 'editTranslate'])->name('editTranslate');
        Route::post('/{id}/translate',       [BlogCategoryController::class, 'updateTranslate'])->name('updateTranslate');
    });

    // ─── Blog Etiketleri ────────────────────────────────────────────────────
    Route::prefix('blog-tags')->name('blogTags.')->group(function () {
        Route::get('/',              [BlogTagController::class, 'index'])->name('index');
        Route::get('/create',        [BlogTagController::class, 'create'])->name('create');
        Route::post('/store',        [BlogTagController::class, 'store'])->name('store');
        Route::get('/{id}/edit',     [BlogTagController::class, 'edit'])->name('edit');
        Route::post('/{id}/update',  [BlogTagController::class, 'update'])->name('update');
        Route::delete('/{id}',       [BlogTagController::class, 'delete'])->name('delete');
        Route::post('/update-order', [BlogTagController::class, 'updateOrder'])->name('updateOrder');
        Route::post('/{id}/toggle',  [BlogTagController::class, 'toggleActive'])->name('toggle');
        Route::get('/{id}/translate/{lang}', [BlogTagController::class, 'editTranslate'])->name('editTranslate');
        Route::post('/{id}/translate',       [BlogTagController::class, 'updateTranslate'])->name('updateTranslate');
    });

    // ─── Kurs Yönetimi (CRUD) ──────────────────────────────────────────────────
    Route::prefix('courses')->name('courses.')->group(function () {
        Route::get('/',              [CourseController::class, 'index'])->name('index');
        Route::get('/create',        [CourseController::class, 'create'])->name('create');
        Route::post('/store',        [CourseController::class, 'store'])->name('store');
        Route::get('/{id}/edit',     [CourseController::class, 'edit'])->name('edit');
        Route::post('/{id}/update',  [CourseController::class, 'update'])->name('update');
        Route::delete('/{id}',       [CourseController::class, 'delete'])->name('delete');
        Route::post('/update-order', [CourseController::class, 'updateOrder'])->name('updateOrder');
        Route::post('/{id}/toggle',  [CourseController::class, 'toggleActive'])->name('toggle');
        Route::get('/{id}/translate/{lang}', [CourseController::class, 'editTranslate'])->name('editTranslate');
        Route::post('/{id}/translate',       [CourseController::class, 'updateTranslate'])->name('updateTranslate');
    });

    // ─── Kurs Kategorileri ────────────────────────────────────────────────────
    Route::prefix('course-categories')->name('courseCategories.')->group(function () {
        Route::get('/',              [CourseCategoryController::class, 'index'])->name('index');
        Route::get('/create',        [CourseCategoryController::class, 'create'])->name('create');
        Route::post('/store',        [CourseCategoryController::class, 'store'])->name('store');
        Route::get('/{id}/edit',     [CourseCategoryController::class, 'edit'])->name('edit');
        Route::post('/{id}/update',  [CourseCategoryController::class, 'update'])->name('update');
        Route::delete('/{id}',       [CourseCategoryController::class, 'delete'])->name('delete');
        Route::post('/update-order', [CourseCategoryController::class, 'updateOrder'])->name('updateOrder');
        Route::post('/{id}/toggle',  [CourseCategoryController::class, 'toggleActive'])->name('toggle');
        Route::get('/{id}/translate/{lang}', [CourseCategoryController::class, 'editTranslate'])->name('editTranslate');
        Route::post('/{id}/translate',       [CourseCategoryController::class, 'updateTranslate'])->name('updateTranslate');
    });

    // ─── Sayfa Yönetimi ─────────────────────────────────────────────────────────
    Route::prefix('pages')->name('pages.')->group(function () {
        Route::get('/',                              [PagesController::class, 'index'])->name('index');
        Route::get('/edit/{id}',                     [PagesController::class, 'edit'])->name('edit');
        Route::post('/update/{id}',                  [PagesController::class, 'update'])->name('update');
        Route::get('/edit-translate/{lang}/{id}',    [PagesController::class, 'editTranslate'])->name('editTranslate');
        Route::post('/update-translate/{id}',        [PagesController::class, 'updateTranslate'])->name('updateTranslate');
        Route::post('/upload-image',                 [PagesController::class, 'uploadImage'])->name('uploadImage');
    });
});

// ─── Frontend Sayfaları ─────────────────────────────────────────────────────
Route::name('front.')->group(function () {
    Route::get('/',                [FrontController::class, 'home'])->name('home');
    Route::get('/hakkimizda',      [FrontController::class, 'about'])->name('about');
    Route::get('/kurslar',         [FrontController::class, 'courses'])->name('courses');
    Route::get('/kurs-detay/{id}',  [FrontController::class, 'courseDetails'])->name('course.details');
    Route::get('/egitmenler',      [FrontController::class, 'teachers'])->name('teachers');
    Route::get('/egitmen-detay/{id}', [FrontController::class, 'teacherDetails'])->name('teacher.details');
    Route::get('/blog',            [FrontController::class, 'blog'])->name('blog');
    Route::get('/blog-detay/{id}',  [FrontController::class, 'blogDetails'])->name('blog.details');
    Route::get('/iletisim',        [FrontController::class, 'contact'])->name('contact');
    Route::get('/sss',             [FrontController::class, 'faq'])->name('faq');
    Route::get('/urunler',         [FrontController::class, 'products'])->name('products');
    Route::get('/urun-detay',      [FrontController::class, 'productDetails'])->name('product.details');
    Route::get('/sepet',           [FrontController::class, 'cart'])->name('cart');
    Route::get('/odeme',           [FrontController::class, 'checkout'])->name('checkout');
});
Route::get('/panel/login', function () {
    return view('auth.login');
})->name('login');
Route::post('/panel/login',  [UserController::class, 'login'])->name('loginPost');
Route::post('/panel/logout', [UserController::class, 'logout'])->name('logout');
