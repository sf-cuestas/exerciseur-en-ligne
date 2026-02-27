<main id="class-search">
    <?= $this->Form->create() ?>
        <div>
            <?= $this->Form->control('search-class', ['label' => 'Rechercher une classe'])?>
            <?= $this->Form->button('Rechercher') ?>
            <label class="titleSearchBar" for="classSearchBar">Rechercher une classe</label>
            <div>
                <input type="search" id="classSearchBar" name="search" class="btn">
                <button type="submit" class="btn">Rechercher</button>
            </div>

        </div>
    <?= $this->Form->end() ?>
    <h2>Résultats</h2>
    <?php if (isset($res) && count($res) == 0) { echo "<p>il n'y a aucune classe avec '$search'</p>";} ?>
    <ol>
        <?php foreach ($res as $r) { echo "<li><a href='/../class.php?id-class=".  $r['id'] . "' >" . $r['name'] . "</a></li>";} ?>
    </ol>
</main>
