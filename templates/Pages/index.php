<main id="home-page">
    <div class="searching-section">
        <?= $this->Form->create()?>
        <div>
            <?= $this->Form->control('exerciseSearchBar', ['type' => 'search','label' => ['text' => 'Rechercher un chapitre par mot clé', 'class' => 'titleSearchBar']]) ?>
            <?= $this->Form->button('Rechercher', ['class' => 'btn']) ?>
        </div>
        <?= $this->Form->end()?>
        <!--<form action="/processing-forms/processing-chapter-search.php" method="get"> -->
        <?= $this->Form->create(null, [])?>
        <div>
            <?= $this->Form->control('classSearchBar', ['type' => 'search','label' => ['text' =>'Rechercher une classe', 'class' => 'titleSearchBar']]) ?>
            <?= $this->Form->button('Rechercher', ['class' => 'btn']) ?>
        </div>
        <?= $this->Form->end()?>
        <!--<form action="/processing-forms/processing-class-search.php" method="get">
            <div>
                <label class="titleSearchBar" for="classSearchBar">Rechercher une classe</label>
                <div>
                    <input type="search" id="classSearchBar" name="search" class="btn">
                    <button type="submit" class="btn">Rechercher</button>
                </div>
            </div>
        </form>-->
    </div>
</main>
