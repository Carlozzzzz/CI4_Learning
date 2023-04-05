<?= $this->extend('template/main.php') ?>

<?= $this->section('content') ?>

<?php $validation = \Config\Services::validation() ?>

<div class="card">
    <div class="card-header">
        <h2 class="card-title"><?= isset($title) ? $title : "Hellow World"?></h2>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col">
                
                <form action="<?= base_url('studentfile/submitupdate') ?>" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="idno" value="<?= $data_recordfile['id']?>">
                    <div class="mb-3">
                        <label for="txtname" class="form-label">Name</label>
                        <input type="text" name="name" id="txtname"
                            class="form-control form-control-sm txtname"
                            value="<?= isset($data_recordfile['name']) ? $data_recordfile['name'] : "" ?>">
                        <div class="alert alert-danger <?= $validation->getError('name') ? $validation->getError('name') : 'd-none' ?>"><?= $validation->getError('name') ?></div>
                        
                    </div>
                    <div class="mb-3">
                        <label for="txtemail" class="form-label">Email</label>
                        <input type="text" name="email" id="txtemail"
                            class="form-control txtemail"
                            value="<?= isset($data_recordfile['email']) ? $data_recordfile['email'] : "" ?>">
                        <div class="alert alert-danger <?= $validation->getError('email') ? $validation->getError('email') : 'd-none' ?>"><?= $validation->getError('email') ?></div>

                    </div>
                    <div class="mb-3">
                        <label for="txtemail" class="form-label">Mobile Number</label>
                        <input type="text" name="phone" id="exampleInputPassword1"
                            class="form-control txtmobilenumber"
                            value="<?= isset($data_recordfile['phone']) ? $data_recordfile['phone'] : "" ?>">
                        <div class="alert alert-danger <?= $validation->getError('phone') ? $validation->getError('phone') : 'd-none' ?>"><?= $validation->getError('phone') ?></div>

                    </div>
                    <div class="mb-3">
                        <label for="txtemail" class="form-label">Image</label>
                        <input type="file" name="studentimage" id="exampleInputPassword1"
                            class="form-control txtmobilenumber">
                        <div class="alert alert-danger <?= $validation->getError('studentimage') ? $validation->getError('studentimage') : 'd-none' ?>"><?= $validation->getError('studentimage') ?></div>

                    </div>
                    <div class="mb-3 form-check">
                        <input type="checkbox" name="status" id="txtstatus"
                            class="txtstatus"
                            <?= isset($data_recordfile['status']) && $data_recordfile['status'] == "1" ? "checked" : ""; ?>>
                        <label class="form-check-label" for="txtstatus">Status</label>
                    </div>
                    <div class="form-group text-center">
                        <button type="submit" class="btn btn-primary ">Submit</button>
                        <a href="<?= base_url('students') ?>" class="btn btn-secondary ">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>