# Installation
Avant tout, il faut setter ces variables qui se trouve dans .env.example  

    FORWARD_DB_PORT=3307
    WWWGROUP=kick-starter
    WWWUSER=1000
    APP_PORT=81

Vous pouvez aussi laisser tel quel.

L'installation se fait automatiquement avec la commande (Mac ou Linux)  
`make install`

Si vous êtes sur Windows, il se peut que cette commande n'existe pas, dans ce cas, il faudra lancer les commandes manuellement  
`copy .env.example .env`  
`docker-compose build`  
`docker-compose up -d`  
`docker-compose run --no-deps --rm phpfpm composer install`  
`docker-compose run --no-deps --rm phpfpm php artisan migrate:fresh`  
`docker-compose run --no-deps --rm phpfpm php artisan key:generate`  
`docker-compose run --no-deps --rm phpfpm php artisan vendor:publish --provider="Spatie\Permission\PermissionServiceProvider"`  
`docker-compose run --no-deps --rm phpfpm php artisan vendor:publish --tag=datatables-buttons`  
`docker-compose run --no-deps --rm phpfpm php artisan vendor:publish --tag=livewire-alert:assets`  
`docker-compose run --no-deps --rm phpfpm php artisan storage:link`  
`docker-compose run --no-deps --rm phpfpm npm install && npm run dev`  
`docker-compose run --no-deps --rm phpfpm npm install datatables.net-bs4 datatables.net-buttons-bs4`

make permet aussi de démarrer ou stopper docker  
`make start`  
`make stop`

# Packages contenu dans le kick starter
[Adminlte-3](https://github.com/jeroennoten/Laravel-AdminLTE/wiki "Adminlte-3")  
*Bootstap v4*  

[Yajra Datatable](https://yajrabox.com/docs/laravel-datatables/master/quick-starter "Yajra Datatable")

[Spatie Permission](https://spatie.be/docs/laravel-permission/v5/introduction "Spatie Permission")  
*Attention à la version php, la dernière version de Spatie permission fonctionne avec php8*

[Activity Log](https://spatie.be/docs/laravel-activitylog/v4/introduction "Activity Log")  
*Attention à la version php, la dernière version de Spatie Actvity log fonctionne avec php8*

[Livewire](https://laravel-livewire.com/docs/2.x/quickstart "Livewire")  

------------

## Commandes
En lançant la commande Laravel  
`php artisan make:model -mfsRr`  
Les fichiers de migration, factory, seeder, request et un controller resource seront créer

La commande  
`php artisan generate:base:files`  
Cette commande se base sur les models présent dans le répertoire app/Models et permet de générer les fichiers de base, DataTable, les vues edit et index.


## Setup
Ajouté ces variables d'environnements au .env

    FORWARD_DB_PORT=3307
    WWWGROUP=kick-starter
    WWWUSER=1000
    APP_PORT=81

Bien sur, vous pouvez les modifier.

## Groupe permission
Les permissions par défault sont show, store, update, delete.  
Par default, 2 de groupes de permissions existe déjà, Users et Permissions.  
Ces 2 groupes possède toutes les permissions.

## Groupe permission
Pour créer une nouvelle page, il suffit d'étendre le template principal layouts.admin  


