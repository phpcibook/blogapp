<nav class="navbar">
    <div class="collapse navbar-collapse">
        <p class="navbar-text navbar-right">
            <?= $this->Html->link('新規投稿', ['action' => 'add'], ['class'=>'btn btn-default']) ?>
        </p>
    </div>
</nav>
<?php foreach ($posts as $post): ?>
    <section>
        <h1><?= h($post['Post']['title']) ?></h1>
        <?= h($post['Post']['body']) ?>
        <p class="actions">
            <?= $this->Html->link('記事の編集', ['action' => 'edit', $post['Post']['id']], ['class'=>'btn btn-success']) ?>
            <?= $this->Form->postLink('記事の削除', ['action' => 'delete', $post['Post']['id']], null, __('記事「%s」を削除してもよろしいですか?', $post['Post']['title'])) ?>
        </p>
    </section>
<?php endforeach; ?>
<ul class="pagination">
    <?php
        echo $this->Paginator->prev('&laquo;', ['escape'=>false, 'tag'=>'li', 'url'=>['controller'=>'posts', 'action'=>'index','user_account'=>$this->request->user_account]], null, 
            ['class' => 'prev disabled', 'escape'=>false, 'tag'=>'li', 'disabledTag'=>'a']);
        echo $this->Paginator->numbers(['separator' => '', 'tag'=>'li', 'currentTag'=>'a', 'currentClass'=>'active', 'url'=>['controller'=>'posts', 'action'=>'index','user_account'=>$this->request->user_account]]);
        echo $this->Paginator->next('&raquo;', ['escape'=>false, 'tag'=>'li', 'url'=>['controller'=>'posts', 'action'=>'index','user_account'=>$this->request->user_account]], null, 
            ['class' => 'next disabled', 'escape'=>false, 'tag'=>'li', 'disabledTag'=>'a']);
    ?>
</ul>
