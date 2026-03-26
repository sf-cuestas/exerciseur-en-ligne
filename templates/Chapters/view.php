<main id="modif-selection">
    <?= $this->Form->create($chapter) ?>
    <fieldset>
        <legend   nd>Paramètres</legend>
        <ul>
            <li><h3>Visibilité</h3></li>
            <li>
                <?= $this->Form->radio('visibility', ['1' => 'Publique', '0' => 'Privée', ], ['value' => '0']) ?>
            </li>
            <li><h3>Niveau</h3></li>

            <li>
                <?php echo $this->Form->label("level-select", 'Choisissez le niveau du chapitre'); ?>
                <?php echo $this->Form->select('level-select', [
                    "Non spécifié", "Primaire", "CE1", "CE2", "CM1", "CM2", "Collège", "Sixième", "Cinquième", "Quatrième", "Troisième", "Lycée", "Seconde",
                    "Première", "Terminale", "Etudes Supérieures"
                ], ["id" => "level-select"]); ?>
            </li>

            <li><h3>Limite de temps</h3></li>

            <li>
                <?= $this->Form->checkbox("timelimit", ['hiddenField' => false, "id" => "timelimit"]); ?>
                <?= $this->Form->label('timelimit', "Ajouter une limite de temps"); ?>
            </li>

            <li>
                <div id="timelimit-box"> <!-- hide everything in this span if checkbox not checked -->
                    <?php echo $this->Form->label('timelimit-hours', "Heures"); ?>
                    <?= $this->Form->number("timelimit-hours", ["id" => "timelimit-hours", "min" => "0", "max" => "2048", "step" => "1", "value" => "0"]); ?>

                    <?php echo $this->Form->label('timelimit-minutes', "Minutes"); ?>
                    <?= $this->Form->number("timelimit-minutes", ["id" => "timelimit-minutes", "min" => "0", "max" => "59", "step" => "1", "value" => "30"]); ?>

                    <?php echo $this->Form->label('timelimit-seconds', "Secondes"); ?>
                    <?= $this->Form->number("timelimit-seconds", ["id" => "timelimit-seconds", "min" => "0", "max" => "59", "step" => "1", "value" => "0"]); ?>
                </div>
            </li>

            <li><h3>Classe</h3></li>

            <li>
                <?php 
                    echo $this->Form->label('class-select', "Choisissez la classe dans laquelle ce chapitre sera inscrite");
                    $classesNames = ["unspecified" => "Hors d'une classe"];
                    foreach($listClasses as $class) {
                        $classesNames[$class['name']] = $class['name'];
                    }

                    echo $this->Form->select('level-select', $classesNames, ['id' => "class-select"]);
                ?>
            </li>

            <li>
                <div id="grade-options">
                    <?= $this->Form->checkbox("graded", ['hiddenField' => false, "id" => "graded", "value" => "3"]); ?>
                    <?= $this->Form->label('graded', "Noter ce chapitre?"); ?>

                    <div id="coefficient-box">
                        <?= $this->Form->label('grade-weight', "Coefficient :"); ?>
                        <?= $this->Form->number("grade-weight", ["id" => "grade-weight", "min" => "1", "max" => "100", "step" => "1", "value" => "1"]); ?>
                    </div>
                </div>
            </li>

            <li><h3>Essais</h3></li>

            <li>
                <?= $this->Form->checkbox("limittry", ['hiddenField' => false, "id" => "limittry", "value" => "3"]); ?>
                <?= $this->Form->label('limittry', "Limiter le nombre d'essais pour le chapitre complet ?"); ?>

                <div id="limit-try-options">
                    <?= $this->Form->label('try-number', "Nombre d'essais autorisés :"); ?>
                    <?= $this->Form->number("try-number", ["id" => "try-number", "min" => "1", "max" => "100", "step" => "1", "value" => "1"]); ?>
                </div>
            </li>

            <li><h3>Correction</h3></li>

            <li>
                <?= $this->Form->checkbox("correctionend", ['hiddenField' => false, "id" => "correctionend"]); ?>
                <?= $this->Form->label('correctionend', "Afficher la correction à la fin du chapitre ?"); ?>
            </li>

            <li><h3>Tags</h3></li>

            <li>
                <?= $this->Form->label('tags-input', "Ajouter des tags (séparés par des virgules)"); ?>
                <?= $this->Form->text("tags-input", ["id" => "tags-input", "placeholder" => "ex: mathématiques, géométrie, fonctions"]); ?>
            </li>
        </ul>
    </fieldset>

    <fieldset>
        <legend>Création</legend>
        <ul>
            <li><?= $this->Form->label('title', "Titre :", ["class" => "subTitle3"]); ?></li>
            <li><?= $this->Form->text('title', ['id' => "title", "placeholder" => "Entrez le titre du chapitre ici", "required" => true]); ?></li>
            <li><?= $this->Form->label('desc', "Description :", ["class" => "subTitle3"]); ?></li>
            <li><?= $this->Form->textarea('desc', ['id' => "desc", "rows" => "10", "required" => true]); ?></li>
        </ul>
    </fieldset>

    <?php echo $this->Form->submit(__('Valider la modifiacation des paramètres du chapitre')); ?>
    <?= $this->Form->end() ?>

    <ul>   
        <li><h3>Choisir un Exercice à modifier</h3></li>
                
        <?php 
            foreach($listExercises as $ex) {
                echo "<li>" . $this->Html->link($ex['title'], ['controller' => 'Exercises', 'action' => 'edit', $ex['id']], ['escape' => false, 'class' => 'btn']) . "</li>";
            }
            
        ?>
        <li>
            <?= $this->Html->link("Ajouter un exercice", ['controller' => 'Exercises', 'action' => 'add', $chapter['id']], ['class' => 'btn']) ?>
        </li>
    </ul>

    <?= $this->Html->link('Annuler',['controller' => 'Classses', 'action' => 'teachersSpace'],['escape'=>false,'class'=>'btn']) ?>  
</main>