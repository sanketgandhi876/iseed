This package is modified to support Lumen. Check installation steps below and rest of functionalities are same as mentioned in [original iSeed library](https://github.com/orangehill/iseed).

## Installation

### 1. Require with [Composer](https://getcomposer.org/)
```sh
composer require orangehill/iseed
```

### 2. Add Service Provider

Add below service provider in `app.php`:

```php
// ...
$app->register(Orangehill\Iseed\IseedServiceProvider::class);
```
