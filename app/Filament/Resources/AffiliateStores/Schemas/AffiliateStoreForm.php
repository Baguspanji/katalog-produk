<?php
namespace App\Filament\Resources\AffiliateStores\Schemas;

use App\Helpers\ImageHelper;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Schema;

class AffiliateStoreForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Grid::make(1)
                    ->schema([
                        TextInput::make('name')
                            ->label('Nama Toko')
                            ->required()
                            ->maxLength(255)
                            ->unique(table: 'affiliate_stores'),
                        TextInput::make('url')
                            ->label('URL Toko')
                            ->required()
                            ->url()
                            ->maxLength(255),
                        // TextInput::make('commission_rate')
                        //     ->label('Tingkat Komisi (%)')
                        //     ->numeric()
                        //     ->nullable()
                        //     ->step(0.01),
                        Textarea::make('description')
                            ->label('Deskripsi')
                            ->nullable(),
                    ])->columnSpan(2),
                Grid::make(1)
                    ->schema([
                        FileUpload::make('logo_url')
                            ->image()
                            ->panelLayout('grid')
                            ->maxSize(2048) // 2MB
                            ->directory('logos')
                            ->label('Logo')
                            ->disk('public')
                            ->nullable()
                            ->saveUploadedFileUsing(function ($file) {
                                $path = $file->store('temp', 'local');
                                return ImageHelper::compressAndConvertToWebp(
                                    $path,
                                    disk: 'public',
                                    directory: 'logos',
                                    quality: 80
                                );
                            }),
                        FileUpload::make('logo_favicon_url')
                            ->image()
                            ->panelLayout('grid')
                            ->maxSize(512) // 512KB
                            ->directory('favicons')
                            ->label('Favicon')
                            ->disk('public')
                            ->nullable()
                            ->saveUploadedFileUsing(function ($file) {
                                $path = $file->store('temp', 'local');
                                return ImageHelper::compressAndConvertToWebp(
                                    $path,
                                    disk: 'public',
                                    directory: 'favicons',
                                    quality: 80
                                );
                            }),
                    ])->columnSpan(1),
            ])
            ->columns(3);
    }
}
