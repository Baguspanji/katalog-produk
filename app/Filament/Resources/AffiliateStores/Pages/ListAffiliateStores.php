<?php

namespace App\Filament\Resources\AffiliateStores\Pages;

use App\Filament\Resources\AffiliateStores\AffiliateStoreResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListAffiliateStores extends ListRecords
{
    protected static string $resource = AffiliateStoreResource::class;

    public function getTitle(): string
    {
        return 'Toko Afiliasi';
    }

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
