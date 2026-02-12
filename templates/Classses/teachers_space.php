<main id="teacher-space">
    <form action="teacher-space.php" method="get">
        <div>
            <!-- sert pour le carré de couleur dans le wireframing, comme ça le bouton "créer classe" reste dans le div -->
            <div>
                <h2>Gérer mes classes</h2>

                <div class="search">
                    <label for="class-search"></label><input class="btn" type="search" id="class-search" name="class-search" placeholder="Rechercher classe" value="<?=$classSearch ?>">
                    <button type="submit" class="btn">Rechercher</button>
                </div>

                <!-- le contenu de la liste sera à changer avec du php pour avoir la liste des classes auquels il a accès -->
                <!-- le nb de li sera en fonction de la hauteur de l'écran -->
                <ul>
                    <?php

                    foreach ($listClasses as $class) { ?>
                        <li><a class="btn"
                               href="class.php?id-class=<?= $class['id'] ?>"><?= $class['name'] ?></a></li>
                    <?php }
                    ?>
                </ul>
            </div>

            <h2><a class="btn" href="create-class.php">Créer classes</a></h2>
        </div>

        <div>
            <!-- sert pour le carré de couleur dans le wireframing, comme ça le bouton "créer classe" reste dans le div -->
            <div>
                <h2>Gérer mes chapitres</h2>

                <div class="search">
                    <label for="chapter-search"></label><input class="btn" type="search" id="chapter-search" name="chapter-search" placeholder="Rechercher chapitre" value="<?=$chapterSearch ?>">
                    <button type="submit" class="btn">Rechercher</button>
                </div>


                <ul>
                    <?php

                    foreach ($listChapters as $chapter) { ?>

                        <li><a class="btn"
                               href="modif-selection.php?id-chapter=<?= $chapter['id'] ?>"><?= $chapter['title'] ?></a>
                        </li>
                    <?php }
                    ?>
                </ul>
            </div>

            <h2><a class="btn" href="chapter-creation.php">Créer chapitres</a></h2>
        </div>
    </form>
    <div <?= $_SESSION["user"]["type"] == "admin" ? "" : "hidden" ?>>
        <form method="post" action="/processing-forms/processing-creation-code-teacher.php">
            <input class="btn" type="submit" value="Créer code pour professeur" name="create-code">
        </form>
        <div <?= empty($code) ? "hidden" : "" ?>>
            <p>Code créé <?= $code ?></p>
        </div>

    </div>
</main>
