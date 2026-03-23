<main id="teacher-space">
    <?= $this->Form->create() ?>
    <div>
        <!-- sert pour le carré de couleur dans le wireframing, comme ça le bouton "créer classe" reste dans le div -->
        <div>
            <h2>Gérer mes classes</h2>

            <div class="search">
                <?= $this->Form->control('class-search', ['class' => 'btn', 'label' => 'Rechercher classe', 'value' => $classSearch]) ?>
                <?= $this->Form->button("Rechercher", ['class' => 'btn']) ?>
            </div>

            <!-- le contenu de la liste sera à changer avec du php pour avoir la liste des classes auquels il a accès -->
            <!-- le nb de li sera en fonction de la hauteur de l'écran -->
            <ul>
                <?php
                foreach ($listClasses as $class) { ?>
                    <li><?= $this->Html->link($class->name, ['controller' => 'Classses', 'action' => 'viewClass', $class->id], ['class' => 'btn']) ?></li>
                <?php }
                ?>
            </ul>
        </div>

        <h2><?= $this->Html->link('Créer classes', ['controller' => 'Classses', 'action' => 'add'], ['class' => 'btn']) ?></h2>
    </div>

    <div>
        <!-- sert pour le carré de couleur dans le wireframing, comme ça le bouton "créer classe" reste dans le div -->
        <div>
            <h2>Gérer mes chapitres</h2>

            <div class="search">
                <?= $this->Form->control('chapter-search', ['class' => 'btn', 'placeholder' => 'Rechercher chapitre', 'value' => $chapterSearch]) ?>
                <?= $this->Form->button("Rechercher", ['class' => 'btn']) ?>
            </div>
            <ul>
                <?php

                foreach ($listChapters as $chapter) { ?>
                    <li>
                        <?= $this->Html->link($chapter->title, ['controller' => 'Chapters', 'action' => 'view', $chapter->id], ['class' => 'btn']) ?>
                    </li>
                <?php }
                ?>
            </ul>
        </div>
        <h2><?= $this->Html->link('Créer chapitres', ['controller' => 'Chapters', 'action' => 'add'], ['class' => 'btn']) ?></h2>
    </div>
</main>
