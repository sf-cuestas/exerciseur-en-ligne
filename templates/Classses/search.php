<main id="class-search">
    <?= $this->Form->create() ?>
    <div>
        <?= $this->Form->control('search-class',
            ['type' => 'search',
                'id' => 'classSearchBar',
                'class' => 'btn',
                'value' => $search,
                'label' => ['text' => 'Rechercher une classe', 'class' => 'titleSearchBar']]) ?>
        <?= $this->Form->button('Rechercher', ['class' => 'btn']) ?>
    </div>
    <?= $this->Form->end() ?>
    <h2>Résultats</h2>
    <?php if (isset($results) && count($results) == 0) {
        echo "<p>il n'y a aucune classe avec '$search'</p>";
    } ?>
    <ol>
        <?php foreach ($results as $r) {
            echo "<li>". $this->Html->link($r->name, ['controller' => 'Classses', 'action' => 'viewClass', $r->id]) . "</li>";
        } ?>
    </ol>
</main>
