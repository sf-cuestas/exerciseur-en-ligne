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

    <?= $this->Form->create($exercise, ["id" => "dynamic-form"]); ?>
    <fieldset>
        <div id="exercise-container">
        <!-- where the CSS will add the stuff to correct -->
        </div>
    </fieldset>

    <?= $this->Form->submit(__('Valider lesq réponses'), ["id" => "accept-changes"]); ?>

    <?= $this->Form->end(); ?>

</main>

<?= $this->Html->script(["exerciseCorrection"]) ?>