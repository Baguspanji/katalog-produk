<?php

namespace App\Livewire;

use App\Models\Category;
use Livewire\Component;

class CategoryList extends Component
{
    public function render()
    {
        $categories = Category::all();

        // add Tampil Semua to first $categories
        $categories->prepend((object) ['name' => 'Tampil Semua', 'logo_url' => null]);

        return view('livewire.category-list', [
            'categories' => $categories,
        ]);
    }
}
