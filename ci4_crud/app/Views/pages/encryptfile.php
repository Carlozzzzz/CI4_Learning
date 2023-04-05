<?= $this->extend('template/main') ?>

<?= $this->section('content')?>

<h3>This is encryptfile</h3>
<br>

<a href="<?= base_url();?>encryptfile/encryptstring" class="btn btn-success">Encode</a>
<a href="<?= base_url();?>encryptfile/decodestring/<?= isset($data_encrypt) ? $data_encrypt : ""?>" class="btn btn-primary">Decode</a>

<p>Data: <?= isset($data_encrypt) ? $data_encrypt : "No data to show."?></p>

<?= $this->endSection(); ?>