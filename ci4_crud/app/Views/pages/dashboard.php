<?= $this->extend('template/main')?>

<?= $this->section('content') ?>

<section>
    <ul class="list-group">
        <li class="list-group-item">
            <a href="<?= base_url('students')?>">Students</a>
        </li>
        <li class="list-group-item">
            <a href="<?= base_url('userfile')?>">Userfile</a>
        </li>
        <li class="list-group-item">A third item</li>
        <li class="list-group-item">A fourth item</li>
        <li class="list-group-item">And a fifth one</li>
    </ul>
</section>

<?= $this->endSection() ?>