<!-- Lancer le serveur laravel: -->
php artisan serve
<!-- le serveur est accessible à: http://127.0.0.1:8000 -->

<!-- ApiPlateforme accessible à : -->
http://127.0.0.1:8000/api

<!-- Liste des routes disponibles: -->
php artisan route:list



Création de test
commande artisan: php artisan make:test Auth/RegistrationTest
*la commande va créer un dossier avec un fichier RegistrationTest dans le dossier test à la racine du projet*
Utilisation d'asserts pour verifier le fonctionnement
On peut créer ses propres asserts
Pour jouer le test sur phpstorm bouton play "run main"
ou avec : php artisan test --filter RegistrationTest
