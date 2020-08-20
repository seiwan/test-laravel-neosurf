# Installation

````
$ composer install
$ cp .env.example .env
$ php artisan key:generate
````

# Base de données
Créer une base de données ("laravel_test" sur PostgreSQL par défaut) et compléter / modifier le fichier ".env".

Lancer les migrations et le seeder.
````
$ php artisan migrate --seed
````

# Démarrage de l'application
````
$ php artisan serve
````
