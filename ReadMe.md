Préparer le fichier d'environnement :
Bash

cp src/.env.example src/.env

Lancer les containers :
Bash

docker compose up -d

Installer les dépendances & configurer l'app :
Bash

docker compose exec app composer install
docker compose exec app php artisan key:generate
docker compose exec app php artisan migrate