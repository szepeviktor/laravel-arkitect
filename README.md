# Laravel Arkitect

Laravel Arkitect lets you test and enforce your architectural rules in your Laravel applications, and it's
a [PHPArkitect](https://github.com/phparkitect/arkitect) wrapper for Laravel. This package helps you to keep your app's
architecture clean and consistent.

## Install

You can install the package via Composer:

```
compsoer require mortexa/laravel-arkitect
```

## Usage

First, you should create your architectural rules by running the following Artisan command:

`php artisan make:arkitekt ControllersNaming`

By running the command, the `ControllersNaming.php` file will be created in your application's `app/Arkitect` directory like this:

```php
<?php

namespace App\Arkitect;

use Arkitect\Rules\DSL\ArchRule;
use Mortexa\LaravelArkitect\Contracts\RuleContract;
use Mortexa\LaravelArkitect\Rules\BaseRule;

class ControllersNaming extends BaseRule implements RuleContract
{
    /**
     * Define your architectural rule
     *
     * @link https://github.com/phparkitect/arkitect
     *
     * @return \Arkitect\Rules\DSL\ArchRule
     */
    public static function rule(): ArchRule
    {
        // TODO: Implement rule() method.
    }

    /**
     * Define the path related to your rule
     *
     * @example app/Http/Controllers
     *
     * @return string
     */
    public static function path(): string
    {
        // TODO: Implement path() method.
    }
}
```

And finally, you can run your tests by the following command:

`php artisan arkitect:check`

> If you want to stop checking command immediately after first violation, you can use `--stop-on-failure` option.

Done!

For all available rules, please take a look at the PHPArkitect repository: https://github.com/phparkitect/arkitect

## Example

```php
<?php

namespace App\Arkitect;

use Arkitect\Expression\ForClasses\HaveNameMatching;
use Arkitect\Expression\ForClasses\ResideInOneOfTheseNamespaces;
use Arkitect\Rules\DSL\ArchRule;
use Arkitect\Rules\Rule;
use Mortexa\LaravelArkitect\Contracts\RuleContract;
use Mortexa\LaravelArkitect\Rules\BaseRule;

class ControllersNaming extends BaseRule implements RuleContract
{
    public static function rule(): ArchRule
    {
        return Rule::allClasses()
            ->that(new ResideInOneOfTheseNamespaces('App\Http\Controllers'))
            ->should(new HaveNameMatching('*Controller'))
            ->because('It\'s a Laravel naming convention');
    }

    public static function path(): string
    {
        return 'app/Http/Controllers';
    }
}
```

## Configuration

You can publish the Laravel Arkitect configuration file using the following Artisan command:

`php artisan vendor:publish --provider="Mortexa\LaravelArkitect\ArkitectServiceProvider" --tag="config"`

The `arkitect` configuration file will be placed in your application's `config` directory. There are a few rules
provided by the package in this file that you can activate and apply to your codebase:

```php
// config/arkitect.php

<?php

use ...

return [
    'types' => [
        'naming' => true,
    ],

    'rules' => [
        'naming' => [
            ControllersNaming::class,
            ExceptionsNaming::class,
            NotificationsNaming::class,
            ObserversNaming::class,
            ProvidersNaming::class,
            RequestsNaming::class,
            ResourcesNaming::class,
            ChannelsNaming::class,
            SeedersNaming::class,
            PoliciesNaming::class,
            FactoriesNaming::class,
            ScopesNaming::class,
            BuildersNaming::class,
            ContractsNaming::class,
            RepositoriesNaming::class,
        ],
    ],
];
```

## Contributing

Thank you for considering contributing! If you find an issue, or have a better way to do something, feel free to open an
issue, or a PR.

## Licence

This repository is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).