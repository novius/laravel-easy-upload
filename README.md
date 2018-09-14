# Easy Upload
[![Travis](https://img.shields.io/travis/novius/laravel-easy-upload.svg?maxAge=1800&style=flat-square)](https://travis-ci.org/novius/laravel-easy-upload)
[![Packagist Release](https://img.shields.io/packagist/v/novius/laravel-easy-upload.svg?maxAge=1800&style=flat-square)](https://packagist.org/packages/novius/laravel-easy-upload)
[![Licence](https://img.shields.io/packagist/l/novius/laravel-easy-upload.svg?maxAge=1800&style=flat-square)](https://github.com/novius/laravel-easy-upload#licence)

Treat file uploading as if it was just a text input

## Installation

```sh
composer require novius/laravel-easy-upload
```

Then add this to `config/app.php`:

```php
// in 'providers' => [ ... ]
Novius\EasyUpload\EasyUploadServiceProvider::class,

// in 'aliases' => [ ... ]
'Upload' => Novius\EasyUpload\Support\Renderer::class,
```

## Use

In a view:

```html
<form action="…">
    <input name="title">
    <textarea name="description">
    {{ Upload::input(['name' => 'avatar_src']) }}
</form>
```

This will provide a `<input type="hidden">` tag and a `<input type="file">` tag. As soon as the user specify a file, it will be uploaded through ajax, and the resulting file src will be stored in the hidden inout value attribute.

Possible options are:

```html
{{ Upload::input([
    'name' => 'avatar_src', // default: file_src
    'attribute' => 'data-name', // default: name
    'value' => 'upload/my-image-1234.jpg',
    'accept' => '.pdf,.gif,image/png,image/jpeg',
    'class' => 'any-class-you-want or-several-at-the-same-time'
]) }}
```
