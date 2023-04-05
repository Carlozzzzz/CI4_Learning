<?= $this->extend('template/main')?>

<?= $this->section('content') ?>

<?php
    $session = \Config\Services::session();

    if ($session->getFlashData('success')) :
        echo '
            <div class="alert alert-success">
                ' . $session->getFlashData('success') . '
            </div>
        ';
    endif;
    
?>

<div class="card">
    <div class="card-header">
        <h2 class="card-title"><?= isset($title) ? $title : "Hellow World"?> <a href="<?= base_url('studentfile/addnew') ?>" class="btn btn-primary float-end">Add student</a></h2>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col">
                <div class="table-responsive">
                    <table class="table datatable table-striped table-hover small">
                        <thead>
                            <tr>
                                <th scope="col">Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">Mobile Number</th>
                                <th scope="col">Image</th>
                                <th scope="col">Status</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($students as $student) :?>
                                <tr>
                                    <td><?= $student['name']?></td>
                                    <td><?= $student['email']?></td>
                                    <td><?= $student['phone']?></td>
                                    <td><?= $student['studentimage']?></td>
                                    <td><?= $student['status']?></td>
                                    <td>
                                        <a href="<?= base_url('studentfile/edit/'.$student['recid']) ?>" class="btn btn-primary">Edit</a>
                                        <a href="<?= base_url('studentfile/delete/'.$student['recid']) ?>" class="btn btn-danger">Delete</a>
                                    </td>
                                </tr>
                            <?php endforeach;?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>