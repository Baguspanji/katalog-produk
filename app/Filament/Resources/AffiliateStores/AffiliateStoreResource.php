<?php

namespace App\Filament\Resources\AffiliateStores;

use App\Filament\Resources\AffiliateStores\Pages\CreateAffiliateStore;
use App\Filament\Resources\AffiliateStores\Pages\EditAffiliateStore;
use App\Filament\Resources\AffiliateStores\Pages\ListAffiliateStores;
use App\Filament\Resources\AffiliateStores\Schemas\AffiliateStoreForm;
use App\Filament\Resources\AffiliateStores\Tables\AffiliateStoresTable;
use App\Models\AffiliateStore;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class AffiliateStoreResource extends Resource
{
    protected static ?string $model = AffiliateStore::class;

    protected static ?string $navigationLabel = 'Toko Afiliasi';

    protected static ?string $modelLabel = 'Toko Afiliasi';

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedShoppingCart;

    public static function form(Schema $schema): Schema
    {
        return AffiliateStoreForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return AffiliateStoresTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListAffiliateStores::route('/'),
            'create' => CreateAffiliateStore::route('/create'),
            'edit' => EditAffiliateStore::route('/{record}/edit'),
        ];
    }
}
