<main id="main-profile">
    <aside>
        <div id="profile">
            <!-- image placeholder A CHANGER -->
            <?= $this->Html->image('profilePic.jpg', ['alt' => 'photo de profil']) ?>
            <div>
                <h2>
                    <?= $this->Identity->get('name') . " " . $this->Identity->get('surname') ?>
                </h2>
                <ul>
                    <li>
                        <p>
                            <strong>Statut : </strong>
                            <?= $this->Identity->get('type') ?? '' ?>
                        </p>
                    </li>
                    <li>
                        <p>
                            <strong>Identifiant : </strong>
                            <?= $this->Identity->get('schoolId') ?? '' ?>
                        </p>
                    </li>
                    <li>
                        <p>
                            <strong>Adresse mail : </strong>
                            <?= $this->Identity->get('email') ?>
                        </p>
                    </li>
                </ul>
            </div>
        </div>

        <div id="profile-details">
            <div>
                <h2>Classes</h2>
                <ul>
                    <?php
                    if (!empty($listClasses)) {
                        foreach ($listClasses as $class) { ?>
                            <li class="btn">
                                <?= $this->Html->link($class->name, ['controller' => 'Classses', 'action' => 'viewClass', $class->id]) ?>
                            </li>
                        <?php }
                    } ?>
                </ul>
                <?= $this->Form->create()?>
                <?= $this->Form->control('code-join-class',['label' => "Rejoindre classe par code d'invitation"]) ?>
                <?= $this->Form->button('Rejoindre') ?>
                <?= $this->Form->end() ?>
            </div>
        </div>

    </aside>

    <div>
        <h2>Tableau de notes</h2>
        <?php
        if (!empty($grades)) { ?>
            <table>
                <?php foreach ($grades as $g) { ?>
                    <tr>
                        <th><?= $g->id ?></th>
                        <td><?= $g->title ?></td>
                        <td><?= $g->grade ?></td>
                        <td><?= $g->created_at ?></td>
                    </tr>
                <?php } ?>
            </table>
            <?php
            echo $this->Html->link("Télécharger notes en .csv", ['controller' => 'Users', 'action' => 'downloadGrades'], ['class' => 'btn']);
        } else {
            echo "<p>Vous n'avez pas encore de notes. Complétez des exercices pour obtenir des notes.</p>";
        }
        ?>
    </div>
    <?= $this->Form->end()?>
    <div <?= $isAdmin ? "" : "style='display: none'" ?>>
        <?= $this->Form->create()?>
        <?= $this->Form->control('id_admin',['type'=>'hidden', 'value'=>$user->id ]) ?>
        <?= $this->Form->control('create-code',['type'=>'hidden', 'value'=>true ]) ?>
        <?= $this->Form->button('Créer code pour professeur', ['class' => 'btn', 'value' => 'create-teacher-code'])?>
        <?= $this->Form->end()?>
        <div <?= empty($codes) ? "hidden" : "" ?>>
            <p>Codes</p>
            <?php
            foreach ($codes as $code) {
                echo '<p>'. $code->code . '</p>';
            }
            ?>
        </div>
    </div>
</main>
