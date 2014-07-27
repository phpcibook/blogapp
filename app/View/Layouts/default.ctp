<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>継続的インテグレーション開発サンプル:<?= $title_for_layout ?></title>
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
    <?php
        echo $this->fetch('meta');
        echo $this->fetch('css');
        echo $this->fetch('script');
    ?>
</head>
<body>
    <div class="container">
        <header class="page-header">
            <h1><?= $this->Html->link('継続的インテグレーション開発サンプル', ['action' => 'index']) ?></h1>
        </header>
        <article>
            <header>
                <?= $this->Session->flash() ?>
            </header>
            <?= $this->fetch('content') ?>
        </article>
        <footer></footer>
    </div>
    <div class="panel panel-default">
        <?= $this->element('sql_dump') ?>
    </div>
</body>
</html>
