<?php

namespace AhmedDe\FilamentExtendedDate\Tables\Columns;

use AhmedDe\FilamentExtendedDate\Support\Traits\HasExtendedDate;
use Filament\Tables\Columns\Column;
use Filament\Tables\Columns\Concerns\CanFormatState;

class ExtendedDateColumn extends Column
{
    use CanFormatState, HasExtendedDate;

    protected string $view = 'filament-extended-date::filament.tables.columns.extended-date';
}
