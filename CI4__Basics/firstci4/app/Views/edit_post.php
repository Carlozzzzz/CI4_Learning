<?= $this->extend('layouts\main') ?>

<?= $this->section('content') ?>

<h2><?=$title?></h2>

<div class="row">

    

    <div class="class-12 col-md-8 offset-md-2">
        <div class="row">
            <form method="post">
                <div class="form-group mb-2">
                    <label for="">Title</label>
                    <input name="post_title" type="text" class="form-control" value="<?= $post['post_title'] ?>">
                </div>
                <div class="form-group mb-2">
                    <label for="">Content</label>
                    <textarea name="post_content" id="post_content" class="form-control" cols="30" rows="10"><?= $post['post_content']?></textarea>
                </div>
                <div class="form-group mb-2">
                    <button class="btn btn-success">Update</button>
                </div>

            </form>
        </div>
    </div>
    
</div>

<?= $this->endSection() ?>


