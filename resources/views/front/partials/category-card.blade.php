<a href="{{ route('front.courses') }}" class="flex items-center gap-6 rounded-[100px] bg-white p-[10px] transition-all duration-300 hover:shadow-lg">
    <div class="inline-flex h-[72px] w-[72px] items-center justify-center rounded-[50%]" style="background-color: {{ ($category->color ?? '#543EE4') . '1a' }}">
        @if($category->icon)
            <img src="{{ asset($category->icon) }}" alt="{{ $category->name }}" width="30" height="30" />
        @else
            <svg class="w-[30px] h-[30px]" style="color: {{ $category->color ?? '#543EE4' }}" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M4.26 10.147a60.438 60.438 0 0 0-.491 6.347A48.62 48.62 0 0 1 12 20.904a48.62 48.62 0 0 1 8.232-4.41 60.46 60.46 0 0 0-.491-6.347m-15.482 0a50.636 50.636 0 0 0-2.658-.813A59.906 59.906 0 0 1 12 3.493a59.903 59.903 0 0 1 10.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.717 50.717 0 0 1 12 13.489a50.702 50.702 0 0 1 7.74-3.342"/>
            </svg>
        @endif
    </div>
    <div class="flex-1">
        <span class="mb-1 block font-title text-xl font-bold text-colorBlackPearl">{{ $category->name }}</span>
        <span class="text-sm">{{ $category->courses_count }} Kurs</span>
    </div>
</a>
