# yii2-slider extension

The extension allows build multi language slider.

## Installation

- Install with composer:

```bash
composer require abdualiym/yii2-slider
```

- Add to console config file:

```php
'controllerMap' => [
    'migrate' => [
        'class' => 'fishvision\migrate\controllers\MigrateController',
        'autoDiscover' => true,
        'migrationPaths' => [
            '@domain/modules/slider/migrations',
        ],
    ],
],
```

- **After composer install** run console command for create tables:

```bash
php yii migrate
```

- add to backend config file:
```php
'components' => [
    'slider' => [
        'class' => 'slider\Slider',
    ],
],
```

