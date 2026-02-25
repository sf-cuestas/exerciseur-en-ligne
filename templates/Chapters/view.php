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

            <li>
                <?php echo $this->Form->label('class-select', "Choisissez la classe dans laquelle ce chapitre sera inscrite"); ?>
                
            </li>
        </ul>
    </fieldset>
    <?= $this->Form->end() ?>
    <form action="processing-forms/processing-chapter-edition.php?id-chapter=<?= $chapter['id']; ?>" method="post">
        <fieldset>
            <legend>Paramètres</legend>
            <ul>
                <li><h3>Classe</h3></li>
                <li>
                    <label for="class-select">Choisissez la classe dans laquelle ce chapitre sera inscrite</label>
                    <select name="class-select" id="class-select">
                        <option value="unspecified">Hors d'une classe</option>
                        <!-- dynamically generates options with php, getting all classes the professor is responsible for in the database-->
                        <?php
                        foreach ($classes as $class) {
                            echo '<option value="' . $class["name"] . '">' . $class["name"] . '</option>';
                        }
                        ?>
                    </select>
                </li>
                <li>
                    <div id="grade-options"><!-- only show this span if a class is selected -->
                        <input id="graded" type="checkbox" name="graded" value="3"><label for="graded">Noter ce
                            chapitre?</label>
                        <div id="coefficient-box"> <!-- only show this span if 'graded' checkbox checked -->
                            <label for="grade-weight">Coefficient:</label>
                            <input id="grade-weight" name="grade_weight" type="number" min="1" max="100" step="1"
                                value="1">
                        </div>
                    </div>
                </li>

                <li><h3>Essais</h3></li>

                <li><input id="limittry" type="checkbox" name="limittry"><label for="limittry">Limiter le nombre
                        d'essais ? (pour le chapitre complet) </label>
                    <div id="limit-try-options"> <!-- only show this span if 'limittry' checkbox checked -->
                        <label for="try-number">Nombre d'essais autorisés :</label>
                        <input id="try-number" name="try_number" type="number" min="1" max="100" step="1" value="1">
                    </div>
                </li>
                <li><h3>Correction</h3></li>
                <li><input id="correctionend" type="checkbox" name="correctionend"><label for="correctionend">Afficher
                        la correction à la fin du chapitre?</label></li>

                <li><h3>Tags</h3></li>
                <li>
                    <label for="tags-input">Ajouter des tags (séparés par des virgules)</label>
                    <input id="tags-input" name="tags-input" type="text"
                        placeholder="ex: mathématiques, géométrie, fonctions">
                </li>
            </ul>
        </fieldset>
        <fieldset>
            <legend>Création</legend>
            <ul>
                <li><label class="subTitle3" for="title">Titre :</label></li>
                <li><input id="title" name="title" type="text" placeholder="Entrez le titre du chapitre ici" required></li>
                <li><label class="subTitle3" for="desc">Description :</label></li>
                <li><textarea id="desc" name="desc" rows="10" required></textarea></li>
            </ul>
        </fieldset>
        <button type="submit">Valider la modifiacation des paramètres du chapitre</button>
    </form>

    <ul>   
        <li><h3>Choisir un Exercice à modifier</h3></li>
                
        <?php 
                
            
        ?>
        <li>
            <?= $this->Html->link("Ajouter un exercice", ['controller' => 'Chapters', 'action' => 'add'], ['class' => 'btn']) ?>
        </li>
    </ul>
    <a href="teacher-space.php" class="btn">Annuler</a>
    
</main>