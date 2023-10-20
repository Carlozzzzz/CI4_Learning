<?= $this->extend('layouts\main') ?>

<?= $this->section('content') ?>

<div class="container">
    

    <?php

    $session = \Config\Services::session();

    if($session->getFlashdata('success')) :
        echo '
        <div class="alert alert-success">'.$session->getFlashdata("success").'</div>
        ';
    endif;

    ?>
    <div class="container mb-3">
        <div class="row">
            <div class="col">User list</div>
            <div class="col d-flex justify-content-end">
                <a href="<?=base_url('/crud/add')?>" class="btn btn-success btn-sm ms-auto d-inline-block ms-auto">Create</a>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body"> 
            <div class="table-responsive mt-0">
                <table class="table datatable table-striped table-hover small">
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Gender</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                    <?php
                    
                    if($user_data) :
                        foreach($user_data as $user):
                            echo '
                            <tr>
                                <td>'.$user['id'].'</td>
                                <td>'.$user['name'].'</td>
                                <td>'.$user['email'].'</td>
                                <td>'.$user['gender'].'</td>
                                <td>
                                    <a href="
                                        '.base_url().'/crud/fetch_single_data/'.$user['id'].'
                                        " class="btn btn-primary">
                                        Edit
                                    </a>
                                </td>
                                <td><button class="btn btn-danger" onclick="delete_data('.$user['id'].')">Delete</button></td>
        
                            </tr>
                            ';
                        endforeach;
                    endif;
                    
                    ?>
                </table>
            </div>
        </div>
    </div>

</div>

<?= $this->endSection() ?>


