<div {{ $getExtraAttributeBag() }} class="inline-block"
     x-load-js="[@js(\Filament\Support\Facades\FilamentAsset::getScriptSrc('extended-date-dayjs'))]"
     x-data="{
        open: false,
        tooltipStyle: '',
        date: dayjs.tz(@js($getState()), @js(config('app.timezone'))),
        FORMAT: @js($dateFormat),
        zones: @js($zones),
        prettifyZone(zone) {
            if (zone === 'local') return 'Your Device (' + dayjs().offsetName() + ')';
            if (zone === 'relative') return 'Relative';
            if (zone === 'unix') return 'UNIX Timestamp';
            return zone.split('/').slice(-1)[0].replaceAll('_', ' ');
        },
        formatDate(zone) {
            if (! this.date) return '⚠ DATE ERROR';
            switch (zone) {
                case 'local':
                    return this.date.local().format(this.FORMAT);
                case 'relative':
                    return this.date.fromNow();
                case 'unix':
                    return this.date.unix();
                default:
                    return this.date.tz(zone).format(this.FORMAT);
            }
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
            <span
                class="text-xs font-semibold tracking-wide text-gray-500 uppercase dark:text-gray-300">Time Zones</span>
        </div>

        {{-- Zone rows --}}
        <div class="mt-1 flex flex-col px-1">
            <template x-for="zone in zones" :key="zone">
                <div
                    class="flex items-center justify-between gap-6 rounded px-2 py-1 hover:bg-gray-100 dark:hover:bg-white/5"
                >
                    <span class="text-xs text-gray-400 dark:text-gray-400"
                          x-text="prettifyZone(zone)"
                    ></span>
                    <span class="font-mono text-xs text-gray-900 dark:text-white"
                          x-text="formatDate(zone)"
                    ></span>
                </div>
            </template>
        </div>
    </div>
</div>
