<main id="login">
    <?= $this->Form->create()?>
    <fieldset>
        <legend>Connexion</legend>
        <?= $this->Form->control('email') ?>
        <?= $this->Form->control('password', ['label' => 'Mot de passe']) ?>
    </fieldset>
    <?= $this->Form->button(__('Login'), ['class' => 'btn'])?>
    <?= $this->Form->end() ?>
    <div>
        <?= $this->Html->link('Créer compte',['controller'=>'Users', 'action' =>'signup'])?>
    </div>
</main>
