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
                
                    <button type="button" id="add-text">Ajouter un champ de texte</button>
                    <!-- show buttons if the span is clicked (and change image)-->
                    <input type="checkbox" id="dropdown" hidden/>
                    <label for="dropdown">Titres <img src="/img/arrowDown.svg" alt="arrow" width="5px" height="5px"></label>
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
                
            </aside>
        </div>
    </div>
    <?= $this->Form->create(null, ['id' => 'dynamic-form','type' => 'post','url' => ['controller' => 'Exercises', 'action' => 'add', $idChapter]]) ?>

        <fieldset>
            <legend>Paramètres de la section</legend>   

            <ul>   
                <li><h3>Options de notation</h3></li>
                <li>
                    <span> 
                        <?= $this->Form->label('weight', 'Coefficient (nécéssaire même si non noté, pour les statistiques) : ') ?>
                        <?= $this->Form->number('weight', ['id' => 'weight', 'min' => 0, 'max' => 999, 'step' => 1, 'value' => 0]) ?>
                    </span>
                </li>

                <li><h3>Options de temps</h3></li>

                <li>
                    <span> 
                        <?= $this->Form->label('timelimit-hours','Heures') ?>
                        <?= $this->Form->number('timelimit_hours', ['id' => 'timelimit-hours', 'min' => 0, 'max' => 16, 'step' => 1, 'value' => 0]) ?>
                        <?= $this->Form->label('timelimit-minutes','Minutes') ?>
                        <?= $this->Form->number('timelimit_minutes', ['id' => 'timelimit-minutes', 'min' => 0, 'max' => 59, 'step' => 1, 'value' => 0]) ?>
                        <?= $this->Form->label('timelimit-seconds','Secondes') ?>
                        <?= $this->Form->number('timelimit_seconds', ['id' => 'timelimit-seconds', 'min' => 0, 'max' => 59, 'step' => 1, 'value' => 0]) ?>
                    </span>
                </li>

                <li><h3>Options d'essais</h3></li>

                <li> 
                    <?= $this->Form->label('tries', 'Limiter le nombre d\'essais ?') ?>
                    <?= $this->Form->checkbox('tries', ['id' => 'tries']) ?>
                    <span> <!-- only show this span if 'tries' checkbox checked -->
                        <?= $this->Form->label('tries_number', 'Nombre d\'essais autorisés:') ?>
                        <?= $this->Form->number('tries_number', ['id' => 'tries-number', 'min' => 1, 'max' => 100, 'step' => 1, 'value' => 1]) ?>
                    </span>
                        
            
                </li>

                <li><h3>Options de réponses</h3></li>

                <li> 
                    <?= $this->Form->checkbox('ansdef', ['id' => 'ansdef']) ?>
                    <?= $this->Form->label('ansdef', 'Réponses définitives? (pas de modification possible après avoir quitté la page ou validé la réponse)') ?>
                        <!-- only show this input if 'ansdef' checkbox checked -->
                    <?= $this->Form->checkbox('showans', ['id' => 'showans']) ?>
                    <?= $this->Form->label('showans', 'Montrer la réponse après la validation?') ?>
                </li>
                    

                
            
            </ul>

        </fieldset>

        <fieldset>
            <legend>Création de l'exercice'</legend>

            
            <ul>
                <li>
                    <?= $this->Form->label('total-grade', 'Note totale : ?', ['id' => 'total-grade-display']) ?>
                    <?= $this->Form->text('total-grade', ['id' => 'total-grade', 'hidden' => true]) ?>
                    
                </li>

                <li><h3>Modules par défaut</h3></li>
                <li>
                    <?= $this->Form->label('section-title', 'Titre de l\'exercice') ?>
                    <?= $this->Form->text('section-title', ['id' => 'section-title']) ?>
                </li>

                <li><h3>Modules dynamiques</h3></li>
                
                <li>
                    <div id="inputs"></div>
                </li>
                <li>   
                    <?= $this->Form->label('localStorageKeep', 'Garder les modules actuels pour l\'exercice suivant?') ?>
                    <?= $this->Form->checkbox('localStorageKeep', ['id' => 'localStorageKeep']) ?>
                </li>
            </ul>   
            
        </fieldset>
        <?= $this->Form->button('Enregistrer la section et continuer', ['id' => 'save-section','value' => 'continue']) ?>
        <?= $this->Form->button('Enregistrer la section et terminer le chapitre', ['id'=>'save-section-end','name' => 'save-section-end', 'value' => 'finish']) ?>
        </form>
    <form>
        <fieldset>
            <legend>Aperçu de l'exercice (point de vue d'un élève)</legend>
            <div id="previews"></div>
        </fieldset>
    </form>
</main>
<?php 
    if(isset($resetLocalStorage) && $resetLocalStorage) {
        echo'<script>try{localStorage.removeItem("dynamicModules"); }catch(e){}</script>'; 
    }
?>