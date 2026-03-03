# Exerciseur en ligne
salut celui-là cet un projet  dans le cadre de la SAÉ pour le deuxième, le projet
consiste d'une page web pour la realisation et la creation d'exercices pour les étudiants
Cet projet est déjà le refacto du projet SAÉ créé dans une premiere estance sans le framework de cakephp
voici le lien au projet https://github.com/JeromeTardivon/Exerciseur-en-Ligne



Nous avons amelioré le projet avec la mise en place d'une architecture MVC plus claire.
nous avons refactoricé les fonctions qui sont dificile à comprendrer, qui se repetent
## Installation

1. Download [Composer](https://getcomposer.org/doc/00-intro.md) or update `composer self-update`.
2. Run `php composer.phar create-project --prefer-dist cakephp/app [app_name]`.

If Composer is installed globally, run

```bash
composer create-project --prefer-dist cakephp/app
```

In case you want to use a custom app dir name (e.g. `/myapp/`):

```bash
composer create-project --prefer-dist cakephp/app myapp
```

You can now either use your machine's webserver to view the default home page, or start
up the built-in webserver with:

```bash
bin/cake server -p 8765
```

Then visit `http://localhost:8765` to see the welcome page.

