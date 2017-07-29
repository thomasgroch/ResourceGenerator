# resource-generator

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Software License][ico-license]](LICENSE.md)
<!--
[![Build Status][ico-travis]][link-travis]
[![Coverage Status][ico-scrutinizer]][link-scrutinizer]
[![Quality Score][ico-code-quality]][link-code-quality]
[![Total Downloads][ico-downloads]][link-downloads]
-->

Generate all Structure for a given resource name

## Structure

Create and remove components of a resource. These include:
```
Resourceful Controller
Migration
Seeder
Create Form Request
Update From Request
Test
Transformer
```

## Install

Via Composer

``` bash
$ composer require groch/resource-generator
```

Register the service provider in ``` config/app.php ```.

``` php 
groch\ResourceGenerator\ResourceGeneratorServiceProvider::class,
```


## Usage
 
Run ``` php artisan ``` to see the new command ``` gen:resource ```.


Create components
``` bash
php artisan gen:resource car
```

Remove components
``` bash
php artisan gen:resource car --delete=1
```

## Change log

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

<!--
## Testing

``` bash
$ composer test
```

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) and [CONDUCT](CONDUCT.md) for details.

## Security

If you discover any security related issues, please email the author instead of using the issue tracker.
-->
## Credits

- [Thomas Letsch Groch]([author-link])

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/groch/resource-generator.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis/groch/resource-generator/master.svg?style=flat-square
[ico-scrutinizer]: https://img.shields.io/scrutinizer/coverage/g/groch/resource-generator.svg?style=flat-square
[ico-code-quality]: https://img.shields.io/scrutinizer/g/groch/resource-generator.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/groch/resource-generator.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/groch/resource-generator
[link-travis]: https://travis-ci.org/groch/resource-generator
[link-scrutinizer]: https://scrutinizer-ci.com/g/groch/resource-generator/code-structure
[link-code-quality]: https://scrutinizer-ci.com/g/groch/resource-generator
[link-downloads]: https://packagist.org/packages/groch/resource-generator
[link-author]: https://github.com/thomasgroch
[link-contributors]: ../../contributors
