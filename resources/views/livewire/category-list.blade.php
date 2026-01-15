<div
    class="flex overflow-x-auto gap-2 md:gap-6 md:grid md:grid-cols-5 &::-webkit-scrollbar]:hidden [-ms-overflow-style:none] [scrollbar-width:none]">
    @foreach ($categories as $category)
        <div class="text-center shrink-0 w-20 md:w-auto">
            @if ($category->logo_url)
                <a href="{{ route('product-category', ['id' => $category->id]) }}"
                    class="w-16 h-16 md:w-32 md:h-32 p-3 md:p-7 bg-green-600 rounded-full flex items-center justify-center text-white mx-auto text-2xl md:text-3xl cursor-pointer">
                    <img src="{{ asset('storage/' . $category->logo_url) }}" alt="{{ $category->name }}"
                        class="w-full h-full object-cover" />
                </a>
            @else
                <a href="{{ $category->id == null ? route('product') : route('product-category', ['id' => $category->id]) }}"
                    class="w-16 h-16 md:w-32 md:h-32 bg-green-600 rounded-full flex items-center justify-center text-white mx-auto text-2xl md:text-3xl cursor-pointer">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-8 h-8 md:w-18 md:h-18">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M3.75 6A2.25 2.25 0 0 1 6 3.75h2.25A2.25 2.25 0 0 1 10.5 6v2.25a2.25 2.25 0 0 1-2.25 2.25H6a2.25 2.25 0 0 1-2.25-2.25V6ZM3.75 15.75A2.25 2.25 0 0 1 6 13.5h2.25a2.25 2.25 0 0 1 2.25 2.25V18a2.25 2.25 0 0 1-2.25 2.25H6A2.25 2.25 0 0 1 3.75 18v-2.25ZM13.5 6a2.25 2.25 0 0 1 2.25-2.25H18A2.25 2.25 0 0 1 20.25 6v2.25A2.25 2.25 0 0 1 18 10.5h-2.25a2.25 2.25 0 0 1-2.25-2.25V6ZM13.5 15.75a2.25 2.25 0 0 1 2.25-2.25H18a2.25 2.25 0 0 1 2.25 2.25V18A2.25 2.25 0 0 1 18 20.25h-2.25A2.25 2.25 0 0 1 13.5 18v-2.25Z" />
                    </svg>
                </a>
            @endif
            <p class="mt-2 font-medium text-sm md:text-base">{{ $category->name }}</p>
        </div>
    @endforeach
</div>
