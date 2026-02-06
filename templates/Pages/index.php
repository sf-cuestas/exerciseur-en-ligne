<main id="home-page">
    <div class="searching-section">
        <?= $this->Form->create(null, [])?>
        <div>
            <?= $this->Form->control('exerciseSearch',['label' => 'Rechercher un chapitre par mot clé']) ?>
            <?= $this->Form->button('Rechercher', ['class' => 'btn']) ?>
        </div>
        <?= $this->Form->end()?>
        <!--<form action="/processing-forms/processing-chapter-search.php" method="get"> -->
        <?= $this->Form->create(null, [])?>
        <div>
            <?= $this->Form->control('classSearch', ['label'=> 'Rechercher une classe']) ?>
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
