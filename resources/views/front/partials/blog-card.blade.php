<div class="group overflow-hidden rounded-lg transition-all duration-300">
    <!-- Thumbnail -->
    <div class="relative block aspect-[4/3] overflow-hidden rounded-[10px]">
        @if($blog->image)
            <img src="{{ asset($blog->image) }}" alt="{{ $blog->getTranslation('title', app()->getLocale()) }}" width="370" height="334" class="h-full w-full object-cover transition-all duration-300 group-hover:scale-105" />
        @else
            <img src="{{ asset('assets-front/img/images/th-1/blog-img-1.jpg') }}" alt="blog" width="370" height="334" class="h-full w-full object-cover transition-all duration-300 group-hover:scale-105" />
        @endif

        @if($blog->categories->count())
            <a href="{{ route('front.blog') }}" class="absolute bottom-4 left-4 inline-block rounded-[40px] bg-colorPurpleBlue px-3.5 py-3 text-sm leading-none text-white hover:bg-colorBlackPearl">{{ $blog->categories->first()->name }}</a>
        @endif
    </div>
    <!-- Content -->
    <div class="mt-7">
        <!-- Blog Meta -->
        <div class="flex gap-9">
            @if($blog->published_at)
            <span class="inline-flex items-center gap-1.5 text-sm">
                <img src="{{ asset('assets-front/img/icons/icon-grey-calendar.svg') }}" alt="icon-grey-calendar" width="23" height="23" />
                <span class="flex-1">{{ $blog->published_at->format('d M, Y') }}</span>
            </span>
            @endif
        </div>
        <!-- Title Link -->
        <a href="{{ route('front.blog.details', $blog->id) }}" class="my-6 block font-title text-xl font-bold text-colorBlackPearl hover:text-colorPurpleBlue">{{ $blog->getTranslation('title', app()->getLocale()) }}</a>
    </div>
</div>
