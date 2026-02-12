<main id="main-profile">
    <aside>
        <div id="profile">
            <!-- image placeholder A CHANGER -->
            <?= $this->Html->image('profile-pic.jpg', ['alt' => 'photo de profil']) ?>
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
                                <?= $this->Html->link($class->name, ['controller' => 'Classes', 'action' => 'view', $class->id]) ?>
                            </li>
                        <?php }
                    } ?>
                </ul>
                <form action="" method="post">
                    <label>
                        Rejoindre classe par code d'invitation
                        <input type="text" name="code-class-add">
                    </label>
                    <input type="submit" value="Rejoindre">
                </form>
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
</main>
