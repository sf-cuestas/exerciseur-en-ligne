<main id="main-class">
    <h1><?= $class['name'] ?></h1>
    <section>

        <div id="class-responsable">
            <h2>Responsable(s):</h2>
            <?php foreach ($teachers as $teacher) {echo "<h3>".$teacher->name . ' ' . $teacher->surname."</h3>";} ?>
        </div>
        <div id="class-description">
            <?= $this->Form->create() ?>
            <fieldset>
                <legend>Modification de la Classe </legend>
                <?= $this->Form->control('name')?>
                <?= $this->Form->control('description') ?>
            </fieldset>
            <?= $this->Form->control('class', ['type'=>'hidden','value'=>'"'.$class['id'].'"' ]) ?>
            <?= $this->Form->button("Valider la Modification") ?>
            <?= $this->Form->end() ?>

            
        </div>
        
        <div>

            <h2 <?= empty($listChapters) ? "hidden" : "" ?>>Chapitres de la classe</h2>
            <div id="class-chapitres" <?= empty($listChapters) ? "hidden" : "" ?>>
                <ul>
                    <?php foreach ($listChapters as $chapter) { ?>
                        <li class="">
                            <div>
                                <?= $this->Html->link($chapter['title'], ['controller' => 'Chapters', 'action' => 'view', $chapter['id']]) ?>
                                <p><?=$chapter['description']?></p>
                            </div>
                        </li>
                    <?php }?>
                </ul>
        </div>
    </div>
    </section>

    <section>
        
        <!-- Responsables -->
        <div>
            
            <h2>Ajouter Responsables</h2>
            <div class="class-adding">
                <?= $this->Form->create(null, ['method' => 'get', 'action' => '/editor-class.php']) ?>
                <?= $this->Form->control('teacher-search', ['type' => 'search', 'label' => false, 'value' => $teacherSearch]) ?>
                <?= $this->Form->control('id-class', ['type' => 'hidden', 'value' =>$class['id']]) ?>
                <?= $this->Form->button("Rechercher responsable", ['class' => 'btn']) ?>
                <?= $this->Form->end() ?>       
                
                <ul>
                    <?php foreach ($listAllTeachers as $teacher) { ?>
                        <li>
                            <div>
                                <?= $this->Html->link($teacher['name'] . " " . $teacher['surname'], ['controller' => 'Users', 'action' => 'profile', $teacher['id']]) ?> 
                                <?= $this->Form->create(null, ['action' => '/processing-forms/processing-form-class-edition.php']) ?>
                                <?= $this->Form->control('add-teacher', ['type' => 'hidden', 'value' => $teacher['id']]) ?>
                                <?= $this->Form->control('class', ['type' => 'hidden', 'value' => $class['id']]) ?>
                                <?= $this->Form->button("Ajouter", ['class' => 'btn']) ?>
                                <?= $this->Form->end() ?>
                            </div>
                        </li>
                    <?php } ?>
                </ul>
            <h2 <?= empty($teachers) ? "hidden" : "" ?>>Liste des Responsables inscrits</h2>
            <ul>
                <?php foreach ($teachers as $teacher) { ?>
                    <li>
                        <div>
                            <?= $this->Html->link($teacher['name'] . " " . $teacher['surname'], ['controller' => 'Users', 'action' => 'profile', $teacher['id']]) ?>
                            <?= $this->Form->create(null, ['action' => '/processing-forms/processing-form-class-edition.php']) ?>
                            <?= $this->Form->control('delete-teacher', ['type' => 'hidden', 'value' => $teacher['id']]) ?>
                            <?= $this->Form->control('class', ['type' => 'hidden', 'value' => $class['id']]) ?>
                            <?= $this->Form->button("Supprimer", ['class' => 'btn']) ?>
                            <?= $this->Form->end() ?>
                            </form>
                        </div>
                    </li>
                    <?php } ?>
                </ul>
            </div>
        </div>
        
        <!-- Students -->
        
        <div>

            <h2>Ajouter étudiants</h2>
            <div class="class-adding">
                <?= $this->Form->create(null, ['method' => 'get', 'action' => '/editor-class.php']) ?>
                <?= $this->Form->control('student-search', ['type' => 'search', 'label' => false, 'value' => $studentSearch]) ?>
                <?= $this->Form->control('id-class', ['type' => 'hidden', 'value' => $class['id']]) ?>
                <?= $this->Form->button("Rechercher étudiant", ['class' => 'btn']) ?>
                <?= $this->Form->end() ?>
                
                <ul>
                <?php foreach ($listAllStudents as $student) { ?>
                    <li class="">
                        <div>
                            <?= $this->Html->link($student['name'] . " " . $student['surname'], ['controller' => 'Users', 'action' => 'profile', $student['id']]) ?>
                            <?= $this->Form->create(null, ['controller'=>'Classses','action' => 'edit']) ?>
                            <?= $this->Form->control('add-student', ['type' => 'hidden', 'value' => $student['id']]) ?>
                            <?= $this->Form->control('class', ['type' => 'hidden', 'value' => $class['id']]) ?>
                            <?= $this->Form->button("Ajouter", ['class' => 'btn']) ?>
                            <?= $this->Form->end() ?>
                        </div>
                    </li>
                <?php } ?>
                </ul>
                <div>
                    <h2 <?= empty($studentsToAdd) ? "hidden" : "" ?>>Liste des étudiants à ajouter</h2>
                    <ul>
                        <?php
                        if (isset($studentsToAdd) && !empty($studentsToAdd)) {
                            foreach ($studentsToAdd as $student) { ?>
                                <li>
                                    <div id="class-delete-students">
                                        <?= $this->Html->link($student['name'] . " " . $student['surname'], ['controller' => 'Users', 'action' => 'profile', $student['id']]) ?>
                                        <?= $this->Form->create(null, ['action' => '/processing-forms/processing-form-class-edition.php']) ?>
                                        <?= $this->Form->control('delete-student', ['type' => 'hidden', 'value' => $student['id']]) ?>
                                        <?= $this->Form->control('class', ['type' => 'hidden', 'value' => $class['id']]) ?>
                                        <?= $this->Form->button("Supprimer", ['class' => 'btn']) ?>
                                        <?= $this->Form->end() ?>
                                        </form>
                                    </div>
                                </li>
                        <?php } } ?>
                    </ul>
                    <?= $this->Form->create(null, ['action' => '/processing-forms/processing-form-class-edition.php']) ?>
                    <input type="hidden" name="add-student-db" value="true">
                    <input type="hidden" name="class" value="<?= $class['id'] ?>">
                    <?= $this->Form->button("Ajouter les étudiants", ['class' => 'btn']) ?>
                    <?= $this->Form->end() ?>        
                    </div>
                    
                    <h2 <?= empty($listStudents) ? "hidden" : "" ?>>Liste des étudiants inscrits</h2>
                    <ul>
                        <?php foreach ($listStudents as $student) { ?>
                            <li class="">
                                <div>
                                    <?= $this->Html->link($student['name'] . " " . $student['surname'], ['controller' => 'Users', 'action' => 'profile', $student['id_user']]) ?>
                                    <?= $this->Form->create(null, ['action' => '/processing-forms/processing-form-class-edition.php']) ?>
                                    <?= $this->Form->control('delete-student-db', ['type' => 'hidden', 'value' => $student['id_user']]) ?>
                                    <?= $this->Form->control('class', ['type' => 'hidden', 'value' => $class['id']]) ?>
                                    <?= $this->Form->button("Supprimer", ['class' => 'btn']) ?>
                                    <?= $this->Form->end() ?>
                                </div>
                            </li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
    </section>
    
    
    <h2>Generation de codes d'invitation à la classe</h2>
    <div id="class-codes">

        <?= $this->Form->create(null, ['action' => '/processing-forms/processing-form-class-edition.php']) ?>
        <?= $this->Form->control('generate-code-class', ['type' => 'hidden', 'value' => 'true']) ?>
        <?= $this->Form->control('class', ['type' => 'hidden', 'value' => $class['id']]) ?>
        <?= $this->Form->control('number-usages-code', ['type' => 'number', 'label' => "Nombre d'usages :", 'value' => 1, 'min' => 1, 'max' => 67000]) ?>
        <?= $this->Form->button("Créer code") ?>
        <?= $this->Form->end() ?>
            
    <div>
        <h4>Codes Actifs</h4>
        <ul>
            <?php
            foreach ($activesClassCodes as $code) { ?>
                <li>
                    <div>
                        <p><?= $code['code'] ?></p>
                        <p><?= $code['num_usage'] ?></p>
                    </div>
                </li>
            <?php } ?>
        </ul>
    </div>
</main>