<?php

namespace App\Filament\Widgets;

use App\Models\Product;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\DB;

class ProductClicksChartWidget extends ChartWidget
{
    protected ?string $heading = 'Total Klik Produk';

    protected static ?int $sort = 3;

    protected ?array $options = [
        'plugins' => [
            'legend' => [
                'display' => false,
            ],
        ],
    ];

    protected int | string | array $columnSpan = 'full';

    protected ?string $maxHeight = '300px';

    public function getDescription(): ?string
    {
        return 'Perbandingan jumlah klik pada produk teratas.';
    }

    protected function getData(): array
    {
        $products = Product::select('name', 'click_count')
            ->orderByDesc('click_count')
            ->limit(10)
            ->get();

        return [
            'datasets' => [
                [
                    'label' => 'Total Klik',
                    'data' => $products->pluck('click_count')->toArray(),
                    'borderColor' => '#f59e0b',
                    'backgroundColor' => 'rgba(245, 158, 11, 0.1)',
                ],
            ],
            'labels' => $products->pluck('name')->toArray(),
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
