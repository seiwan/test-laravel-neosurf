# Installation

````
$ composer install
$ cp .env.example .env
$ php artisan key:generate
````

# Base de données
Créer une base de données ("laravel_test_neosurf" sur PostgreSQL par défaut) et compléter / modifier le fichier ".env" si besoin.

Lancer les migrations et le seeder.
````
$ php artisan migrate --seed
````

# Démarrage de l'application
````
$ php artisan serve
````

# Tests unitaires

## Base de données
Créer une base de données pour les tests unitaires ("laravel_test_neosurf_testing" sur PostgreSQL par défaut) et compléter / modifier le fichier ".env.testing" si besoin.

Lancer les migrations et le seeder.
````
$ php artisan migrate --env=testing
````

## Lancer les tests unitaires
````
$ php artisan test --env=testing
````
