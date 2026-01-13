<?php

namespace App\Filament\Resources\Testimonials\Schemas;

use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Schema;

class TestimonialForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Grid::make(1)
                    ->schema([
                        TextInput::make('name')
                            ->label('Nama')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('email')
                            ->label('Email')
                            ->email()
                            ->required()
                            ->maxLength(255),
                        Textarea::make('message')
                            ->label('Pesan')
                            ->required(),
                        Select::make('rating')
                            ->label('Rating')
                            ->options([
                                1 => '1 Bintang',
                                2 => '2 Bintang',
                                3 => '3 Bintang',
                                4 => '4 Bintang',
                                5 => '5 Bintang',
                            ])
                            ->required(),
                        Checkbox::make('is_approved')
                            ->label('Setujui Testimoni'),
                    ]),
            ])
            ->columns(1);
    }
}
