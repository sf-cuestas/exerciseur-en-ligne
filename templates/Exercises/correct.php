<main id="chapter-creation">   
    <script>
        let answers = <?= json_encode($answersDecoded) ?>;
        localStorage.setItem('studentAnswers', JSON.stringify(answers));
    </script>
    <aside id=chapter-creation-aside-1>
        <h2>Outils</h2>
        <div>
            <div id="add-symbols-btn">

            </div>

            <div id="symbols">

            </div>
        </div>
    </aside>

    <?= $this->Form->create($exercise, ["id" => "dynamic-form", "method" => "post"]); // because cake php is too stupid to follow its own doc and put this shit on post by default ?>
    <fieldset>
        <div id="exercise-container">
        <!-- where the CSS will add the stuff to correct -->
        </div>
    </fieldset>

    <?= $this->Form->submit(__('Valider les réponses'), ["id" => "accept-changes"]); ?>

    <?= $this->Form->end(); ?>

</main>

<?= $this->Html->script(["exerciseCorrection"]) ?>