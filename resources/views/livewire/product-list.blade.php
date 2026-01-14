<div>
    <div x-data="{
        scroll: 0,
        scrollContainer() {
            const container = $el.querySelector('[data-product-scroll]');
            return container;
        },
        handleScroll() {
            const container = this.scrollContainer();
            this.scroll = Math.round(container.scrollLeft / container.offsetWidth);
        }
    }" @load="handleScroll()" class="relative">
        <!-- Product Scroll Container -->
        <div data-product-scroll
            class="grid grid-cols-2 md:flex md:overflow-x-auto gap-8 [scrollbar-width:none] [&::-webkit-scrollbar]:hidden scroll-smooth"
            @scroll="handleScroll()">
            <div class="hidden md:block text-2xl font-semibold border-l-4 border-gray-600 pl-3 pr-4 h-18">
                <span class="text-green-600">Best</span>
                <span>Seller</span>
            </div>
            @forelse ($products as $product)
                <a href="{{ $product['affiliate_link'] ?? '#' }}" target="_blank" rel="noopener noreferrer"
                    class="w-40 md:w-64 shrink-0">
                    @if ($product['image_link'])
                        <img src="{{ asset('storage/' . $product['image_link']) }}" alt="{{ $product['name'] }}"
                            class="rounded-lg w-40 md:w-64 h-40 md:h-64 object-cover" />
                    @else
                        <img src="https://dummyimage.com/600x600"
                            class="rounded-lg w-40 md:w-64 h-40 md:h-64 object-cover" />
                    @endif
                    <h3 class="mt-2 font-semibold text-sm md:text-base line-clamp-2">{{ $product['name'] }}</h3>
                    @if ($product['description'])
                        <p class="text-xs md:text-sm text-gray-400">{{ \Str::limit($product['description'], 40) }}</p>
                    @endif
                    @if ($product['price'])
                        <p class="mt-2 font-bold text-green-600 text-sm md:text-base">Rp
                            {{ number_format($product['price'], 0, ',', '.') }}</p>
                    @endif
                    <div class="flex justify-between items-center mt-2">
                        @if ($product['category'])
                            <span
                                class="px-2 py-1 text-xs font-semibold bg-blue-100 text-blue-800 rounded">{{ $product['category']['name'] }}</span>
                        @endif
                        @if ($product['affiliate_store']['logo_favicon_url'] ?? null)
                            <img src="{{ asset('storage/' . $product['affiliate_store']['logo_favicon_url']) }}"
                                alt="{{ $product['affiliate_store']['name'] ?? '' }}" class="w-6 h-6" />
                        @endif
                    </div>
                </a>
            @empty
                <div class="col-span-2 md:col-span-3 text-center py-8">
                    <p class="text-gray-500">Belum ada produk tersedia</p>
                </div>
            @endforelse
        </div>

        <!-- Navigation Dots (Mobile and Desktop) -->
        @php
            $totalPages = ceil(count($products) / 3);
        @endphp
        @if (count($products) > 3)
            <div class="hidden md:flex justify-center gap-2 mt-6">
                @for ($i = 0; $i < $totalPages; $i++)
                    <button
                        @click="$el.closest('[x-data]').querySelector('[data-product-scroll]').scrollLeft = {{ $i * 280 }}"
                        class="h-2 rounded-full transition-all"
                        :class="scroll === {{ $i }} ? 'bg-green-600 w-8' : 'bg-gray-300 w-2'"
                        aria-label="Go to product page {{ $i + 1 }}">
                    </button>
                @endfor
            </div>
        @endif
    </div>
</div>
