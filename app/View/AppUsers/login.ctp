<div class="users form">
<?php echo $this->Session->flash('auth');?>
<?= $this->Form->create('Users.User', [
    'inputDefaults' => [
        'div' => 'form-group',
        'wrapInput' => false,
        'class' => 'form-control',
    ],
    'class' => 'well']) ?>
    <?= $this->Form->input('email', ['label'=>'Eメール']) ?>
    <?= $this->Form->input('password', ['label'=>'パスワード']) ?>
    <?= $this->Form->submit('ログイン', ['class'=>'btn btn-default']) ?>
<?= $this->Form->end() ?>
</div>
