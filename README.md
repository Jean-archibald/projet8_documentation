ToDoList
========

Base du projet #8 : Améliorez un projet existant

https://openclassrooms.com/projects/ameliorer-un-projet-existant-1


Version du projet amélioré:
Source sur git : https://github.com/Jean-archibald/projet8_documentation.git

VERSION DU PROJET :

Allez dans le .env du dossier symfony (Projet8-todolist) et changer la ligne 25 : 
APP_ENV=prod 
devient
APP_ENV=dev

Puis ouvrez le CLI et placez vous à la racine du projet Symfony, tapez dans le CLI : ls

bin                     config                  public                  templates
composer.json           migrations              src                     tests
composer.lock           phpunit.xml.dist        symfony.lock            var

Ceci doit s'afficher.
Une fois que vous avez vérifier être au bon endroit, tapez dans le CLI : composer install

LES BASES DE DONNÉES:

Afin de créer BDD pour le dev : projet8Todolist et  BDD pour les test : test_Projet8todolist

Tapez dans le CLI : 

php bin/console doctrine:database:create 

puis

php bin/console doctrine:database:create --env=test

Remplissez ensuite dans votre phpmyadmin, les bases de données avec les fichiers contenu dans le dossier BDD a la racine du dossier github.

POUR LANCER LE SERVEUR DE SYMFONY:

Se placer à la racine du projet Symfony et taper dans le CLI : 

symfony serve

Si vous n'avez pas cette commande symfony de disponible, vous pouvez taper dans le CLI :

php -S localhost:8000 -t public

IDENTIFIANTS DE CONNEXION DANS LE SITE :

Pour se connecter en tant que Administrateur voici les identifiants : 

username : Administrateur

password : test

Pour se connecter en tant que Utilisateur voici les identifiants : 

username : Utilisateur

password : test



