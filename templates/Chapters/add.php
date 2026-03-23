<main id="chapter-creation">
    
    <?= $this->Form->create(null,['url' => ['controller' => 'Chapters', 'action' => 'add'], 'type' => 'post']) ?>
        <fieldset>
            <legend>Paramètres</legend>
            <ul>
                <li><h3>Visibilité</h3></li>
                <li><?= $this->Form->radio('visible', ['1' => 'Publique', '0' => 'Privée'],['default' => '1']) ?></li>
                <li><h3>Niveau</h3></li>
                <li>
                    <?= $this->Form->control('level', ['type' => 'select', 'options' => [
                        '0' => 'Non spécifié',
                        '1' => 'Primaire',
                        '2' => 'CE1',
                        '3' => 'CE2',
                        '4' => 'CM1',
                        '5' => 'CM2',
                        '6' => 'Collège',
                        '7' => 'Sixième',
                        '8' => 'Cinquième',
                        '9' => 'Quatrième',
                        '10' => 'Troisième',
                        '11' => 'Lycée',
                        '12' => 'Seconde',
                        '13' => 'Première',
                        '14' => 'Terminale',
                        '15' => 'Etudes Supérieures'
                    ],'label' => 'Choisissez le niveau d\'étude correspondant : ']) ?>
                </li>
                <li><h3>Limite de temps</h3></li>

                <li>
                    <?= $this->Form->label('timelimit', 'Ajouter une limite de temps') ?>
                    <?= $this->Form->checkbox('timelimit', ['id' => 'timelimit']) ?>
                </li>
                <li>
                    <div id="timelimit-box"> <!-- hide everything in this span if checkbox not checked -->
                        <?= $this->Form->label('timelimit_hours', 'Heures', ['class' => 'visually-hidden']) ?>
                        <?= $this->Form->number('timelimit_hours', ['id' => 'timelimit-hours', 'min' => 0, 'max' => 2048, 'step' => 1, 'value' => 0]) ?>
                        <?= $this->Form->label('timelimit_minutes', 'Minutes') ?>
                        <?= $this->Form->number('timelimit_minutes', ['id' => 'timelimit-minutes', 'min' => 0, 'max' => 59, 'step' => 1, 'value' => 0]) ?>
                        <?= $this->Form->label('timelimit_seconds', 'Secondes') ?>
                        <?= $this->Form->number('timelimit_seconds', ['id' => 'timelimit-seconds', 'min' => 0, 'max' => 59, 'step' => 1, 'value' => 0]) ?>
                        
                    </div>
                </li>
                <li><h3>Classe</h3></li>
                <li>
                    <?= $this->Form->label('class', 'Choisissez la classe dans laquelle ce chapitre sera inscrit') ?>
                    <?= $this->Form->select('class', ['unspecified' => 'Hors d\'une classe'] + array_combine(array_column($classes, 'name'), array_column($classes, 'name')), ['id' => 'class']) ?>
                </li>
                <li>
                    <div id="grade-options"><!-- only show this span if a class is selected -->
                        <?= $this->Form->label('graded', 'Noter ce chapitre ?') ?>
                        <?= $this->Form->checkbox('graded', ['id' => 'graded']) ?>
                        <div id="coefficient-box"> <!-- only show this span if 'graded' checkbox checked -->
                            <?= $this->Form->label('weight', 'Coefficient :') ?>
                            <?= $this->Form->number('weight', ['id' => 'weight', 'min' => 1, 'max' => 100, 'step' => 1, 'value' => 1]) ?>
                        </div>
                    </div>
                </li>

                <li><h3>Essais</h3></li>

                <li>
                    <?= $this->Form->label('limittry', 'Limiter le nombre d\'essais ? (pour le chapitre complet)') ?>
                    <?= $this->Form->checkbox('limittry', ['id' => 'limittry']) ?>
                    <div id="limit-try-options"> <!-- only show this span if 'limittry' checkbox checked -->
                        <?= $this->Form->label('tries', 'Nombre d\'essais autorisés :') ?>
                        <?= $this->Form->number('tries', ['id' => 'tries', 'min' => 1, 'max' => 100, 'step' => 1, 'value' => 1]) ?>
                    </div>
                        
                </li>
                <li><h3>Correction</h3></li>
                <li>
                    <?= $this->Form->checkbox('corrend', ['id' => 'corrend']) ?>
                    <?= $this->Form->label('corrend', 'Afficher la correction à la fin du chapitre?') ?>
                </li>

                <li><h3>Tags</h3></li>
                <li>
                    <?= $this->Form->label('tags-input', 'Ajouter des tags (séparés par des virgules)') ?>
                    <?= $this->Form->text('tags', ['id' => 'tags-input', 'placeholder' => 'ex: mathématiques, géométrie, triangles']) ?>
                </li>
                   
            </ul>
        </fieldset>
        <fieldset>
            <legend>Création</legend>
            <ul>
                <li>
                    <?= $this->Form->label('title', 'Titre :',['class' => 'subTitle3']) ?>
                </li>
                <li>
                    <?= $this->Form->text('title', ['id' => 'title', 'placeholder' => 'Entrez le titre du chapitre ici', 'required' => true]) ?>
                </li>
                <li>
                    <?= $this->Form->label('description', 'Description :', ['class' => 'subTitle3']) ?>
                </li>
                <li>
                    <?= $this->Form->textarea('description', ['id' => 'description', 'rows' => 10, 'required' => true]) ?>
                </li>
            </ul>
        </fieldset>
        <div>
            <?= $this->Form->button('Valider', ['type' => 'submit', 'class' => 'btn']) ?>
        </div>
    </form>
</main>