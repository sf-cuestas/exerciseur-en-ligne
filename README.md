# Exerciseur en ligne
Salut celui-là c'est un projet dans le cadre de la SAÉ pour le deuxième, le projet
consiste d'une page web pour la realisation et la creation d'exercices pour les étudiants
Cet projet est déjà le refacto du projet SAÉ créé dans une premiere stance sans le framework de cakephp
voici le lien au projet https://github.com/JeromeTardivon/Exerciseur-en-Ligne



Nous avons amelioré le projet avec la mise en place d'une architecture MVC plus claire.
Nous avons refactoricé les fonctions qui sont difficiles à comprendre, qui se repetent
## Installation develop
1. Download and install PHP 8.2
2. Download [Composer](https://getcomposer.org/doc/00-intro.md) or update `composer self-update`.

If Composer is installed, run inside the folder of the project

```bash
composer install
```
after that, you have to initialize the database
1. write the credentials to access to the database into the file config/app_local.php
2. use the command below to migrate the database
```bash
bin/cake migrations migrate
```
to start up the built-in webserver use the command:
```bash
bin/cake server -p 8765
```

Then visit `http://localhost:8765` to see the welcome page.

## Installation production
for the installation of the page in a self web server you have to:
1. use the command in the project to install the dependencies for production
```bash
composer install --no-dev
```
2. In the file config/app_local.php change the debug for false and add all the credentials for the database
3. go to the folder bin and execute the command for initialize the data base
```bash
cake migrations migrate
```

