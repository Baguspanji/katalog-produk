<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Component;

class ProductList extends Component
{
    public int $scrollPage = 0;
    public int $itemsPerPage = 3;
    public array $products = [];

    public bool $withCategory = false;

    public function mount($categoryId = null, $affiliateStoreName = null): void
    {
        if ($categoryId || $affiliateStoreName) {
            $this->withCategory = true;
        }

        $this->products = Product::with('category', 'affiliateStore')
            ->when($categoryId, fn($query) => $query->where('category_id', $categoryId))
            ->when($affiliateStoreName, fn($query) => $query->where('affiliate_type', $affiliateStoreName))
            ->when(!$categoryId && !$affiliateStoreName, fn($query) => $query->limit(6))
            ->lazy()
            ->toArray();
    }

    public function nextPage(): void
    {
        $maxPages = ceil(count($this->products) / $this->itemsPerPage);
        if ($this->scrollPage < $maxPages - 1) {
            $this->scrollPage++;
        }
    }

    public function previousPage(): void
    {
        if ($this->scrollPage > 0) {
            $this->scrollPage--;
        }
    }

    public function goToPage(int $page): void
    {
        $maxPages = ceil(count($this->products) / $this->itemsPerPage);
        if ($page >= 0 && $page < $maxPages) {
            $this->scrollPage = $page;
        }
    }

    public function render()
    {
        return view('livewire.product-list');
    }
}
