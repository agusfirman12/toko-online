<?php

namespace App\Filament\Widgets;

use App\Models\Product;
use App\Models\Transaction;
use App\Models\User;
use Filament\Support\Enums\IconPosition;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;

class totalTrxWidget extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            

            Stat::make('Total User', User::count())
            ->description('All User are Registered')
            ->descriptionIcon('heroicon-o-users', IconPosition::Before)
            ->chart([5,1,5,3,7,5,10])
            ->color('info'),

            Stat::make('Total Product', Product::count())
            ->description('All Product in Stock')
            ->descriptionIcon('heroicon-o-archive-box', IconPosition::Before)
            ->chart([5,1,5,3,7,5,10])
            ->color('warning'),

            Stat::make('Total Transaction', Transaction::count())
            ->description('Last 6 months Transactions')
            ->descriptionIcon('heroicon-o-currency-dollar', IconPosition::Before)
            ->chart([5,1,5,3,7,5,10])
            ->color('success'),
        ];
    }
}
