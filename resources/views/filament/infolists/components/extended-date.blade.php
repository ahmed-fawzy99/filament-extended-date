<x-filament-infolists::entry-wrapper :entry="$entry">
    @include('filament-extended-date::filament.partials.extended-date', [
        'extraAttributes' => $getExtraAttributeBag(),
        'state' => $getState(),
        'dateFormat' => $entry->getDateFormat(),
        'zones' => $entry->getTimezones(),
    ])
</x-filament-infolists::entry-wrapper>
