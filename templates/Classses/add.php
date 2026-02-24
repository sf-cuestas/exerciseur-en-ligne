<main id="main-create-class">
    <?= $this->Form->create($class) ?>
    <fieldset>
        <legend>Création de classe</legend>
        <div>
            <?= $this->Form->control('name', ['label' => 'Entrez ici le nom de la classe']) ?>
        </div>
        <div>
            <?= $this->Form->control('description', ['label' => 'Entrez ici une description de la classe', 'rows' => '10', 'cols' => '50']) ?>
        </div>
    </fieldset>
    <?= $this->Form->button('Ajouter', ['class' => 'btn']) ?>
    <?= $this->Form->end() ?>
</main>
