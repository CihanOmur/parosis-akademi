<a href="{{ route('front.course.details', $course->id) }}"
   class="group block h-full overflow-hidden rounded-lg transition-all duration-300 hover:shadow-md">
    <!-- Thumbnail -->
    <div class="relative block aspect-[4/3] overflow-hidden">
        @if($course->image)
            <img src="{{ asset($course->image) }}" alt="{{ $course->getTranslation('title', app()->getLocale()) }}" width="370" height="270" class="h-full w-full object-cover transition-all duration-300 group-hover:scale-105" />
        @else
            <div class="h-full w-full bg-gray-200 flex items-center justify-center">
                <svg class="w-16 h-16 text-gray-400" fill="none" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909M2.25 18V6a2.25 2.25 0 0 1 2.25-2.25h15A2.25 2.25 0 0 1 21.75 6v12A2.25 2.25 0 0 1 19.5 20.25H4.5A2.25 2.25 0 0 1 2.25 18Z"/>
                </svg>
            </div>
        @endif

        @if($course->categories->count())
            <div class="absolute left-3 top-3 right-3 flex flex-wrap gap-1.5">
                @foreach($course->categories as $cat)
                    <span class="inline-block rounded-[40px] bg-colorBrightGold px-3 py-1.5 text-xs leading-none text-colorBlackPearl">{{ $cat->name }}</span>
                @endforeach
            </div>
        @endif
    </div>
    <!-- Content: baslik + kisa aciklama -->
    <div class="bg-[#F5F5F5] px-5 py-6 text-center">
        <h3 class="font-title text-xl font-bold text-colorBlackPearl group-hover:text-colorPurpleBlue transition-colors">{{ $course->getTranslation('title', app()->getLocale()) }}</h3>
        @if($course->getTranslation('short_description', app()->getLocale()))
            <p class="mt-3 text-sm text-colorBlackPearl/70 line-clamp-2">{{ $course->getTranslation('short_description', app()->getLocale()) }}</p>
        @endif
    </div>
</a>
