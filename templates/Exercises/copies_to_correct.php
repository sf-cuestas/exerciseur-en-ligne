<?php
if (count($exercises) != 0) {
    foreach ($exercises as $exo) {
        echo $this->Html->link("Copie de l'utilisateur " . $exo['id_user'],
                               ["controller" => "Exercises", 'action' => 'correct', $exo["id_exercise"], $exo["id_user"]]);
    }
} else { ?>
    <p>Il n'y a pas de copies à corriger pour cet exercice.</p>

<?php 
    }
?>