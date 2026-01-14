<?php

namespace App\Livewire;

use App\Models\AffiliateStore;
use Livewire\Component;

class AffiliateStoreList extends Component
{
    public function render()
    {
        $stores = AffiliateStore::all();

        return view('livewire.affiliate-store-list', [
            'stores' => $stores,
        ]);
    }
}
