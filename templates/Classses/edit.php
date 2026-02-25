<main id="main-class">
    <h1><?= $class['name'] ?></h1>
    <section>

        <div id="class-responsable">
            <h2>Responsable(s):</h2>
            <?php foreach ($teachers as $teacher) {echo "<h3>".$teacher['name'] . ' ' . $teacher['surname']."</h3>";} ?>
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
                    <?php
                    foreach ($listChapters as $chapter) { ?>
                        <li class="">
                            <div>
                                <a href="chapter.php?id-chapter=<?= $chapter['id'] ?>"><?= $chapter['title'] ?></a>
                                <p><?=$chapter['description']?></p>
                            </div>
                        </li>
                        <?php }
                    ?>
                </ul>
        </div>
    </div>
    </section>

    <section>
        
        <!-- Responsables -->
        <div>
            
            <h2>Ajouter Responsables</h2>
            <div class="class-adding">
                <form action="/editor-class.php" method="get">
                    <label for="teacher-search"></label><input type="search" id="teacher-search" name="teacher-search" value="<?= $teacherSearch ?>">
                    <label for="id-class"></label><input type="text" value="<?= $_GET['id-class'] ?>" name="id-class" id="id-class" hidden>
                    <input type="submit" class="btn" value="Rechercher responsable">
                </form>
                <ul>
                    <?php foreach ($listAllTeachers as $teacher) { ?>
                        <li>
                            <div>
                                <a href="profile.php?id-profil=<?= $teacher['id'] ?>"><?= $teacher['name'] . " " . $teacher['surname'] ?></a>
                                <form action="/processing-forms/processing-form-class-edition.php" method="post">
                                    <input type="hidden" name="add-teacher" value="<?= $teacher['id'] ?>">
                                    <input type="hidden" name="class" value="<?= $class['id'] ?>">
                                    <input class="btn" type="submit" value="Ajouter">
                                </form>
                            </div>
                        </li>
                    <?php } ?>
                </ul>
            <h2 <?= empty($teachers) ? "hidden" : "" ?>>Liste des Responsables inscrits</h2>
            <ul>
                <?php foreach ($teachers as $teacher) { ?>
                    <li>
                        <div>
                            <a href="profile.php?id-profil=<?= $teacher['id'] ?>"><?= Database::getInstance()->getUser($teacher['id'])['name'] ?></a>
                            <form action="/processing-forms/processing-form-class-edition.php" method="post">
                                <input type="hidden" name="delete-teacher" value="<?= $teacher['id'] ?>">
                                <input type="hidden" name="class" value="<?= $class['id'] ?>">
                                <input class="btn" type="submit" value="Supprimer">
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
                <form action="/editor-class.php" method="get">
                    <label for="student-search"></label><input type="search" id="student-search" name="student-search" value="<?= $studentSearch ?>">
                    <label for="id-class"></label><input type="text" value="<?= $_GET['id-class'] ?>" name="id-class" id="id-class" hidden>
                    <button type="submit" class="btn">Rechercher étudiant</button>
                </form>
                <ul>
                <?php foreach ($listAllStudents as $student) { ?>
                    <li class="">
                        <div>
                            <a href="profile.php?id-profil=<?= $student['id'] ?>"><?= $student['name'] . " " . $student['surname'] ?></a>
                            <form action="/processing-forms/processing-form-class-edition.php" method="post">
                                <input type="hidden" name="add-student" value="<?= $student['id'] ?>">
                                <input type="hidden" name="class" value="<?= $class['id'] ?>">
                                <input class="btn" type="submit" value="Ajouter">
                            </form>
                        </div>
                    </li>
                <?php } ?>
                </ul>
                <div>
                    <h2 <?= (isset($_SESSION['studentsToAdd']) && !empty($_SESSION['studentsToAdd'])) ? "" : "hidden" ?>>Liste des étudiants à ajouter</h2>
                    <ul>
                        <?php
                        if (isset($_SESSION['studentsToAdd'])) {
                            foreach ($_SESSION['studentsToAdd'] as $student) { ?>
                                <li>
                                    <div id="class-delete-students">
                                        <a href="profile.php?id-profil=<?= $student ?>"><?= Database::getInstance()->getUser($student)['name'] ?></a>
                                        <form action="/processing-forms/processing-form-class-edition.php" method="post">
                                            <input type="hidden" name="delete-student" value="<?= $student ?>">
                                            <input type="hidden" name="class" value="<?= $class['id'] ?>">
                                            <input class="btn" type="submit" value="Supprimer">
                                        </form>
                                    </div>
                                </li>
                        <?php } } ?>
                    </ul>
                    <form action="/processing-forms/processing-form-class-edition.php"
                    method="post" <?= (isset($_SESSION['studentsToAdd'])) && !empty($_SESSION['studentsToAdd']) ? "" : "hidden" ?>>
                    <input type="hidden" name="add-student-db" value="true">
                        <input type="hidden" name="class" value="<?= $class['id'] ?>">
                        <input class="btn" type="submit" value="Ajouter les étudiants">
                        </form>
                    </div>
                    
                    <h2 <?= empty($listStudents) ? "hidden" : "" ?>>Liste des étudiants inscrits</h2>
                    <ul>
                        <?php foreach ($listStudents as $student) { ?>
                            <li class="">
                                <div>
                                    <a href="profile.php?id-profil=<?= $student['id_user'] ?>"><?= Database::getInstance()->getUser($student['id_user'])['name'] ?></a>
                                    <form action="/processing-forms/processing-form-class-edition.php" method="post">
                                        <input type="hidden" name="delete-student-db" value="<?= $student['id_user'] ?>">
                                        <input type="hidden" name="class" value="<?= $class['id'] ?>">
                                        <input class="btn" type="submit" value="Supprimer">
                                    </form>
                                </div>
                            </li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
    </section>
    
    
    <h2>Generation de codes d'invitation à la classe</h2>
    <div id="class-codes">
        <form action="/processing-forms/processing-form-class-edition.php" method="post">
            <label>Nombre d'usages:
                <input type="number" name="number-usages-code" value="1" min="1" max="67000">
            </label>
            <input type="hidden" name="class" value="<?= $class['id'] ?>">
            <input type="submit" name="generate-code-class" value="Créer code">
        </form>
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