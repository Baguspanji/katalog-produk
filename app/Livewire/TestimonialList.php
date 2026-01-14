<?php

namespace App\Livewire;

use App\Models\Testimonial;
use Livewire\Component;
use Livewire\Attributes\On;

class TestimonialList extends Component
{
    public int $currentIndex = 0;
    public array $testimonials = [];

    public function mount(): void
    {
        $this->testimonials = Testimonial::where('is_approved', true)
            ->select(['id', 'name', 'message', 'rating'])
            ->get()
            ->toArray();
    }

    #[On('nextTestimonial')]
    public function nextTestimonial(): void
    {
        if (count($this->testimonials) > 0) {
            $this->currentIndex = ($this->currentIndex + 1) % count($this->testimonials);
        }
    }

    public function previousTestimonial(): void
    {
        if (count($this->testimonials) > 0) {
            $this->currentIndex = ($this->currentIndex - 1 + count($this->testimonials)) % count($this->testimonials);
        }
    }

    public function goToTestimonial(int $index): void
    {
        if ($index >= 0 && $index < count($this->testimonials)) {
            $this->currentIndex = $index;
        }
    }

    public function render()
    {
        return view('livewire.testimonial-list');
    }
}
