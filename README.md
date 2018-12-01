# realredis

[![Latest Version on Packagist][ico-version]][link-packagist]
[![PHP Version][ico-php-version]][link-packagist]
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE.md)
[![Total Downloads][ico-downloads]][link-downloads]

Really Redis! - RealRedis is a wrapper library for phpredis in the [Codeigniter](https://codeigniter.com/) framework.

## Requirements

- PHP >= 7.1.0
- phpredis
- CodeIgnitor 3.x

## Installation

```bash
composer require tfhinc/ci-realredis
```

- Copy the `tfhinc/ci-realredis/src/Helpers/realredis_helper.php` file to `application/helpers/realredis_helper.php`

## Loading the Library

There are a few available options for loading the RealRedis library:

### Using the `realredis()` helper function

The RealRedis helper function will resolve the realredis class via the CI instance. It will either load the class or return the existing class instance:

``` php
$this->load->helper('realredis');
```

### Using the RealRedis Class

The RealRedis class can be instantiated when you require it:

``` php
$redis = new TFHInc/RealRedis/RealRedis();
```

## Usage

```php

// Use the helper method

$this->CI->load->helper('realredis');

realredis()->get('sample.key');

// Use the RealRedis class

$realredis = new TFHInc\RealRedis\RealRedis();

$realredis->get('sample.key');
```

## Contributing

Feel free to create a GitHub issue or send a pull request with any bug fixes. Please see the GutHub issue tracker for isses that require help.

## Acknowledgements

- [Colin Rafuse][link-author]
- [All Contributors][link-contributors]

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/tfhinc/ci-realredis.svg?style=flat-square
[ico-php-version]: https://img.shields.io/packagist/php-v/tfhinc/ci-realredis.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/tfhinc/ci-realredis.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/tfhinc/ci-realredis
[link-downloads]: https://packagist.org/packages/tfhinc/ci-realredis
[link-author]: https://github.com/crafuse
[link-contributors]: ../../contributors