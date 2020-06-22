ToDoList
========

Base du projet #8 : Améliorez un projet existant

https://openclassrooms.com/projects/ameliorer-un-projet-existant-1


Version du projet amélioré:
Source sur git : https://github.com/Jean-archibald/projet8_documentation.git

VERSION DEV DU PROJET :
La version dev du projet est sur la branche master.
Une base de donnée de dev et une de test ont été créés.
Lors de la création du projet, vous devez installer les composants de composer :
À la racine du projet symfony, dans le CLI, tapez : composer install


LES BASES DE DONNÉES:
BDD pour le dev : projet8Todolist
BDD pour les test : test_Projet8todolist

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


La version optimisée pour l'envoi en prod est sur la branche : 
OptimisationPerformance
Afin d'y accéder, placez vous à l'exterieur du dossier Symfony.
tapez dans le CLI : 
git branch
Ceci devrait s'afficher : 
XXXXXXXXXXXX:SoutenanceP8 XXXXXXX$ git branch
  OptimisationPerformance
  creationFunctionnalTest
  creationNewFunctionnality
  creationUnitTest
* master
  upgradeToSymfony4

Si ce n'est pas le cas, c'est que vous êtes dans le mauvais dossier.

Tapez ensuite : 
git checkout OptimisationPerformance

Cette version est optimisée pour la prod, elle ne contient pas de package seulement nécessaire pour le dev.
Ceci afin d'optimiser la performance de l'application.

