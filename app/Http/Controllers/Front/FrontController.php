<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Faq\Faq;
use App\Models\Pages\Contact\ContactPageInfo;
use App\Models\Blogs\Blog;
use App\Models\Blogs\BlogCategory;
use App\Models\Blogs\BlogTag;
use App\Models\Pages\Blog\BlogPageInfo;
use App\Models\Pages\Faq\FaqPageInfo;
use App\Models\Pages\Teacher\TeacherPageInfo;
use App\Models\Teacher\Teacher;

class FrontController extends Controller
{
    public function home()
    {
        return view('front.pages.home', ['headerStyle' => 'home']);
    }

    public function about()
    {
        return view('front.pages.about');
    }

    public function courses()
    {
        return view('front.pages.courses');
    }

    public function courseDetails()
    {
        return view('front.pages.course-details');
    }

    public function teachers()
    {
        $teacherPageInfo = TeacherPageInfo::first();
        $teachers = Teacher::where('is_active', true)->orderBy('sort_order')->get();
        $ctaInfo = $teacherPageInfo;
        return view('front.pages.teachers', compact('teacherPageInfo', 'teachers', 'ctaInfo'));
    }

    public function teacherDetails($id)
    {
        $teacherPageInfo = TeacherPageInfo::first();
        $teacher = Teacher::findOrFail($id);
        $ctaInfo = $teacherPageInfo;
        return view('front.pages.teacher-details', compact('teacherPageInfo', 'teacher', 'ctaInfo'));
    }

    public function blog()
    {
        $blogPageInfo = BlogPageInfo::first();
        $blogs = Blog::with(['categories', 'blogTags'])->where('is_active', true)->orderBy('sort_order')->get();
        $ctaInfo = $blogPageInfo;
        return view('front.pages.blog', compact('blogPageInfo', 'blogs', 'ctaInfo'));
    }

    public function blogDetails($id)
    {
        $blogPageInfo = BlogPageInfo::first();
        $blog = Blog::with(['categories', 'blogTags'])->findOrFail($id);

        // Popular blogs (latest 3, excluding current)
        $popularBlogs = Blog::with(['categories', 'blogTags'])
            ->where('is_active', true)
            ->where('id', '!=', $id)
            ->orderByDesc('published_at')
            ->take(3)
            ->get();

        // Categories with blog counts
        $categories = BlogCategory::where('is_active', true)
            ->withCount(['blogs' => fn($q) => $q->where('is_active', true)])
            ->orderBy('sort_order')
            ->get();

        // All active tags
        $tags = BlogTag::where('is_active', true)->orderBy('sort_order')->get();

        $ctaInfo = $blogPageInfo;
        return view('front.pages.blog-details', compact('blogPageInfo', 'blog', 'popularBlogs', 'categories', 'tags', 'ctaInfo'));
    }

    public function contact()
    {
        $contactInfo = ContactPageInfo::first();
        return view('front.pages.contact', compact('contactInfo'));
    }

    public function faq()
    {
        $faqPageInfo = FaqPageInfo::first();
        $faqs = Faq::where('is_active', true)->orderBy('sort_order')->get();
        $ctaInfo = $faqPageInfo;
        return view('front.pages.faq', compact('faqPageInfo', 'faqs', 'ctaInfo'));
    }

    public function products()
    {
        return view('front.pages.products');
    }

    public function productDetails()
    {
        return view('front.pages.product-details');
    }

    public function cart()
    {
        return view('front.pages.cart');
    }

    public function checkout()
    {
        return view('front.pages.checkout');
    }
}
