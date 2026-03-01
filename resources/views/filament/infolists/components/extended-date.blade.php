<x-filament-infolists::entry-wrapper :entry="$entry">
    @include('filament-extended-date::filament.partials.extended-date', [
        'dateFormat' => $entry->getDateFormat(),
        'zones' => $entry->getTimezones(),
    ])
</x-filament-infolists::entry-wrapper>
