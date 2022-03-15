# Very short description of the package

[![Latest Version on Packagist](https://img.shields.io/packagist/v/thetomnewton/laravel-docblocks-php-cs-fixer.svg?style=flat-square)](https://packagist.org/packages/thetomnewton/laravel-docblocks-php-cs-fixer)
[![Total Downloads](https://img.shields.io/packagist/dt/thetomnewton/laravel-docblocks-php-cs-fixer.svg?style=flat-square)](https://packagist.org/packages/thetomnewton/laravel-docblocks-php-cs-fixer)
![GitHub Actions](https://github.com/thetomnewton/laravel-docblocks-php-cs-fixer/actions/workflows/main.yml/badge.svg)

This package will help you get consistent Laravel-style docblocks with PHP-CS-Fixer

## Installation

You can install the package via composer:

```bash
composer require thetomnewton/laravel-docblocks-php-cs-fixer
```

Of course, you will also need the [PHP-CS-Fixer](https://github.com/friendsofphp/php-cs-fixer) package installed.

## Usage

In your `.php-cs-fixer.php`, add the custom fixer to your config class, like so:

```php
return (new Config)
    ->setFinder($finder)
    ->registerCustomFixers([
        new \Thetomnewton\LaravelDocFixer\LaravelDocblocks,
    ])
    ->setRules($rules);
```

Then in your list of rules, add the following line:

```php
$rules = [
    // ...
    'LaravelDocblocks/laravel_style_docs' => true,
    // ...
];
```

Job done! To give this a try:

```bash
./vendor/bin/php-cs-fixer fix -vvv --show-progress=dots
```

### Security

If you discover any security related issues, please email tom@tomn.dev instead of using the issue tracker.

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
