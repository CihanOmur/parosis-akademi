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
use App\Http\Controllers\ClientLogo\ClientLogoController;
use App\Http\Controllers\Testimonial\TestimonialController;
use App\Http\Controllers\Slider\SliderController;
use App\Http\Controllers\Slider\SliderItemController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\MenuItem\MenuItemController;
use App\Http\Controllers\Shop\ProductCategoryController;
use App\Http\Controllers\Shop\ProductAttributeController;
use App\Http\Controllers\Shop\ProductController;
use App\Http\Controllers\Shop\OrderController;
use App\Http\Controllers\Shop\ShopFrontController;
use App\Http\Controllers\Shop\CartController;
use App\Http\Controllers\Shop\CheckoutController;
use App\Http\Controllers\Shop\CouponController;
use App\Http\Controllers\Front\ContactController;
use App\Http\Controllers\Settings\SettingsController;
use App\Http\Controllers\Settings\ValidationMessageController;
use App\Http\Controllers\SitemapController;
use App\Http\Middleware\SharedDatas;
use App\Http\Middleware\CheckMaintenanceMode;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', SharedDatas::class])->prefix('panel')->group(function () {

    Route::get('', [DashboardController::class, 'index'])->name('dashboard.index');

    // ─── Dil Yönetimi ───────────────────────────────────────────────────────────
    Route::prefix('languages')->name('languages.')->middleware('permission:language')->group(function () {
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
        Route::get('/{id}/edit',     [StudentController::class, 'edit'])->name('edit')->middleware('permission:student');
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
        Route::get('/',              [FaqController::class, 'index'])->name('index')->middleware('permission:content|content_delete');
        Route::get('/create',        [FaqController::class, 'create'])->name('create')->middleware('permission:content');
        Route::post('/store',        [FaqController::class, 'store'])->name('store')->middleware('permission:content');
        Route::get('/{id}/edit',     [FaqController::class, 'edit'])->name('edit')->middleware('permission:content');
        Route::post('/{id}/update',  [FaqController::class, 'update'])->name('update')->middleware('permission:content');
        Route::delete('/{id}',       [FaqController::class, 'delete'])->name('delete')->middleware('permission:content_delete');
        Route::post('/update-order', [FaqController::class, 'updateOrder'])->name('updateOrder')->middleware('permission:content');
        Route::post('/{id}/toggle',  [FaqController::class, 'toggleActive'])->name('toggle')->middleware('permission:content');
        Route::get('/{id}/translate/{lang}', [FaqController::class, 'editTranslate'])->name('editTranslate')->middleware('permission:content');
        Route::post('/{id}/translate',       [FaqController::class, 'updateTranslate'])->name('updateTranslate')->middleware('permission:content');
    });

    // ─── Eğitmen Yönetimi (CRUD) ────────────────────────────────────────────────
    Route::prefix('teachers')->name('teachers.')->group(function () {
        Route::get('/',              [TeacherController::class, 'index'])->name('index')->middleware('permission:content|content_delete');
        Route::get('/create',        [TeacherController::class, 'create'])->name('create')->middleware('permission:content');
        Route::post('/store',        [TeacherController::class, 'store'])->name('store')->middleware('permission:content');
        Route::get('/{id}/edit',     [TeacherController::class, 'edit'])->name('edit')->middleware('permission:content');
        Route::post('/{id}/update',  [TeacherController::class, 'update'])->name('update')->middleware('permission:content');
        Route::delete('/{id}',       [TeacherController::class, 'delete'])->name('delete')->middleware('permission:content_delete');
        Route::post('/update-order', [TeacherController::class, 'updateOrder'])->name('updateOrder')->middleware('permission:content');
        Route::post('/{id}/toggle',  [TeacherController::class, 'toggleActive'])->name('toggle')->middleware('permission:content');
        Route::get('/{id}/translate/{lang}', [TeacherController::class, 'editTranslate'])->name('editTranslate')->middleware('permission:content');
        Route::post('/{id}/translate',       [TeacherController::class, 'updateTranslate'])->name('updateTranslate')->middleware('permission:content');
    });

    // ─── Blog Yönetimi (CRUD) ────────────────────────────────────────────────
    Route::prefix('blogs')->name('blogs.')->group(function () {
        Route::get('/',              [BlogController::class, 'index'])->name('index')->middleware('permission:content|content_delete');
        Route::get('/create',        [BlogController::class, 'create'])->name('create')->middleware('permission:content');
        Route::post('/store',        [BlogController::class, 'store'])->name('store')->middleware('permission:content');
        Route::get('/{id}/edit',     [BlogController::class, 'edit'])->name('edit')->middleware('permission:content');
        Route::post('/{id}/update',  [BlogController::class, 'update'])->name('update')->middleware('permission:content');
        Route::delete('/{id}',       [BlogController::class, 'delete'])->name('delete')->middleware('permission:content_delete');
        Route::post('/update-order', [BlogController::class, 'updateOrder'])->name('updateOrder')->middleware('permission:content');
        Route::post('/{id}/toggle',  [BlogController::class, 'toggleActive'])->name('toggle')->middleware('permission:content');
        Route::get('/{id}/translate/{lang}', [BlogController::class, 'editTranslate'])->name('editTranslate')->middleware('permission:content');
        Route::post('/{id}/translate',       [BlogController::class, 'updateTranslate'])->name('updateTranslate')->middleware('permission:content');
    });

    // ─── Blog Kategorileri ──────────────────────────────────────────────────
    Route::prefix('blog-categories')->name('blogCategories.')->group(function () {
        Route::get('/',              [BlogCategoryController::class, 'index'])->name('index')->middleware('permission:content|content_delete');
        Route::get('/create',        [BlogCategoryController::class, 'create'])->name('create')->middleware('permission:content');
        Route::post('/store',        [BlogCategoryController::class, 'store'])->name('store')->middleware('permission:content');
        Route::get('/{id}/edit',     [BlogCategoryController::class, 'edit'])->name('edit')->middleware('permission:content');
        Route::post('/{id}/update',  [BlogCategoryController::class, 'update'])->name('update')->middleware('permission:content');
        Route::delete('/{id}',       [BlogCategoryController::class, 'delete'])->name('delete')->middleware('permission:content_delete');
        Route::post('/update-order', [BlogCategoryController::class, 'updateOrder'])->name('updateOrder')->middleware('permission:content');
        Route::post('/{id}/toggle',  [BlogCategoryController::class, 'toggleActive'])->name('toggle')->middleware('permission:content');
        Route::get('/{id}/translate/{lang}', [BlogCategoryController::class, 'editTranslate'])->name('editTranslate')->middleware('permission:content');
        Route::post('/{id}/translate',       [BlogCategoryController::class, 'updateTranslate'])->name('updateTranslate')->middleware('permission:content');
    });

    // ─── Blog Etiketleri ────────────────────────────────────────────────────
    Route::prefix('blog-tags')->name('blogTags.')->group(function () {
        Route::get('/',              [BlogTagController::class, 'index'])->name('index')->middleware('permission:content|content_delete');
        Route::get('/create',        [BlogTagController::class, 'create'])->name('create')->middleware('permission:content');
        Route::post('/store',        [BlogTagController::class, 'store'])->name('store')->middleware('permission:content');
        Route::get('/{id}/edit',     [BlogTagController::class, 'edit'])->name('edit')->middleware('permission:content');
        Route::post('/{id}/update',  [BlogTagController::class, 'update'])->name('update')->middleware('permission:content');
        Route::delete('/{id}',       [BlogTagController::class, 'delete'])->name('delete')->middleware('permission:content_delete');
        Route::post('/update-order', [BlogTagController::class, 'updateOrder'])->name('updateOrder')->middleware('permission:content');
        Route::post('/{id}/toggle',  [BlogTagController::class, 'toggleActive'])->name('toggle')->middleware('permission:content');
        Route::get('/{id}/translate/{lang}', [BlogTagController::class, 'editTranslate'])->name('editTranslate')->middleware('permission:content');
        Route::post('/{id}/translate',       [BlogTagController::class, 'updateTranslate'])->name('updateTranslate')->middleware('permission:content');
    });

    // ─── Kurs Yönetimi (CRUD) ──────────────────────────────────────────────────
    Route::prefix('courses')->name('courses.')->group(function () {
        Route::get('/',              [CourseController::class, 'index'])->name('index')->middleware('permission:content|content_delete');
        Route::get('/create',        [CourseController::class, 'create'])->name('create')->middleware('permission:content');
        Route::post('/store',        [CourseController::class, 'store'])->name('store')->middleware('permission:content');
        Route::get('/{id}/edit',     [CourseController::class, 'edit'])->name('edit')->middleware('permission:content');
        Route::post('/{id}/update',  [CourseController::class, 'update'])->name('update')->middleware('permission:content');
        Route::delete('/{id}',       [CourseController::class, 'delete'])->name('delete')->middleware('permission:content_delete');
        Route::post('/update-order', [CourseController::class, 'updateOrder'])->name('updateOrder')->middleware('permission:content');
        Route::post('/{id}/toggle',  [CourseController::class, 'toggleActive'])->name('toggle')->middleware('permission:content');
        Route::get('/{id}/translate/{lang}', [CourseController::class, 'editTranslate'])->name('editTranslate')->middleware('permission:content');
        Route::post('/{id}/translate',       [CourseController::class, 'updateTranslate'])->name('updateTranslate')->middleware('permission:content');
    });

    // ─── Kurs Kategorileri ────────────────────────────────────────────────────
    Route::prefix('course-categories')->name('courseCategories.')->group(function () {
        Route::get('/',              [CourseCategoryController::class, 'index'])->name('index')->middleware('permission:content|content_delete');
        Route::get('/create',        [CourseCategoryController::class, 'create'])->name('create')->middleware('permission:content');
        Route::post('/store',        [CourseCategoryController::class, 'store'])->name('store')->middleware('permission:content');
        Route::get('/{id}/edit',     [CourseCategoryController::class, 'edit'])->name('edit')->middleware('permission:content');
        Route::post('/{id}/update',  [CourseCategoryController::class, 'update'])->name('update')->middleware('permission:content');
        Route::delete('/{id}',       [CourseCategoryController::class, 'delete'])->name('delete')->middleware('permission:content_delete');
        Route::post('/update-order', [CourseCategoryController::class, 'updateOrder'])->name('updateOrder')->middleware('permission:content');
        Route::post('/{id}/toggle',  [CourseCategoryController::class, 'toggleActive'])->name('toggle')->middleware('permission:content');
        Route::get('/{id}/translate/{lang}', [CourseCategoryController::class, 'editTranslate'])->name('editTranslate')->middleware('permission:content');
        Route::post('/{id}/translate',       [CourseCategoryController::class, 'updateTranslate'])->name('updateTranslate')->middleware('permission:content');
    });

    // ─── Öğrenci Yorumları ───────────────────────────────────────────────────────
    Route::prefix('testimonials')->name('testimonials.')->group(function () {
        Route::get('/',              [TestimonialController::class, 'index'])->name('index')->middleware('permission:content|content_delete');
        Route::get('/create',        [TestimonialController::class, 'create'])->name('create')->middleware('permission:content');
        Route::post('/store',        [TestimonialController::class, 'store'])->name('store')->middleware('permission:content');
        Route::get('/{id}/edit',     [TestimonialController::class, 'edit'])->name('edit')->middleware('permission:content');
        Route::post('/{id}/update',  [TestimonialController::class, 'update'])->name('update')->middleware('permission:content');
        Route::delete('/{id}',       [TestimonialController::class, 'delete'])->name('delete')->middleware('permission:content_delete');
        Route::post('/update-order', [TestimonialController::class, 'updateOrder'])->name('updateOrder')->middleware('permission:content');
        Route::post('/{id}/toggle',  [TestimonialController::class, 'toggleActive'])->name('toggle')->middleware('permission:content');
        Route::get('/{id}/translate/{lang}', [TestimonialController::class, 'editTranslate'])->name('editTranslate')->middleware('permission:content');
        Route::post('/{id}/translate',       [TestimonialController::class, 'updateTranslate'])->name('updateTranslate')->middleware('permission:content');
    });

    // ─── İş Ortağı Logoları ──────────────────────────────────────────────────────
    Route::prefix('client-logos')->name('client-logos.')->group(function () {
        Route::get('/',              [ClientLogoController::class, 'index'])->name('index')->middleware('permission:content|content_delete');
        Route::get('/create',        [ClientLogoController::class, 'create'])->name('create')->middleware('permission:content');
        Route::post('/store',        [ClientLogoController::class, 'store'])->name('store')->middleware('permission:content');
        Route::get('/{id}/edit',     [ClientLogoController::class, 'edit'])->name('edit')->middleware('permission:content');
        Route::post('/{id}/update',  [ClientLogoController::class, 'update'])->name('update')->middleware('permission:content');
        Route::delete('/{id}',       [ClientLogoController::class, 'delete'])->name('delete')->middleware('permission:content_delete');
        Route::post('/update-order', [ClientLogoController::class, 'updateOrder'])->name('updateOrder')->middleware('permission:content');
        Route::post('/{id}/toggle',  [ClientLogoController::class, 'toggleActive'])->name('toggle')->middleware('permission:content');
    });

    // ─── Slider Yönetimi ────────────────────────────────────────────────────────
    Route::prefix('sliders')->name('sliders.')->group(function () {
        Route::get('/',              [SliderController::class, 'index'])->name('index')->middleware('permission:content|content_delete');
        Route::get('/create',        [SliderController::class, 'create'])->name('create')->middleware('permission:content');
        Route::post('/store',        [SliderController::class, 'store'])->name('store')->middleware('permission:content');
        Route::get('/{id}/edit',     [SliderController::class, 'edit'])->name('edit')->middleware('permission:content');
        Route::post('/{id}/update',  [SliderController::class, 'update'])->name('update')->middleware('permission:content');
        Route::delete('/{id}',       [SliderController::class, 'delete'])->name('delete')->middleware('permission:content_delete');
        Route::post('/update-order', [SliderController::class, 'updateOrder'])->name('updateOrder')->middleware('permission:content');
        Route::post('/{id}/toggle',  [SliderController::class, 'toggleActive'])->name('toggle')->middleware('permission:content');

        // Slider Items
        Route::prefix('/{sliderId}/items')->name('items.')->middleware('permission:content')->group(function () {
            Route::get('/',              [SliderItemController::class, 'index'])->name('index');
            Route::get('/create',        [SliderItemController::class, 'create'])->name('create');
            Route::post('/store',        [SliderItemController::class, 'store'])->name('store');
            Route::get('/{id}/edit',     [SliderItemController::class, 'edit'])->name('edit');
            Route::post('/{id}/update',  [SliderItemController::class, 'update'])->name('update');
            Route::delete('/{id}',       [SliderItemController::class, 'delete'])->name('delete');
            Route::post('/update-order', [SliderItemController::class, 'updateOrder'])->name('updateOrder');
            Route::post('/{id}/toggle',  [SliderItemController::class, 'toggleActive'])->name('toggle');
            Route::get('/{id}/translate/{lang}', [SliderItemController::class, 'editTranslate'])->name('editTranslate');
            Route::post('/{id}/translate',       [SliderItemController::class, 'updateTranslate'])->name('updateTranslate');
        });
    });

    // ─── UI Referans ──────────────────────────────────────────────────────────
    Route::get('/reference', function () {
        return view('admin.reference.index');
    })->name('reference.index');

    // ─── Menü Öğeleri ──────────────────────────────────────────────────────────
    Route::prefix('menu-items')->name('menu-items.')->middleware('permission:menu')->group(function () {
        Route::get('/',                        [MenuItemController::class, 'index'])->name('index');
        Route::get('/create',                  [MenuItemController::class, 'create'])->name('create');
        Route::post('/store',                  [MenuItemController::class, 'store'])->name('store');
        Route::get('/{id}/edit',               [MenuItemController::class, 'edit'])->name('edit');
        Route::post('/{id}/update',            [MenuItemController::class, 'update'])->name('update');
        Route::delete('/{id}',                 [MenuItemController::class, 'delete'])->name('delete');
        Route::post('/update-order',           [MenuItemController::class, 'updateOrder'])->name('updateOrder');
        Route::post('/{id}/toggle',            [MenuItemController::class, 'toggleActive'])->name('toggle');
        Route::post('/{id}/indent',            [MenuItemController::class, 'indent'])->name('indent');
        Route::post('/{id}/outdent',           [MenuItemController::class, 'outdent'])->name('outdent');
        Route::get('/{id}/translate/{lang}',   [MenuItemController::class, 'editTranslate'])->name('editTranslate');
        Route::post('/{id}/translate',         [MenuItemController::class, 'updateTranslate'])->name('updateTranslate');
    });

    // ─── Ürün Kategorileri ──────────────────────────────────────────────────────
    Route::prefix('product-categories')->name('productCategories.')->group(function () {
        Route::get('/',              [ProductCategoryController::class, 'index'])->name('index')->middleware('permission:shop|shop_delete');
        Route::get('/create',        [ProductCategoryController::class, 'create'])->name('create')->middleware('permission:shop');
        Route::post('/store',        [ProductCategoryController::class, 'store'])->name('store')->middleware('permission:shop');
        Route::get('/{id}/edit',     [ProductCategoryController::class, 'edit'])->name('edit')->middleware('permission:shop');
        Route::post('/{id}/update',  [ProductCategoryController::class, 'update'])->name('update')->middleware('permission:shop');
        Route::delete('/{id}',       [ProductCategoryController::class, 'delete'])->name('delete')->middleware('permission:shop_delete');
        Route::post('/update-order', [ProductCategoryController::class, 'updateOrder'])->name('updateOrder')->middleware('permission:shop');
        Route::post('/{id}/toggle',  [ProductCategoryController::class, 'toggleActive'])->name('toggle')->middleware('permission:shop');
        Route::get('/{id}/translate/{lang}',  [ProductCategoryController::class, 'editTranslate'])->name('editTranslate')->middleware('permission:shop');
        Route::post('/{id}/translate',        [ProductCategoryController::class, 'updateTranslate'])->name('updateTranslate')->middleware('permission:shop');
    });

    // ─── Ürün Nitelikleri ───────────────────────────────────────────────────────
    Route::prefix('product-attributes')->name('productAttributes.')->group(function () {
        Route::get('/',              [ProductAttributeController::class, 'index'])->name('index')->middleware('permission:shop|shop_delete');
        Route::get('/create',        [ProductAttributeController::class, 'create'])->name('create')->middleware('permission:shop');
        Route::post('/store',        [ProductAttributeController::class, 'store'])->name('store')->middleware('permission:shop');
        Route::get('/{id}/edit',     [ProductAttributeController::class, 'edit'])->name('edit')->middleware('permission:shop');
        Route::post('/{id}/update',  [ProductAttributeController::class, 'update'])->name('update')->middleware('permission:shop');
        Route::delete('/{id}',       [ProductAttributeController::class, 'delete'])->name('delete')->middleware('permission:shop_delete');
        Route::post('/update-order', [ProductAttributeController::class, 'updateOrder'])->name('updateOrder')->middleware('permission:shop');
        Route::post('/{id}/toggle',  [ProductAttributeController::class, 'toggleActive'])->name('toggle')->middleware('permission:shop');
        Route::get('/{id}/translate/{lang}',  [ProductAttributeController::class, 'editTranslate'])->name('editTranslate')->middleware('permission:shop');
        Route::post('/{id}/translate',        [ProductAttributeController::class, 'updateTranslate'])->name('updateTranslate')->middleware('permission:shop');
        // Attribute values
        Route::post('/{id}/values/store',       [ProductAttributeController::class, 'storeValue'])->name('values.store')->middleware('permission:shop');
        Route::post('/values/{valueId}/update', [ProductAttributeController::class, 'updateValue'])->name('values.update')->middleware('permission:shop');
        Route::delete('/values/{valueId}',      [ProductAttributeController::class, 'deleteValue'])->name('values.delete')->middleware('permission:shop_delete');
        Route::post('/values/{valueId}/toggle', [ProductAttributeController::class, 'toggleValue'])->name('values.toggle')->middleware('permission:shop');
    });

    // ─── Ürünler ────────────────────────────────────────────────────────────────
    Route::prefix('products')->name('products.')->group(function () {
        Route::get('/',              [ProductController::class, 'index'])->name('index')->middleware('permission:shop|shop_delete');
        Route::get('/create',        [ProductController::class, 'create'])->name('create')->middleware('permission:shop');
        Route::post('/store',        [ProductController::class, 'store'])->name('store')->middleware('permission:shop');
        Route::get('/{id}/edit',     [ProductController::class, 'edit'])->name('edit')->middleware('permission:shop');
        Route::post('/{id}/update',  [ProductController::class, 'update'])->name('update')->middleware('permission:shop');
        Route::delete('/{id}',       [ProductController::class, 'delete'])->name('delete')->middleware('permission:shop_delete');
        Route::post('/update-order', [ProductController::class, 'updateOrder'])->name('updateOrder')->middleware('permission:shop');
        Route::post('/{id}/toggle',  [ProductController::class, 'toggleActive'])->name('toggle')->middleware('permission:shop');
        Route::get('/{id}/translate/{lang}',  [ProductController::class, 'editTranslate'])->name('editTranslate')->middleware('permission:shop');
        Route::post('/{id}/translate',        [ProductController::class, 'updateTranslate'])->name('updateTranslate')->middleware('permission:shop');
        // Variants
        Route::post('/{id}/generate-variants', [ProductController::class, 'generateVariants'])->name('generateVariants')->middleware('permission:shop');
        Route::post('/{id}/update-variants',   [ProductController::class, 'updateVariants'])->name('updateVariants')->middleware('permission:shop');
        Route::delete('/variants/{variantId}', [ProductController::class, 'deleteVariant'])->name('variants.delete')->middleware('permission:shop_delete');
        // Gallery
        Route::post('/{id}/upload-gallery',    [ProductController::class, 'uploadGallery'])->name('uploadGallery')->middleware('permission:shop');
        Route::delete('/images/{imageId}',     [ProductController::class, 'deleteImage'])->name('images.delete')->middleware('permission:shop');
        Route::post('/images/update-order',    [ProductController::class, 'updateImageOrder'])->name('images.updateOrder')->middleware('permission:shop');
    });

    // ─── Siparişler ─────────────────────────────────────────────────────────────
    Route::prefix('siparisler')->name('orders.')->group(function () {
        Route::get('/',              [OrderController::class, 'index'])->name('index')->middleware('permission:shop|shop_delete');
        Route::get('/{id}',          [OrderController::class, 'show'])->name('show')->middleware('permission:shop');
        Route::post('/{id}/status',  [OrderController::class, 'updateStatus'])->name('updateStatus')->middleware('permission:shop');
        Route::delete('/{id}',       [OrderController::class, 'delete'])->name('delete')->middleware('permission:shop_delete');
    });

    // ─── İndirim Kuponları ────────────────────────────────────────────────────────
    Route::prefix('kuponlar')->name('coupons.')->group(function () {
        Route::get('/',              [CouponController::class, 'index'])->name('index')->middleware('permission:shop|shop_delete');
        Route::get('/create',        [CouponController::class, 'create'])->name('create')->middleware('permission:shop');
        Route::post('/store',        [CouponController::class, 'store'])->name('store')->middleware('permission:shop');
        Route::get('/{id}/edit',     [CouponController::class, 'edit'])->name('edit')->middleware('permission:shop');
        Route::post('/{id}/update',  [CouponController::class, 'update'])->name('update')->middleware('permission:shop');
        Route::delete('/{id}',       [CouponController::class, 'delete'])->name('delete')->middleware('permission:shop_delete');
        Route::post('/{id}/toggle',  [CouponController::class, 'toggleActive'])->name('toggle')->middleware('permission:shop');
    });

    // ─── Sayfa Yönetimi ─────────────────────────────────────────────────────────
    Route::prefix('pages')->name('pages.')->middleware('permission:page')->group(function () {
        Route::get('/',                              [PagesController::class, 'index'])->name('index');
        Route::get('/edit/{id}',                     [PagesController::class, 'edit'])->name('edit');
        Route::post('/update/{id}',                  [PagesController::class, 'update'])->name('update');
        Route::get('/edit-translate/{lang}/{id}',    [PagesController::class, 'editTranslate'])->name('editTranslate');
        Route::post('/update-translate/{id}',        [PagesController::class, 'updateTranslate'])->name('updateTranslate');
        Route::post('/upload-image',                 [PagesController::class, 'uploadImage'])->name('uploadImage');
    });

    // ─── Site Ayarları ──────────────────────────────────────────────────────────
    Route::prefix('settings')->name('settings.')->middleware('permission:settings')->group(function () {
        Route::get('/',               [SettingsController::class, 'index'])->name('index');
        Route::post('/general',       [SettingsController::class, 'updateGeneral'])->name('updateGeneral');
        Route::post('/logos',         [SettingsController::class, 'updateLogos'])->name('updateLogos');
        Route::post('/seo',           [SettingsController::class, 'updateSeo'])->name('updateSeo');
        Route::post('/mail',          [SettingsController::class, 'updateMail'])->name('updateMail');
        Route::post('/mail/test',     [SettingsController::class, 'testMail'])->name('testMail');
        Route::post('/social',        [SettingsController::class, 'updateSocial'])->name('updateSocial');
        Route::post('/advanced',      [SettingsController::class, 'updateAdvanced'])->name('updateAdvanced');

        // Sitemap Entries
        Route::post('/sitemap-entries',                [SettingsController::class, 'storeSitemapEntry'])->name('sitemapEntries.store');
        Route::put('/sitemap-entries/{sitemapEntry}',  [SettingsController::class, 'updateSitemapEntry'])->name('sitemapEntries.update');
        Route::patch('/sitemap-entries/{sitemapEntry}/toggle', [SettingsController::class, 'toggleSitemapEntry'])->name('sitemapEntries.toggle');
        Route::delete('/sitemap-entries/{sitemapEntry}', [SettingsController::class, 'destroySitemapEntry'])->name('sitemapEntries.destroy');

        // Doğrulama Mesajları
        Route::prefix('validation-messages')->name('validationMessages.')->group(function () {
            Route::get('/',                    [ValidationMessageController::class, 'index'])->name('index');
            Route::post('/form/{formKey}',     [ValidationMessageController::class, 'updateForm'])->name('updateForm');
            Route::post('/reset/{formKey}',    [ValidationMessageController::class, 'resetForm'])->name('resetForm');
        });
    });
});

// ─── Frontend Sayfaları ─────────────────────────────────────────────────────
Route::middleware([SharedDatas::class, CheckMaintenanceMode::class])->name('front.')->group(function () {
    Route::get('/',                [FrontController::class, 'home'])->name('home');
    Route::get('/hakkimizda',      [FrontController::class, 'about'])->name('about');
    Route::get('/ara',             [FrontController::class, 'search'])->name('search');
    Route::get('/ara/suggest',     [FrontController::class, 'searchSuggest'])->name('search.suggest');
    Route::get('/kurslar',         [FrontController::class, 'courses'])->name('courses');
    Route::get('/kurs-detay/{id}',  [FrontController::class, 'courseDetails'])->name('course.details');
    Route::get('/egitmenler',      [FrontController::class, 'teachers'])->name('teachers');
    Route::get('/egitmen-detay/{id}', [FrontController::class, 'teacherDetails'])->name('teacher.details');
    Route::get('/blog',            [FrontController::class, 'blog'])->name('blog');
    Route::get('/blog-detay/{id}',  [FrontController::class, 'blogDetails'])->name('blog.details');
    Route::get('/iletisim',        [FrontController::class, 'contact'])->name('contact');
    Route::post('/iletisim',       [ContactController::class, 'send'])->middleware('throttle:5,1')->name('contact.send');
    Route::get('/sss',             [FrontController::class, 'faq'])->name('faq');
    Route::get('/urunler',          [ShopFrontController::class, 'products'])->name('products');
    Route::get('/urun-detay/{id}',  [ShopFrontController::class, 'productDetails'])->name('product.details');
    Route::get('/sepet',            [CartController::class, 'show'])->name('cart');
    Route::get('/odeme',            [CheckoutController::class, 'show'])->name('checkout');
    Route::post('/sepet/ekle',      [CartController::class, 'add'])->name('cart.add');
    Route::post('/sepet/guncelle',  [CartController::class, 'update'])->name('cart.update');
    Route::post('/sepet/sil',       [CartController::class, 'remove'])->name('cart.remove');
    Route::post('/odeme/tamamla',   [CheckoutController::class, 'process'])->name('checkout.process');
    Route::post('/kupon-uygula',    [CheckoutController::class, 'applyCoupon'])->middleware('throttle:20,1')->name('coupon.apply');
    Route::post('/kupon-kaldir',    [CheckoutController::class, 'removeCoupon'])->name('coupon.remove');
});
Route::get('/panel/login', function () {
    return view('auth.login');
})->name('login');
Route::post('/panel/login',  [UserController::class, 'login'])->middleware('throttle:5,1')->name('loginPost');
Route::post('/panel/logout', [UserController::class, 'logout'])->name('logout');

// ─── Dynamic robots.txt ──────────────────────────────────────────────────────
Route::get('/robots.txt', function () {
    $default = "User-agent: *\nAllow: /";
    try {
        if (\Illuminate\Support\Facades\Schema::hasTable('settings')) {
            $content = \App\Models\Setting::get('robots_txt', $default, 'seo');
            $sitemap = \App\Models\Setting::get('sitemap_url', '', 'seo');
            if ($sitemap) {
                $sitemapUrl = str_starts_with($sitemap, 'http') ? $sitemap : url($sitemap);
                $content .= "\n\nSitemap: " . $sitemapUrl;
            }
            return response($content, 200)->header('Content-Type', 'text/plain');
        }
    } catch (\Exception $e) {}
    return response($default, 200)->header('Content-Type', 'text/plain');
})->name('robots');

// ─── Dynamic sitemap.xml ─────────────────────────────────────────────────────
Route::get('/sitemap.xml', [SitemapController::class, 'index'])->name('sitemap');
