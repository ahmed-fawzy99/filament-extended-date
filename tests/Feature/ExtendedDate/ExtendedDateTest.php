<?php

use AhmedDe\FilamentExtendedDate\Support\Constants\TZ;
use AhmedDe\FilamentExtendedDate\Support\Traits\HasExtendedDate;

it('can load timezones', function () {
    config(['filament-extended-date.timezones' => [
        TZ::UTC,
        TZ::AFRICA_CAIRO,
    ]]);

    $extendedDateTrait = new class
    {
        use HasExtendedDate;
    };

    expect($extendedDateTrait->getTimezones())
        ->toBeArray()
        ->toHaveCount(2)
        ->toContain(TZ::AFRICA_CAIRO);
});

it('can load time format', function () {
    config(['filament-extended-date.date_format' => 'YYYY/MM/DD hh:mm A']);

    $extendedDateTrait = new class
    {
        use HasExtendedDate;
    };

    expect($extendedDateTrait->getDateFormat())
        ->toBeString()
        ->toEqual('YYYY/MM/DD hh:mm A');
});

it('can filter duplicate and invalid timezones', function () {
    // Duplicate timezones and add an invalid one to test filtering
    config(['filament-extended-date.timezones' => [
        TZ::UTC,
        TZ::UTC,
        TZ::AFRICA_CAIRO,
        TZ::AFRICA_CAIRO,
        TZ::AFRICA_CAIRO,
        'Invalid/Timezone',
    ]]);

    $extendedDateTrait = new class
    {
        use HasExtendedDate;
    };

    expect($extendedDateTrait->getTimezones())
        ->toBeArray()
        ->toHaveCount(2)
        ->toContain(TZ::AFRICA_CAIRO)
        ->and($extendedDateTrait->getTimezones())
        ->not->toContain('Invalid/Timezone');

});

it('can use defaults if configs are not valid', function () {
    // Duplicate timezones and add an invalid one to test filtering
    config([
        'filament-extended-date.timezones' => null,
        'filament-extended-date.date_format' => null,
    ]);

    $extendedDateTrait = new class
    {
        use HasExtendedDate;
    };

    expect($extendedDateTrait->getTimezones())
        ->toBeArray()
        ->toHaveCount(1)
        ->toContain(TZ::LOCAL)
        ->and($extendedDateTrait->getDateFormat())
        ->not->toBeNull()
        ->toEqual('YYYY-MM-DD hh:mm:ss A');
});
