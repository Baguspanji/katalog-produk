<?php
namespace App\Filament\Resources\Categories\Schemas;

use App\Helpers\ImageHelper;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Schema;

class CategoryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Grid::make(1)
                    ->schema([
                        TextInput::make('name')
                            ->label('Nama Kategori')
                            ->required()
                            ->maxLength(255),
                        Textarea::make('description')
                            ->label('Deskripsi')
                            ->nullable(),
                    ])->columnSpan(2),
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
                    })->columnSpan(1),
            ])
            ->columns(3);
    }
}
