                                                  API Villes de France

Projet Laravel permettant d'interroger une base de données des villes françaises à travers une API et une interface web simple.

 Objectif

L'application expose plusieurs routes API pour obtenir des informations sur les villes de France à partir d'une base MySQL.

 Fonctionnalités

- Recherche par nom de ville  
- Recherche par code département  
- Recherche par code postal  
- Autocomplétion des noms de villes  
- Affichage dynamique des résultats sous le formulaire

 Stack technique

- PHP 8 / Laravel 12  
- MySQL  
- HTML, CSS et JavaScript (sans framework externe)

 Installation

1. Cloner le dépôt :

   git clone https://github.com/tonpseudo/api-ville-PUPIN.git
   cd api-ville-PUPIN
   
2.Installer les dépendances :

   composer install
   
3.Générer la clé d'application :

   php artisan key:generate

4.Lancer le serveur :

   php artisan serve

5.Accéder à l'application :

   http://127.0.0.1:8000

Structure principale

app/Http/Controllers/VilleController.php → logique des requêtes API
resources/views/villes.blade.php → interface utilisateur
routes/web.php → définition des routes
database/ → scripts SQL et fichiers de migration
