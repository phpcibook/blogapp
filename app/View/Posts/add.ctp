<h2>新規記事登録</h2>
<div class="posts form">
<?= $this->Form->create('Post', [
    'inputDefaults' => [
        'div' => 'form-group',
        'wrapInput' => false,
        'class' => 'form-control',
    ],
    'class' => 'well']) ?>
    <?= $this->Form->input('title', ['label'=>'タイトル']) ?>
    <?= $this->Form->input('body', ['label'=>'本文']) ?>
    <?= $this->Form->submit('投稿', ['class'=>'btn btn-default']) ?>
<?= $this->Form->end() ?>
</div>
