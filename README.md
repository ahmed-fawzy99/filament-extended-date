# Filament Extended Date

[![Latest Version on Packagist](https://img.shields.io/packagist/v/ahmedde/filament-extended-date.svg?style=flat-square)](https://packagist.org/packages/ahmedde/filament-extended-date)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/ahmedde/filament-extended-date/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/ahmedde/filament-extended-date/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/ahmedde/filament-extended-date/fix-php-code-style-issues.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/ahmedde/filament-extended-date/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/ahmedde/filament-extended-date.svg?style=flat-square)](https://packagist.org/packages/ahmedde/filament-extended-date)

Extend your date fields to reveal the date in other time zones and relative time.

## Installation

You can install the package via composer:

```bash
composer require ahmedde/filament-extended-date
```

You can publish the config file with:

```bash
php artisan vendor:publish --tag="filament-extended-date-config"
```

This is the contents of the published config file:

```php
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
```

Optionally, you can publish the views using

```bash
php artisan vendor:publish --tag="filament-extended-date-views"
```

Add this line to your filament theme to publish the CSS assets (typically in
`resources/css/filament/{THEME_NAME}/theme.css`):

```css
/*..adjust the path if your theme is not in the default path..*/
@source '../../../../vendor/ahmedde/filament-extended-date/resources/views/**/*.blade.php'; 
```

if you don't have a custom theme, please create one.
See [Filament Theme Docs](https://filamentphp.com/docs/5.x/styling/overview#creating-a-custom-theme) for more
information.

Finally, Publish the filament assets:

```bash
php artisan filament:assets
```

## Usage

### InfoLists

```php
use AhmedDe\FilamentExtendedDate\Infolists\Components\ExtendedDateEntry;

class ExampleInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                ExtendedDateEntry::make('created_at')
                    ->label('Created At'),
            //...
            ])
    }
}
```

### Tables

```php
use AhmedDe\FilamentExtendedDate\Tables\Columns\ExtendedDateColumn;

class ExampleTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ExtendedDateColumn::make('created_at')
                    ->label('Created At'),
            //...
            ])
    }
}
```

### Using Custom Timezones and Formats

By default, the package will use the timezones and format specified in the config file. However, you can override this
on a
per-field basis by passing an array of timezones to the `timezones()` method, and the preferred format to `dateFormat()`
method. This will override the default values
specified in the config file for that specific field.

> The `dateFormat()` method accepts any valid Day.js format string. For more information on the supported formats,
> see https://day.js.org/docs/en/display/format

```php
use AhmedDe\FilamentExtendedDate\Infolists\Components\ExtendedDateEntry;

ExtendedDateEntry::make('created_at')
    ->label('Created At')
    ->timezones([
        TZ::AFRICA_CAIRO,
        TZ::ASIA_TOKYO,
    ])
    ->dateFormat("YYYY/MM/DD HH:mm");


// Or for tables:
use AhmedDe\FilamentExtendedDate\Tables\Columns\ExtendedDateColumn;

ExtendedDateColumn::make('created_at')
    ->label('Created At')
    ->timezones([
        TZ::AFRICA_CAIRO,
        TZ::ASIA_TOKYO,
    ])
    ->dateFormat("MM/DD/YYYY HH:mm");
```

## Development

This plugin compiles the needed JS assets and registers the bundle in the `FilamentExtendedDateServiceProvider`. If you
want to make
changes to the JS code, you need to rebuild the `bin/build.js` file using `node`.
See [Registering Javascript Files](https://filamentphp.com/docs/5.x/advanced/assets#registering-javascript-files) for
more information.

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Credits

- [Ahmed Deghady](https://github.com/ahmed-fawzy99)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
