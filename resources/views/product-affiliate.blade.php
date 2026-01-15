@extends('layouts.app')

@section('content')
    <!-- ================= NAVBAR ================= -->
    <x-header-2 />

    <!-- ================= PRODUK ================= -->
    <section class="bg-gray-50 py-6 md:py-14">
        <div class="max-w-7xl mx-auto px-6">
            <div class="flex items-center mb-8 gap-4">
                <h2 class="text-normal md:text-2xl font-normal md:font-semibold border-l-2 border-gray-600 pl-3">
                    {{ $affiliateStore->name }}
                </h2>
                <div class="bg-gray-400 w-full h-0.5"></div>
            </div>

            <livewire:product-list :affiliateStoreName="$affiliateStore->name" />
        </div>
    </section>
@endsection
