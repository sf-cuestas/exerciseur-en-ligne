<main id="chapter-creation">
    <div class = columnSideBar>
        <button  id="button-tools">outils</button>
        <div id="sidebar">
            <aside class="chapter-creation-aside">
                <h2>Outils</h2>
                <div>
                    <div id="add-symbols-btn"></div>
                    <div id="symbols"></div>
                </div>
            </aside>
            <aside class="chapter-creation-aside">
                <h2>Modules</h2>
                <form >
                    <button type="button" id="add-text">Ajouter un champ de texte</button>
                    <!-- show buttons if the span is clicked (and change image)-->
                    <input type="checkbox" id="dropdown" hidden/>
                    <label for="dropdown">Titres <?= $this->Html->image('Arrow-down.svg', ['alt' => 'arrow', 'width' => '5px', 'height' => '5px']) ?> </label>
                    <div>
                        <button type="button" id="add-title-1">Ajouter un titre 1</button>
                        <button type="button" id="add-title-2">Ajouter un titre 2</button>
                        <button type="button" id="add-title-3">Ajouter un titre 3</button>
                        <button type="button" id="add-title-4">Ajouter un titre 4</button>
                        <button type="button" id="add-title-5">Ajouter un titre 5</button>
                    </div>
                    <button type="button" id="add-multiple-choice">Ajouter une question QCM</button>
                    <button type="button" id="add-true-false">Ajouter une question Vrai/Faux</button>
                    <button type="button" id="add-open-question">Ajouter une question à réponse ouverte</button>
                    <button type="button" id="add-numerical-question">Ajouter une question numérique</button>
                    <button type="button" id="add-hint">Ajouter un indice</button>
                </form>
            </aside>
        </div>
    </div>

    <?= $this->Form->create($exercise, ['id' => "dynamic-form", "method" => "post"]) ?>
        <fieldset>
            <legend>Paramètres de la section</legend>   
            <ul>
                <li><h3>Options de notation</h3></li>
                <li>
                    <span>
                        <?= $this->Form->label('weight', "Coefficient (nécéssaire même si non notée, pour les statistiques):"); ?>
                        <?= $this->Form->number("weight", ["id" => "weight", "min" => "0", "max" => "100", "step" => "1", "value" => "0"]); ?>
                    </span>
                </li>

                <li><h3>Options de temps</h3></li>

                <li>
                    <span>
                        <?= $this->Form->label('timelimit-hours', "Heures", ["class" => 'visually-hidden']); ?>
                        <?= $this->Form->number("timelimit-hours", ["id" => "timelimit-hours", "min" => "0", "max" => "2048", "step" => "1", "value" => "0"]); ?>

                        <?= $this->Form->label('timelimit-minutes', "Minutes", ["class" => 'visually-hidden']); ?>
                        <?= $this->Form->number("timelimit-minutes", ["id" => "timelimit-minutes", "min" => "0", "max" => "59", "step" => "1", "value" => "30"]); ?>

                        <?= $this->Form->label('timelimit-seconds', "Secondes", ["class" => 'visually-hidden']); ?>
                        <?= $this->Form->number("timelimit-seconds", ["id" => "timelimit-seconds", "min" => "0", "max" => "59", "step" => "1", "value" => "0"]); ?>
                    </span>
                </li>

                <li><h3>Options d'essais</h3></li>

                <li>
                    <?= $this->Form->checkbox("tries", ['hiddenField' => false, "id" => "tries"]); ?>
                    <?= $this->Form->label('tries', "Limiter le nombre d'essais ?"); ?>

                    <span>
                        <?= $this->Form->label('tries-number', "Nombre d'essais autorisés :"); ?>
                        <?= $this->Form->number("tries-number", ["id" => "tries-number", "min" => "1", "max" => "100", "step" => "1", "value" => "1"]); ?>
                    </span>
                </li>

                <li><h3>Options de réponses</h3></li>

                <li>
                    <?= $this->Form->checkbox("ansdef", ['hiddenField' => false, "id" => "ansdef"]); ?>
                    <?= $this->Form->label('ansdef', "Réponses définitives? (pas de modification possible après avoir quité la page ou validé la réponse)"); ?>

                    <!-- only show this input if 'ansdef' checkbox checked -->
                    <?= $this->Form->checkbox("showans", ['hiddenField' => false, "id" => "showans"]); ?>
                    <?= $this->Form->label('showans', "Montrer la réponse après la validation"); ?>
                </li>
            </ul>
        </fieldset>

        <fieldset>
            <legend>Création de la section</legend>

            <ul>
                <li>
                    <?= $this->Form->label('total-grade', "Note totale : ?", ['id' => "total-grade-display"]); ?>
                    <?= $this->Form->text("total-grade", ["id" => "total-grade", "hidden" => true]); ?>
                </li>

                <li><h3>Modules par défaut</h3></li>

                <li>
                    <?= $this->Form->label('section-title', "Titre de la section"); ?>
                    <?= $this->Form->text("section-title", ["id" => "section-title"]); ?>
                </li>

                <li><h3>Modules dynamiques</h3></li>

                <li>
                    <div id="inputs"></div>
                </li>
            </ul>
        </fieldset>

        <?= $this->Form->submit(__('Enregistrer les modifications'), ['id' => "accept-changes"]); ?>
    <?= $this->Form->end() ?>

    <form>
        <fieldset>
            <legend>Aperçu de l'exercice (point de vue d'un élève)</legend>
            <div id="previews"></div>
        </fieldset>
    </form>
</main>

<script>
    //Sets up all the needed data and parameters
    document.getElementById("section-title").value="<?= $exercise['title'] ?>";
    document.getElementById("weight").value="<?= $exercise['coef'] ?>";
    let time ="<?= $exercise['timesec'] ?>";
    document.getElementById("timelimit-hours").value = Math.floor(time / 3600);
    document.getElementById("timelimit-minutes").value = Math.floor((time % 3600) / 60);
    document.getElementById("timelimit-seconds").value = time % 60;

    let triesLimit = "<?= $exercise["tries"] ?>";
    
    document.getElementById("tries").checked = (triesLimit != ''); ;
    document.getElementById("tries-number").value = triesLimit!== null ? triesLimit : '1'; ;
    
    let ansdef = "<?= $exercise["ansdef"] ?>";
    console.log (ansdef);
    document.getElementById("ansdef").checked = (ansdef == 1 ); ;

    let showans = "<?= $exercise["showans"] ?>";
    console.log(showans);
    document.getElementById("showans").checked = (showans == 1 && ansdef == 1);

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