<main id="modif-selection">
    <ul>   
        <li><h3><?= $chapterName ?></h3></li>
                
        <?php
            $i = 1;
            foreach($listExercises as $ex) {
                echo "<li>" . $this->Html->link("Exercice " . $i . " : " . $ex['title'],
                                                ['controller' => 'Exercises', 'action' => 'practice', $ex['id']],
                                                ['escape' => false, 'class' => 'btn']) . "</li>";
                $i++;
            }
            
        ?>
    </ul>

    <?php
    if (isset($classId)) {
        echo $this->Html->link('Retour', ['controller' => 'Classses', 'action' => 'view-class', $classId],['escape'=>false,'class'=>'btn']);
    } else {
        echo $this->Html->link('Retour', ['controller' => 'Pages', 'action' => 'Index'],['escape'=>false,'class'=>'btn']);
    }
        
        
        ?>  
</main>