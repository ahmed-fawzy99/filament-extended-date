<?php

use AhmedDe\FilamentExtendedDate\Support\Constants\TZ;

return [
    /*
    |--------------------------------------------------------------------------
    | Time Format
    |--------------------------------------------------------------------------
    | How you want to format the date.
    | For more information on the supported formats, see https://day.js.org/docs/en/display/format
    | This is Day.js format, not Carbon's date format.
    |
    */
    'date_format' => 'YYYY-MM-DD hh:mm:ss A',

    /*
    |--------------------------------------------------------------------------
    | Timezones
    |--------------------------------------------------------------------------
    | Each of the listed `timezones` will be displayed in the detailed time conversions' tooltip. You can add/remove timezones as needed
    | For the full list of supported timezones, see https://en.wikipedia.org/wiki/List_of_tz_database_time_zones
    | Custom timezones:
    | TZ::LOCAL => The user's local timezone (detected via the browser).
    | TZ::RELATIVE => relative time (e.g., "2 hours ago").
    |
    */
    'timezones' => [
        TZ::LOCAL,
        TZ::UTC,
        TZ::RELATIVE,
    ],
];
