<main id="chapter-search">
    <?= $this->Form->create() ?>
    <div>
        <?= $this->Form->control('search-chapter',
            ['type' => 'search',
                'id' => 'exerciseSearchBar',
                'class' => 'btn',
                'value' => $search,
                'label' => ['text' => 'Rechercher un chapitre', 'class' => 'titleSearchBar']]) ?>
        <?= $this->Form->button('Rechercher', ['class' => 'btn']) ?>
    </div>
    <?= $this->Form->end() ?>
    <h2>Résultats</h2>
    <?php if (isset($results) && count($results) == 0) {
        echo "<p>il n'y a aucun chapitre avec '$search'</p>";
    } ?>
    <ol>
        <?php foreach ($results as $r) {
            echo "<li>". $this->Html->link($r->title, ['controller' => 'Chapters', 'action' => 'view', $r->id]) . "</li>";
        } ?>
    </ol>
</main>
