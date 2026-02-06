<!DOCTYPE html>

<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?= $this->Html->css(['style']) ?>
    <?= $this->fetch('css') ?>
    <?= $this->Html->meta('favicon.ico', '/img/icon.png', ['type' => 'icon'])?>
    <!-- MODIFIER LA LOGIQUE DES TITRES PLZZZZ -->
    <title><?php if(isset($_TITLE)){echo $_TITLE;}else{echo "Exerciseur en ligne";} ?></title>
    <!-- PLZZZZZZZZZZZZZZZZZZZZZZZZZZZZZZZZZZZ -->
    <script id="MathJax-script" async src="https://cdn.jsdelivr.net/npm/mathjax@4/tex-mml-chtml.js"></script>
</head>


<body>

<header>
    <div class="barHeader">
        <?= $this->Html->image('exercisor3000.png', ['alt' => 'logo de la page', 'url' => ['controller' => 'Pages', 'action' => 'index']]) ?>
        <h1><?php if(isset($_TITLE)){echo $_TITLE;}else{echo "Exerciseur en ligne";} ?></h1>
        <div class="buttonsHeader">
            <?= $this->Html->link('Espace Professeurs',['controller' => 'Pages', 'action' => 'teachersSpace'], ['class' => 'btn']) ?>
            <?php
            if ($this->Identity->isLoggedIn()){
                echo $this->Html->link('Profil',['controller' => 'Users', 'action' => 'profile'], ['class' => 'btn']);
                echo $this->Html->link('Déconnexion',['controller' => 'Users', 'action' => 'logout'], ['class' => 'btn']);
            }else{
                echo $this->Html->link('Se connecter/Créer compte',['controller' => 'Users', 'action' => 'login'], ['class' => 'btn']);
            }
            ?>
        </div>
    </div>
    <nav id="menu">
        <ul>
            <li><?= $this->Html->link('Accueil', ['controller' => 'Pages', 'action' => 'index'])?></li>
            <li><?= $this->Html->link('À propos', ['controller' => 'Pages', 'action' => 'about'])?></li>
            <li><?= $this->Html->link('Contact', ['controller' => 'Pages', 'action' => 'contact'])?></li>
            <li><?= $this->Html->link('Paramètres', ['controller' => 'Pages', 'action' => 'settings'])?></li>
        </ul>
    </nav>
</header>

<?= $this->Flash->render() ?>
<?= $this->fetch('content') ?>

<footer>
    <p>Copyright © - Tous droits réservés</p>

    <div>
        <h3>
            Réalisé par :
        </h3>
        <ul>
            <li>Cléïa BARRALLON</li>
            <li>Samy-Félipe CUESTAS</li>
            <li>Bastien FELIX</li>
            <li>Jérôme TARDIVON</li>
        </ul>
    </div>

    <div>
        <h3>Coordonnées :</h3>

        <p>IUT de l'université Lyon1</p>
        <p>
            71 rue Peter Fink
            <br>
            01000 Bourg-en-Bresse
        </p>
    </div>
</footer>
<?= $this->Html->script(['chapter-creation-behavior', 'controlCreationUser', 'math-symbol', 'modular-section', 'sidebar-tools-behavior']) ?>
<?= $this->fetch('js') ?>
</body>
</html>
