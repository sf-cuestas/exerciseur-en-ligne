# Exerciseur en ligne
Salut celui-là c'est un projet dans le cadre de la SAÉ pour le deuxième année de BUT Informatique, le projet
consiste d'une page web pour la realisation et la creation d'exercices pour les étudiants
Cet projet est déjà le refacto du projet SAÉ créé dans une premiere stance sans le framework de cakePHP
voici le lien au projet https://github.com/JeromeTardivon/Exerciseur-en-Ligne

### Convention de nommage des variables
Pour les contrôleurs, entités, tables et variables, nous allons suivre la convention de [cakePHP](https://book.cakephp.org/5.x/intro/conventions.html).
```
UsersController.php ->
class UsersController extends AppController
{
    // URL: /users/view_Me
    public function viewMe()
    {
        // camelBacked method names
    }
}
```
Et pour le nommage des autres fichiers (javascript, css, fonts, images), nous allons utiliser camelBacked avec la premiere lettre en miniscule, nous nous sommes mis d'accord sur
ce type de nommage pour suivre l'idée de cake php mais dans la documentation du framework, il n'y a pas une convention sur le nommage de ficher hors les fichiers que cakePHP utilise.
```
fichier javascript -> controlCreationUser.js
```
Quelques erreurs que nous avons trouvé sur le nommage des fichiers et variables:
- Quand nous avons commencé le projet, nous nommions quelques fichiers avec
kebab-case (les images et fichiers javascript), autres avec snake_case (pour les fichiers qui ont eu une structure html).
- Nous avons essayé de standardiser le nommage avec camelCase, mais pour les fichiers avec la vue de pages le framework nous force à
utiliser snake_case pour les fichiers avec multiples mots.

### Commentaires
Pour cette partie, nous avons écrit quelques commentaires pendant que nous faisions le projet s'il y a eu besoin d'expliquer pour expliquer une fonction ou la façon de faire quelque chose dans une fonction, par exemple dans le fichier src/Controller/ExercisesController.php.
### Programmation défensive et control d'erreurs
Pour la programmation défensive, nous avons ajouté pour quelques fonctions un try catch pour prévenir que le site web s'arrete dans une section critique,
aussi, nous avons ajouté la verification de nulls pour éviter que les scripts Javascript aient des problèmes d'exécution, car nous sommes contraints par cake php de charger tous les scripts meme si la page actuelle ne les utilise pas.

De plus, pour la gestion d'erreur, nous avons géré l'accès aux pages avec l'authentification, si l'utilisateur n'est pas connecté, le
Framework l'oblige à se connecter et si l'utilisateur est déjà connecté, nous regardons si le type d'utilisateur (prof/admin/étudiant) a accès à la page et si ce n'est pas le cas nous le redirigons à une page 401 pour notifier l'erreur d'autorisation.
```
Exemple
se connecter en tant qu'étudiant et clicker sur le button space professeur.
```

### L'IA dans le projet
Pour le projet, nous avons utilisé l'IA GitHub Copilot.
Nous avons utilisé l'IA pour faire sortir des fonctions de l'eventListener (de plus de 800 lignes) dans le fichier de JS modularSection.js, cela a marché avec le premier prompt et toutes les fonctions marche bien.
```prompt
Please just take all the functions out of the eventlistener and only make it call them when needed while keeping the same functionablility and without modifying ainything from the functions themselves
```

Le point complexe que nous avons demandé à l'IA à faire, c'est régler un bug dans la sous-garde de l'édition d'un chapitre, l'IA a corrigé le problème avec un seul essay.
```prompt
now can you fix the saving of chapters on the function chapters Edit? after getting the answers from the form on the page 'Chapters/edit.php' all the right infos are sent but, for an unknown reason, the chapter cant be saved, feel free to edit the edit function on ChaptersController.php and the form on Chapters/edit.php if needed
```
### Débogage
Comme le projet est Web, ce n'est pas possible utiliser le déboguer de l'IDE, notre stratégie est de montrer les données avec `var_dump` ou la fonction de cakePHP `dd` car en temps normal les origines des problèmes sont des variables vides ou null et pour les fichiers JS, nous utilisons la console du navigateur parce que c'est la seule manière d'observer le problème.

Nous avons amélioré le projet avec la mise en place d'une architecture MVC plus claire.
Nous avons refactorisé les fonctions qui sont difficiles à comprendre, qui se répètent.
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

