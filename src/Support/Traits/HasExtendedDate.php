<?php

namespace AhmedDe\FilamentExtendedDate\Support\Traits;

use AhmedDe\FilamentExtendedDate\Support\Constants\TZ;
use ReflectionClass;

trait HasExtendedDate
{
    protected ?array $zones = null;

    protected ?string $dateFormat = null;

    public function timezones(?array $zones): static
    {
        $this->zones = $zones;

        return $this;
    }

    public function getTimezones(): array
    {
        $zones = $this->zones ?: config('filament-extended-date.timezones') ?: [TZ::LOCAL];

        return $this->filterTimezones($zones);
    }

    public function dateFormat(string $dateFormat): static
    {
        $this->dateFormat = $dateFormat;

        return $this;
    }

    public function getDateFormat(): string
    {
        return $this->dateFormat ?: config('filament-extended-date.date_format') ?: 'YYYY-MM-DD hh:mm:ss A';
    }

    private function filterTimezones(?array $zones = []): array
    {
        // remove duplicates
        $zones = array_unique($zones);

        // filter out invalid timezones
        $rc = new ReflectionClass(TZ::class);

        return array_intersect($zones, $rc->getConstants());
    }
}
