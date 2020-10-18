# Redirect visitors using unsupported browsers

This package allows you to redirect users using unsupported browsers to https://notsupported.app

## How to
The only thing you have to do is add this package's middleware in your Kernel.

```php
app/Http/Kernel.php

protected $middleware = [
    ...
    \NotSupported\Laravel\Middleware\NotSupportedMiddleware::class
];

```
# Credits
- [Chrysanthos Prodromou](https://github.com/chrysanthos)
- [All Contributors](https://github.com/not-supported/laravel/contributors)

# License
The MIT License (MIT). Please see License File for more information.

