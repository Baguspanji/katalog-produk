@extends('layouts.app')

@section('content')
    <!-- ================= NAVBAR ================= -->
    <x-header-1 />

    <!-- ================= KATEGORI ================= -->
    <section class="max-w-7xl mx-auto px-6 py-6 md:py-14">
        <h2 class="text-normal md:text-2xl font-normal md:font-semibold mb-8 pb-2 relative inline-block">
            Kategori
            <span class="absolute bottom-0 left-0 h-1 w-18 md:w-30 bg-green-600"></span>
        </h2>

        <livewire:category-list />
    </section>

    <!-- ================= PRODUK ================= -->
    <section class="bg-gray-50 py-6 md:py-14">
        <div class="max-w-7xl mx-auto px-6">
            <div class="flex justify-between items-center mb-8">
                <h2 class="text-normal md:text-2xl font-normal md:font-semibold pb-2 relative inline-block">
                    Produk Kami
                    <span class="absolute bottom-0 left-0 h-1 w-26 md:w-40 bg-green-600"></span>
                </h2>
                <button
                    class="bg-green-600 text-white text-xs md:text-sm px-4 md:px-8 py-1 md:py-2 rounded-lg cursor-pointer">
                    Lihat Semua
                </button>
            </div>

            <livewire:product-list />
        </div>
    </section>

    <!-- ================= MARKETPLACE ================= -->
    <section class="max-w-7xl mx-auto px-6 py-6 md:py-14">
        <h2 class="text-normal md:text-2xl font-normal md:font-semibold mb-6 pb-2 relative inline-block">
            Online Store
            <span class="absolute bottom-0 left-0 h-1 w-26 md:w-38 bg-green-600"></span>
        </h2>

        <livewire:affiliate-store-list />
    </section>
@endsection
