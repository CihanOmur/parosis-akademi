@extends('front.layouts.app')

@section('title', 'Parosis Akademi | Arama' . ($search ? ': ' . e($search) : ''))

@section('content')
    <!--...::: Breadcrumb Section Start :::... -->
    <section class="section-breadcrum">
        <div class="relative z-10 overflow-hidden bg-[#FAF9F6]">
            <div class="py-[60px] lg:py-[90px]">
                <div class="container">
                    <div class="text-center">
                        <h1 class="mb-5 text-4xl capitalize tracking-normal">Arama Sonuçları</h1>
                        @if($search)
                            <p class="text-lg text-slate-600">"<strong>{{ $search }}</strong>" için
                                @php $total = $courses->count() + $blogs->count() + $teachers->count(); @endphp
                                @if($total > 0)
                                    <span class="font-semibold text-colorPurpleBlue">{{ $total }}</span> sonuç bulundu
                                @else
                                    sonuç bulunamadı
                                @endif
                            </p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--...::: Breadcrumb Section End :::... -->

    <section class="pb-64 pt-16 lg:pt-20">
        <div class="container">

            @if(!$search || mb_strlen($search) < 2)
                <div class="text-center py-12">
                    <svg class="mx-auto h-16 w-16 text-slate-300 mb-4" fill="none" stroke="currentColor" stroke-width="1" viewBox="0 0 24 24">
                        <circle cx="11" cy="11" r="8"/>
                        <path stroke-linecap="round" d="m21 21-4.35-4.35"/>
                    </svg>
                    <p class="text-lg text-slate-500">Aramak istediğiniz kelimeyi yazın (en az 2 karakter)</p>
                </div>
            @elseif($courses->isEmpty() && $blogs->isEmpty() && $teachers->isEmpty())
                <div class="text-center py-12">
                    <svg class="mx-auto h-16 w-16 text-slate-300 mb-4" fill="none" stroke="currentColor" stroke-width="1" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.182 16.318A4.486 4.486 0 0 0 12.016 15a4.486 4.486 0 0 0-3.198 1.318M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0ZM9.75 9.75c0 .414-.168.75-.375.75S9 10.164 9 9.75 9.168 9 9.375 9s.375.336.375.75Zm-.375 0h.008v.015h-.008V9.75Zm5.625 0c0 .414-.168.75-.375.75s-.375-.336-.375-.75.168-.75.375-.75.375.336.375.75Zm-.375 0h.008v.015h-.008V9.75Z"/>
                    </svg>
                    <p class="text-lg text-slate-500">"<strong>{{ $search }}</strong>" için sonuç bulunamadı</p>
                    <p class="mt-2 text-sm text-slate-400">Farklı anahtar kelimeler deneyebilirsiniz</p>

                    {{-- Suggestions --}}
                    <div class="mt-8">
                        <p class="mb-3 text-sm font-medium text-slate-500">Popüler aramalar:</p>
                        <div class="flex flex-wrap justify-center gap-2">
                            @foreach(['Web', 'Tasarım', 'Pazarlama', 'Python', 'React'] as $suggestion)
                            <a href="{{ route('front.search', ['q' => $suggestion]) }}"
                               class="rounded-full border border-slate-200 px-4 py-2 text-sm text-slate-600 hover:border-colorPurpleBlue hover:text-colorPurpleBlue transition-colors">
                                {{ $suggestion }}
                            </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            @else
                {{-- Courses --}}
                @if($courses->isNotEmpty())
                <div class="mb-16">
                    <div class="mb-8 flex items-center justify-between">
                        <h2 class="text-2xl font-bold text-colorBlackPearl">
                            Kurslar
                            <span class="ml-2 inline-flex items-center rounded-full bg-colorPurpleBlue/10 px-3 py-1 text-sm font-medium text-colorPurpleBlue">{{ $courses->count() }}</span>
                        </h2>
                        <a href="{{ route('front.courses', ['q' => $search]) }}" class="text-sm font-medium text-colorPurpleBlue hover:underline">Tümünü Gör &rarr;</a>
                    </div>
                    <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                        @foreach($courses as $course)
                        <div class="group overflow-hidden rounded-2xl border border-slate-100 bg-white shadow-sm transition-all hover:shadow-lg">
                            <a href="{{ route('front.course.details', $course->id) }}" class="relative block aspect-[16/10] overflow-hidden bg-slate-100">
                                @if($course->image)
                                    <img src="{{ asset($course->image) }}" alt="{{ $course->getTranslation('title', app()->getLocale()) }}" class="h-full w-full object-cover transition-transform duration-300 group-hover:scale-105" />
                                @else
                                    <div class="flex h-full items-center justify-center text-slate-300">
                                        <svg class="h-12 w-12" fill="none" stroke="currentColor" stroke-width="1" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909M2.25 18V6a2.25 2.25 0 0 1 2.25-2.25h15A2.25 2.25 0 0 1 21.75 6v12A2.25 2.25 0 0 1 19.5 20.25H4.5A2.25 2.25 0 0 1 2.25 18Z"/>
                                        </svg>
                                    </div>
                                @endif
                                @if($course->categories->count())
                                    <span class="absolute left-3 top-3 inline-block rounded-full bg-colorBrightGold px-3 py-1 text-xs font-medium text-colorBlackPearl">{{ $course->categories->first()->name }}</span>
                                @endif
                            </a>
                            <div class="p-5">
                                <a href="{{ route('front.course.details', $course->id) }}" class="mb-2 block text-lg font-bold text-colorBlackPearl hover:text-colorPurpleBlue transition-colors">
                                    {{ $course->getTranslation('title', app()->getLocale()) }}
                                </a>
                                @if($course->getTranslation('short_description', app()->getLocale()))
                                <p class="line-clamp-2 text-sm text-slate-500">{{ $course->getTranslation('short_description', app()->getLocale()) }}</p>
                                @endif
                                <div class="mt-4 flex items-center gap-3 text-xs text-slate-400">
                                    @if($course->lesson_count)
                                    <span class="inline-flex items-center gap-1">
                                        <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 0 0 6 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 0 1 6 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 0 1 6-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0 0 18 18a8.967 8.967 0 0 0-6 2.292m0-14.25v14.25"/></svg>
                                        {{ $course->lesson_count }} Ders
                                    </span>
                                    @endif
                                    @if($course->instructor_name)
                                    <span class="inline-flex items-center gap-1">
                                        <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z"/></svg>
                                        {{ $course->instructor_name }}
                                    </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif

                {{-- Teachers --}}
                @if($teachers->isNotEmpty())
                <div class="mb-16">
                    <div class="mb-8 flex items-center justify-between">
                        <h2 class="text-2xl font-bold text-colorBlackPearl">
                            Eğitmenler
                            <span class="ml-2 inline-flex items-center rounded-full bg-colorPurpleBlue/10 px-3 py-1 text-sm font-medium text-colorPurpleBlue">{{ $teachers->count() }}</span>
                        </h2>
                        <a href="{{ route('front.teachers') }}" class="text-sm font-medium text-colorPurpleBlue hover:underline">Tümünü Gör &rarr;</a>
                    </div>
                    <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                        @foreach($teachers as $teacher)
                        <a href="{{ route('front.teacher.details', $teacher->id) }}" class="group flex items-center gap-4 rounded-2xl border border-slate-100 bg-white p-5 shadow-sm transition-all hover:shadow-lg">
                            <div class="h-16 w-16 flex-shrink-0 overflow-hidden rounded-full bg-slate-100">
                                @if($teacher->image)
                                    <img src="{{ asset($teacher->image) }}" alt="{{ $teacher->getTranslation('name', app()->getLocale()) }}" class="h-full w-full object-cover" />
                                @else
                                    <div class="flex h-full w-full items-center justify-center text-slate-300">
                                        <svg class="h-8 w-8" fill="none" stroke="currentColor" stroke-width="1" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z"/></svg>
                                    </div>
                                @endif
                            </div>
                            <div>
                                <h3 class="font-bold text-colorBlackPearl group-hover:text-colorPurpleBlue transition-colors">{{ $teacher->getTranslation('name', app()->getLocale()) }}</h3>
                                @if($teacher->getTranslation('title', app()->getLocale()))
                                <p class="text-sm text-slate-500">{{ $teacher->getTranslation('title', app()->getLocale()) }}</p>
                                @endif
                            </div>
                        </a>
                        @endforeach
                    </div>
                </div>
                @endif

                {{-- Blogs --}}
                @if($blogs->isNotEmpty())
                <div>
                    <div class="mb-8 flex items-center justify-between">
                        <h2 class="text-2xl font-bold text-colorBlackPearl">
                            Blog Yazıları
                            <span class="ml-2 inline-flex items-center rounded-full bg-colorPurpleBlue/10 px-3 py-1 text-sm font-medium text-colorPurpleBlue">{{ $blogs->count() }}</span>
                        </h2>
                        <a href="{{ route('front.blog') }}" class="text-sm font-medium text-colorPurpleBlue hover:underline">Tümünü Gör &rarr;</a>
                    </div>
                    <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                        @foreach($blogs as $blog)
                        <div class="group overflow-hidden rounded-2xl border border-slate-100 bg-white shadow-sm transition-all hover:shadow-lg">
                            <a href="{{ route('front.blog.details', $blog->id) }}" class="relative block aspect-[16/10] overflow-hidden bg-slate-100">
                                @if($blog->image)
                                    <img src="{{ asset($blog->image) }}" alt="{{ $blog->getTranslation('title', app()->getLocale()) }}" class="h-full w-full object-cover transition-transform duration-300 group-hover:scale-105" />
                                @else
                                    <div class="flex h-full items-center justify-center text-slate-300">
                                        <svg class="h-12 w-12" fill="none" stroke="currentColor" stroke-width="1" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909M2.25 18V6a2.25 2.25 0 0 1 2.25-2.25h15A2.25 2.25 0 0 1 21.75 6v12A2.25 2.25 0 0 1 19.5 20.25H4.5A2.25 2.25 0 0 1 2.25 18Z"/>
                                        </svg>
                                    </div>
                                @endif
                                @if($blog->categories->count())
                                    <span class="absolute left-3 top-3 inline-block rounded-full bg-colorBrightGold px-3 py-1 text-xs font-medium text-colorBlackPearl">{{ $blog->categories->first()->name }}</span>
                                @endif
                            </a>
                            <div class="p-5">
                                <a href="{{ route('front.blog.details', $blog->id) }}" class="mb-2 block text-lg font-bold text-colorBlackPearl hover:text-colorPurpleBlue transition-colors">
                                    {{ $blog->getTranslation('title', app()->getLocale()) }}
                                </a>
                                @if($blog->getTranslation('short_description', app()->getLocale()))
                                <p class="line-clamp-2 text-sm text-slate-500">{{ $blog->getTranslation('short_description', app()->getLocale()) }}</p>
                                @endif
                                @if($blog->published_at)
                                <p class="mt-3 text-xs text-slate-400">{{ \Carbon\Carbon::parse($blog->published_at)->translatedFormat('d F Y') }}</p>
                                @endif
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif
            @endif
        </div>
    </section>
@endsection
