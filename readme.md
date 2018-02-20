yii2-slider
==========

Installation and getting started:
---------------------------------

- Run the following command to install yii2-slider: 
```
composer require abdualiym/language-class
```

- Add to console config file: 
```
    'controllerMap' => [
        'migrate' => [
            'class' => 'fishvision\migrate\controllers\MigrateController',
            'autoDiscover' => true,
            'migrationPaths' => [
                '@vendor/abdualiym/yii2-slider/migrations',
            ],
        ],
    ],
```

- **After composer finish** run command for create tables: 
```
php yii migrate
```


*******************************************todo:**

- Set up image saving folders on extention adding on config(path-s): `php yii migrate` for create tables.





5. Add to common config file(module admin panel files): `php init` to initialize the application with a specific environment.
6. Set document roots of your Web server:

  - Use the URL `http://yii2-start.domain` to access application frontend.
  - Use the URL `http://yii2-start.domain/backend/` to access application backend.
  
  
__Backend__
    
    ```
    server {
        charset utf-8;
        client_max_body_size 128M;

        listen 80; ## listen for ipv4
        # listen [::]:80 ipv6only=on; ## listen for ipv6

        set $yii2StartRoot '/my/path/to/yii2-start'; ## You need to change it to your own path
        
        server_name backend.yii2-start.domain; ## You need to change it to your own domain
        root $yii2StartRoot/backend/web;
        index index.php;

        #access_log  $yii2StartRoot/log/backend/access.log;
        #error_log   $yii2StartRoot/log/backend/error.log;
    ```
    
    
**Remove `'baseUrl' => '/backend'` from 
`/my/path/to/yii2-start/backend/config/main.php`.**
    
    - Use the URL `http://yii2-start.domain` to access application frontend.
    - Use the URL `http://backend.yii2-start.domain` to access application backend.

Notes:
------

- sdf


- By default will be created one super admin user with login `admin` and password `admin12345`, you can use this data to sing in application frontend and backend.

Themes:
-------
- Application backend it's based on "AdminLTE" template. More detail about this nice template you can find [here](http://www.bootstrapstage.com/admin-lte/).
- Application frontend it's based on "Flat Theme". More detail about this nice theme you can find [here](http://shapebootstrap.net/item/flat-theme-free-responsive-multipurpose-site-template/).