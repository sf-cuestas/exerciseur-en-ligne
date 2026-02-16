<main id="teacher-space">
    <?= $this->Form->create()?>
        <div>
            <!-- sert pour le carré de couleur dans le wireframing, comme ça le bouton "créer classe" reste dans le div -->
            <div>
                <h2>Gérer mes classes</h2>

                <div class="search">
                    <?=$this->Form->control('class-search', ['class'=> 'btn','label' => 'Rechercher classe', 'value' => $classSearch])?>
                    <?=$this->Form->button("Rechercher", ['class' => 'btn'])?>
                </div>

                <!-- le contenu de la liste sera à changer avec du php pour avoir la liste des classes auquels il a accès -->
                <!-- le nb de li sera en fonction de la hauteur de l'écran -->
                <ul>
                    <?php
                    foreach ($listClasses as $class) {?>
                        <li><?=$this->Html->link($class->name, ['controller' => 'Classses', 'action' => 'viewClass',$class->id], ['class' => 'btn'])?></li>
                    <?php }
                    ?>
                </ul>
            </div>

            <h2><?= $this->Html->link('Créer classes', ['controller' => 'Classes', 'action' => 'add'], ['class' => 'btn'])?></h2>
        </div>

        <div>
            <!-- sert pour le carré de couleur dans le wireframing, comme ça le bouton "créer classe" reste dans le div -->
            <div>
                <h2>Gérer mes chapitres</h2>

                <div class="search">
                    <?= $this->Form->control('chapter-search',['class'=>'btn', 'placeholder' => 'Rechercher chapitre', 'value' => $chapterSearch])?>
                    <?=$this->Form->button("Rechercher", ['class' => 'btn'])?>
                </div>
                <ul>
                    <?php

                    foreach ($listChapters as $chapter) { ?>
                        <li>
                            <?= $this->Html->link($chapter->title, ['controller' => 'Classses', 'action' => 'viewChapter', $chapter->id], ['class' => 'btn'])?>
                        </li>
                    <?php }
                    ?>
                </ul>
            </div>
            <h2><?= $this->Html->link('Créer chapitres',['controller' => 'Classses', 'action' => 'addChapitre'], ['class' => 'btn'])?></h2>
        </div>
    <?= $this->Form->end()?>
    <div <?= $isAdmin ? "" : "hidden" ?>>
        <?= $this->Form->create()?>
        <?= $this->Form->control('create-code',['type'=>'hidden', 'value'=> true])?>
        <?= $this->Form->button('Créer code pour professeur', ['class' => 'btn', 'value' => 'create-teacher-code'])?>
        <?= $this->Form->end()?>
        <div <?= empty($codes) ? "hidden" : "" ?>>
            <p>Codes</p>
            <?php
                foreach ($codes as $code) {
                    echo '<p>'. $code->code . '</p>';
                }
            ?>
        </div>
    </div>
</main>
