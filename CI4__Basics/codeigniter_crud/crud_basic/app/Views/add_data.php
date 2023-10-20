<?= $this->extend('layouts\main') ?>

<?= $this->section('content') ?>

<div class="container">
    <?php 

    $validation = \Config\Services::validation();

    ?>
    <form action="<?= base_url('/crud/add_validation')?>" method="post">
        <div class="form-group mb-2">
            <label>Name</label>
            <input type="text" name="name" class="form-control">
            <?php 
                if($validation->getError('name')): 
                    echo '
                        <div class="alert alert-danger">
                            '.$validation->getError('name').'
                        </div>
                    ';
                endif;
            ?>
        </div>
        <div class="form-group mb-2">
            <label>Email</label>
            <input type="text" name="email" class="form-control">
            <?php 
                if($validation->getError('email')): 
                    echo '
                        <div class="alert alert-danger">
                            '.$validation->getError('email').'
                        </div>
                    ';
                endif;
            ?>
        </div>
        <div class="form-group mb-2">
            <label>Gender</label>
            <select name="gender" class="form-select">
                <option value="">Select Gender</option>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
            </select>
            <?php 
                if($validation->getError('gender')): 
                    echo '
                        <div class="alert alert-danger">
                            '.$validation->getError('gender').'
                        </div>
                    ';
                endif;
            ?>
        </div>
        <button type="submit" class="btn btn-primary">Add</button>
        <a href="<?= base_url('/crud') ?>" class="btn btn-secondary">Cancel</a>

    </form>
</div>

<?= $this->endSection() ?>