<?php

namespace AhmedDe\FilamentExtendedDate\Infolists\Components;

use AhmedDe\FilamentExtendedDate\Support\Traits\HasExtendedDate;
use Filament\Infolists\Components\Entry;

class ExtendedDateEntry extends Entry
{
    use HasExtendedDate;

    protected string $view = 'filament-extended-date::filament.infolists.components.extended-date';
}
