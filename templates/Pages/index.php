<main id="home-page">
    <div class="searching-section">
        <?= $this->Form->create()?>
        <div>
            <?= $this->Form->control('exerciseSearchBar', ['type' => 'search','label' => ['text' => 'Rechercher un chapitre par mot clé', 'class' => 'titleSearchBar']]) ?>
            <?= $this->Form->button('Rechercher', ['class' => 'btn']) ?>
        </div>
        <?= $this->Form->end()?>
        <?= $this->Form->create(null, [])?>
        <div>
            <?= $this->Form->control('classSearchBar', ['type' => 'search','label' => ['text' =>'Rechercher une classe', 'class' => 'titleSearchBar']]) ?>
            <?= $this->Form->button('Rechercher', ['class' => 'btn']) ?>
        </div>
        <?= $this->Form->end()?>
    </div>
</main>
