<main id="signup">
    <?= $this->Form->create($user) ?>
    <h3>Inscription</h3>
    <fieldset>
        <fieldset>
            <legend>Statut</legend>
            <?= $this->Form->radio('status', ['student' => 'Étudiant(e)', 'teacher' => 'Enseignant(e)', ], ['value' => 'student']) ?>
        </fieldset>
        <fieldset>
            <legend>Identité</legend>
            <?= $this->Form->control('name', ['placeholder' => 'Nom', 'label' => 'Nom']) ?>
            <?= $this->Form->control('surname', ['placeholder' => 'Prenom', 'label' => 'Prenom']) ?>
            <?= $this->Form->control('email', ['placeholder' => 'Email', 'label' => 'Email']) ?>
            <?= $this->Form->control('password', ['placeholder' => 'Mot de passe', 'label' => 'Mot de passe']) ?>
            <?= $this->Form->control('schoolId', ['placeholder' => 'Numero universitaire', 'label' => 'Numero universitaire']) ?>
            <?= $this->Form->control('teacher-creation-code', ['placeholder' => 'Code de creation', 'label' => ['text' => 'Code de creation', 'id' => 'teacher-creation-code-label']]) ?>
        </fieldset>
        <?= $this->Form->button('Valider', ['class' => 'btn']) ?>
    </fieldset>
    <?= $this->Form->end() ?>
</main>
