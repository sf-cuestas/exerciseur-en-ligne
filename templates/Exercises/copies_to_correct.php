<?php
foreach ($exercises as $exo) {
    echo $this->Html->link("John", ["controller" => "Exercises", 'action' => 'correct', $exo["id_exercise"], $exo["id_user"]]);
}
?>