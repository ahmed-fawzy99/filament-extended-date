<div {{ $extraAttributes }} class="inline-block"
     x-load-js="[@js(\Filament\Support\Facades\FilamentAsset::getScriptSrc('extended-date-dayjs'))]"
     x-data="{
        open: false,
        tooltipStyle: '',
        date: dayjs.tz('{{ $state }}', '{{ config('app.timezone') }}'),
        FORMAT: '{{ $dateFormat }}',
        prettifyZone(zone) {
            if (zone === 'local') return 'Your Device (' + dayjs()?.offsetName() + ')';
            if (zone === 'relative') return 'Relative';
            if (zone === 'unix') return 'UNIX Timestamp';
            return zone.split('/').slice(-1)[0].replaceAll('_', ' ');
        },
        show() {
            const rect = this.$el.getBoundingClientRect();
            const x = rect.left + rect.width / 2;
            const y = rect.top - 10;
            this.tooltipStyle = `position:fixed;top:${y}px;left:${x}px;transform:translate(-50%,-100%);z-index:9999;`;
            this.open = true;
        }
    }"
    @mouseenter="show"
    @mouseleave="open = false"
>
    <span
        class="cursor-pointer border-b border-dashed border-gray-400 dark:border-gray-500"
        x-text="date ? date.format(FORMAT) : ''"
    ></span>

    <div
        x-show="open"
        x-cloak
        :style="tooltipStyle"
        class="pointer-events-none min-w-56 rounded-lg border border-gray-200 bg-white pb-2 shadow-xl ring-1 ring-gray-200/80 dark:border-gray-200/10 dark:bg-gray-900 dark:ring-black/20"
    >
        {{-- Header --}}
        <div class="flex items-center gap-1.5 border-b border-gray-200 px-3 py-2 dark:border-white/10">
            <x-filament::icon-button
                icon="heroicon-o-clock"
                label="Timezone"
                color="gray"
            />
            <span class="text-xs font-semibold tracking-wide text-gray-500 uppercase dark:text-gray-300">Time Zones</span>
        </div>

        {{-- Zone rows --}}
        <div class="mt-1 flex flex-col px-1">
            @foreach ($zones as $zone)
                <div class="flex items-center justify-between gap-6 rounded px-2 py-1 hover:bg-gray-100 dark:hover:bg-white/5">
                    <span class="text-xs text-gray-400 dark:text-gray-400" x-text="prettifyZone('{{ $zone }}')"></span>
                    @if(strtolower($zone) === 'local')
                        <span class="font-mono text-xs text-gray-900 dark:text-white" x-text="date ? date.local().format(FORMAT) : ''"></span>
                    @elseif(strtolower($zone) === 'relative')
                        <span class="font-mono text-xs text-gray-900 dark:text-white" x-text="date ? date.fromNow() : ''"></span>
                    @elseif(strtolower($zone) === 'unix')
                        <span class="font-mono text-xs text-gray-900 dark:text-white" x-text="date ? date.unix() : ''"></span>
                    @else
                        <span class="font-mono text-xs text-gray-900 dark:text-white" x-text="date ? date.tz('{{ $zone }}').format(FORMAT) : ''"></span>
                    @endif
                </div>
            @endforeach
        </div>
    </div>
</div>
