<?= $this->extend('layouts\main') ?>

<?= $this->section('content') ?>

<div class="container">
    <?php 

    $validation = \Config\Services::validation();

    ?>
    <form action="<?= base_url("/crud/edit_validation")?>" method="post">
        <h2>Edit data</h2>
        <div class="form-group mb-2">
            <label>Name</label>
            <input type="text" name="name" class="form-control" value="<?= $user_data['name'] ?>">
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
            <input type="text" name="email" class="form-control" value="<?=$user_data['email']?>">
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
                <option value="" >Select Gender</option>
                <option value="Male" <?= (($user_data['gender'] == "Male") ? 'selected' : 'none') ?>>Male</option>
                <option value="Female" <?php echo (($user_data['gender'] == "Female") ? 'selected' : 'none') ?>>Female</option>
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
        <input type="hidden" name="id" value="<?= $user_data['id']?>">
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="<?= base_url('/crud') ?>" class="btn btn-secondary">Cancel</a>
    </form>
</div>

<?php 
   
?>
<?= $this->endSection() ?>