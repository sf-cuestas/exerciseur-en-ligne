<main id="main-class">
    <div id="class-info">
        <h1><?= $class->name ?></h1>
        <p><?= $class->description?></p>
    </div>
    <div class="display-row">
        <div id="class-responsable">
            <h2>Responsable(s) </h2>
            <?php foreach ($teachers as $teacher) {echo "<h3>".$teacher->name . ' ' . $teacher->surname."</h3>";} ?>
        </div>
        <div id="class-students" <?= (empty($students) || !$this->Identity->isLoggedIn()) ? "style = display:none" : "" ?>>
            <h2>Liste des étudiants inscrite</h2>
            <ul>
                <?php
                foreach ($students as $student) { ?>
                    <li class="">
                        <a href="profile.php?id-profil=<?= $student->id ?>"><?= $student->name ?></a>
                    </li>
                <?php } ?>
            </ul>
        </div>
    </div>
    <h2 <?= empty($chapters) ? "hidden" : "" ?>>Chapitres de la classe</h2>
    <div id="class-chapitres"  <?= empty($chapters) ? "hidden" : "" ?>>
        <ul>
            <?php
            foreach ($chapters as $chapter) { ?>
                <li class="">
                    <div>
                        <a href="exercise.php?id-chapter=<?= $chapter->id ?>&exercise-num=1"><?= $chapter->title ?></a>
                        <p><?=$chapter->description?></p>
                    </div>
                </li>
            <?php }
            ?>
        </ul>
    </div>
    <h2 <?=($this->Identity->isLoggedIn() && $isTeacher && $isResponsible) ?  "" : "hidden"?>>Generation de codes d'invitation à la classe</h2>
    <div id="class-codes" <?=($this->Identity->isLoggedIn() && $isTeacher && $isResponsible) ?  "" : "style = display:none" ?>>
        <?= $this->Form->create()?>
        <?= $this->Form->hidden('create-code-class',)?>
        <?= $this->Form->control('num_usages', ['label' => "Nombre d'usages:", 'value' => 1, 'min' => 1, 'max' => 67000, 'step' => 1]) ?>
        <?= $this->Form->Button('Créer code')?>
        <?= $this->Form->end()?>
        <div <?=($this->Identity->isLoggedIn() && $isTeacher && $isResponsible) ?  "" : "hidden" ?>>
            <h4 <?=($this->Identity->isLoggedIn() && $isTeacher && $isResponsible) ?  "" : "hidden" ?>>Codes Actifs</h4>
            <ul>
                <?php
                foreach ($classCodes as $code) { ?>
                    <li>
                        <div>
                            <p><?= $code['code'] ?></p>
                            <p><?= $code['num_usage'] ?></p>
                        </div>
                    </li>
                <?php } ?>
            </ul>
        </div>
    </div>
    <div <?=($this->Identity->isLoggedIn() && $isTeacher && $isResponsible) ?  "" : "hidden" ?>>
        <?php
        if ($isTeacher && $isResponsible) {
            ?>
            <a class="btn" href="editor-class.php?id-class=<?= $class->id ?>">Modifier</a>
        <?php } ?>
    </div>
</main>
<script> //reseting localstorage in case we come from the 'go back' button (<--)
    localStorage.removeItem('dynamicModules');
</script>
