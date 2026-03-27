<main id="chapter-creation">
    <aside id=chapter-creation-aside-1>
        <h2>Outils</h2>
        <div>
            <div id="add-symbols-btn">

            </div>

            <div id="symbols">

            </div>
        </div>
    </aside>


    <?= $this->Form->create(null, ['id' => 'dynamic-form', 'method' => 'post']); ?>
        <fieldset>
            <legend><?= $exerciseTitle ?></legend>
            <?php echo $this->Form->text('content', ['id' => 'content', 'hidden' => false]); ?>
            <div id="exercise-container"></div>
        </fieldset>

        <?= $this->Form->submit(__('Valider les réponses'), ['id' => "accept-changes"]); ?>
    <?= $this->Form->end(); ?>
</main>

<?php      
    if (isset($_SESSION['clear_local_storage']) && $_SESSION['clear_local_storage']) {
        
        echo '<script>try{localStorage.removeItem("dynamicModules"); /*localStorage.clear();*/}catch(e){}</script>';
        unset($_SESSION['clear_local_storage']);
    }
?>

<?= $this->Html->script(["exercisePractice"]) ?>

<script>
    var payload = <?php echo $decoded !== null ? json_encode($decoded, JSON_UNESCAPED_UNICODE) : 'null'; ?>;
    //setting localstorage with exercise content so we dont need another function than "loadState()"
    if (payload !== null) {
        try { 
            localStorage.setItem('dynamicModules', JSON.stringify(payload)); } catch(e) { console && console.warn && console.warn('Failed to set dynamicModules', e); 
            $_SESSION['clear_local_storage'] = false;
        }
        
        } else {
        try { localStorage.removeItem('dynamicModules'); } catch(e) {}
    }
    
</script>