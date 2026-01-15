<div wire:poll.10s="nextTestimonial">
    @if (count($testimonials) > 0)
        <div class="relative">
            @foreach ($testimonials as $index => $testimonial)
                @if ($index === $currentIndex)
                    <div wire:key="testimonial-{{ $index }}"
                        x-transition:enter="transition ease-in-out duration-500"
                        x-transition:leave="transition ease-in-out duration-500" class="bg-white rounded-xl shadow p-3 md:p-6">
                        <div class="flex items-center gap-4">
                            <div class="flex gap-1">
                                @for ($i = 1; $i <= 5; $i++)
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"
                                        class="w-4 h-4 {{ $i <= $testimonial['rating'] ? 'fill-yellow-400' : 'fill-gray-300' }}">
                                        <path
                                            d="M309.5-18.9c-4.1-8-12.4-13.1-21.4-13.1s-17.3 5.1-21.4 13.1L193.1 125.3 33.2 150.7c-8.9 1.4-16.3 7.7-19.1 16.3s-.5 18 5.8 24.4l114.4 114.5-25.2 159.9c-1.4 8.9 2.3 17.9 9.6 23.2s16.9 6.1 25 2L288.1 417.6 432.4 491c8 4.1 17.7 3.3 25-2s11-14.2 9.6-23.2L441.7 305.9 556.1 191.4c6.4-6.4 8.6-15.8 5.8-24.4s-10.1-14.9-19.1-16.3L383 125.3 309.5-18.9z" />
                                    </svg>
                                @endfor
                            </div>
                        </div>
                        <p class="text-sm text-gray-600 mt-4">
                            "{{ $testimonial['message'] }}"
                        </p>
                        <p class="mt-4 font-semibold flex flex-wrap items-center gap-1">
                            <span>
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                </svg>
                            </span>
                            {{ $testimonial['name'] }}
                        </p>
                    </div>
                @endif
            @endforeach

            <!-- Navigation Buttons -->
            @if (count($testimonials) > 1)
                <button wire:click="nextTestimonial"
                    class="absolute right-8 md:right-4 top-[45%] -translate-y-1/2 translate-x-12 md:translate-x-16 text-white bg-green-600 rounded-full p-1 shadow-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                        stroke="currentColor" class="w-4 h-4 md:w-6 md:h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5L15.75 12l-7.5 7.5" />
                    </svg>
                </button>

                <!-- Indicator Dots -->
                <div class="flex justify-center gap-2 mt-4">
                    @foreach ($testimonials as $index => $testimonial)
                        <button wire:click="goToTestimonial({{ $index }})"
                            class="h-2 rounded-full transition-all {{ $index === $currentIndex ? 'bg-green-600 w-8' : 'bg-gray-300 w-2' }}"
                            aria-label="Go to testimonial {{ $index + 1 }}">
                        </button>
                    @endforeach
                </div>
            @endif
        </div>
    @else
        <div class="bg-white rounded-xl shadow p-6 text-center">
            <p class="text-gray-500">Belum ada testimoni yang disetujui</p>
        </div>
    @endif
</div>
