<?php

namespace App\Filament\Resources\AffiliateStores\Pages;

use App\Filament\Resources\AffiliateStores\AffiliateStoreResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditAffiliateStore extends EditRecord
{
    protected static string $resource = AffiliateStoreResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
