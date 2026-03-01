<?php

namespace AhmedDe\FilamentExtendedDate;

use Filament\Support\Assets\Js;
use Filament\Support\Facades\FilamentAsset;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class FilamentExtendedDateServiceProvider extends PackageServiceProvider
{
    public function bootingPackage()
    {
        FilamentAsset::register([
            Js::make('extended-date-dayjs', __DIR__.'/../resources/js/dist/components/dayjs.js'),
        ]);
    }

    public function configurePackage(Package $package): void
    {
        $package
            ->name('filament-extended-date')
            ->hasConfigFile('filament-extended-date')
            ->hasViews('filament-extended-date');
    }
}
