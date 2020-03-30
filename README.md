## About Cms Starter

Dibangun menggunakan laravel 6.2 dan menggunakan konsep repository pattern (https://github.com/andersao/l5-repository) 

## Install


 - download package di git
 - buka terminal masuk directory ketik command "composer update"
 - buat file .env
 - ketik "php artisan key:generate"
 - edit .env dan cocokkan dengan database yang tersedia
 - ketik "php artisan migrate"
 - ketik "php artisan db:seed"
 - jalankan server "php artisan serve"

## Credential

 - http://127.0.0.1/admin
 - u:admin@admin.com
 - p:43lw9rj2

## Create Module
 - php artisan make:module {name} -> untuk module additional
 - php artisan make:module -m {name} -> untuk module master
 - tambahkan di composer.json di line repositories 
        untuk master
        {
            "type"      : "path",
            "url"       : "master/{name}",
            "options"   : {
                "symlink" : true
            }
        }
        untuk module
        {
            "type"      : "path",
            "url"       : "module/{name}",
            "options"   : {
                "symlink" : true
            }
        }
 - buka terminal ketik composer install "master/{name} @dev" untuk master atau composer install "module/{name} @dev" untuk module