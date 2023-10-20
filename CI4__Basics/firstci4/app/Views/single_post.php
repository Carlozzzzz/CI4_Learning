<?= $this->extend('layouts\main')?>

<?= $this->section('content')?>

<h2><?=$title?></h2>
<p class="text-muted"><?=$content?></p>

<?php if($post != 0) :?>
    <a href="/blog/edit/<?= $post['post_id'] ?>" class="btn btn-primary">edit</a>
    <a href="/blog/delete/<?= $post['post_id'] ?>" class="btn btn-danger">Delete</a>
<?php endif ;?>

<?= $this->endSection()?>

