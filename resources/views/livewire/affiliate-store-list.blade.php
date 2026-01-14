<div class="flex justify-center md:flex-wrap gap-2">
    @forelse ($stores as $store)
        <a href="{{ $store->url }}" target="_blank" rel="noopener noreferrer"
            class="md:w-[47%] md:p-4 text-center flex flex-col items-center gap-1 md:gap-2">
            @if ($store->logo_url)
                <img src="{{ asset('storage/' . $store->logo_url) }}" alt="{{ $store->name }}"
                    class="w-2xl md:w-3/4 object-contain" />
            @endif
            <span class="font-normal text-[9px] md:text-base text-gray-400">
                {{ $store->name }}
            </span>
        </a>
    @empty
        <div class="w-full text-center py-8">
            <p class="text-gray-500">Belum ada toko afiliasi tersedia</p>
        </div>
    @endforelse
</div>
