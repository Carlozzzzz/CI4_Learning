<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">

    <title>Document</title>
</head>
<body>
    
    <div class="container mt-3">
        <div class="row">
            <div class="col-md-4 offset-4">
                <h4>Sign in</h4>
                <hr>
                <?php 
                
                if(!empty(session()->getFlashData('success'))) : 
                    echo '
                        <div class="alert alert-success">
                            '.session()->getFlashdata('success').'
                        </div>
                    ';
                elseif(!empty(session()->getFlashData('fail'))): 
                    echo '
                    <div class="alert alert-danger">
                        '.session()->getFlashdata('fail').'
                    </div>
                ';
                endif; 
                
                ?>
                <form action="<?= base_url('/auth/loginUser')?>" method="post" class="form mb-3">
                    <?= csrf_field(); ?>
                    <div class="form-group mb-3">
                        <label class="form-label">Email address</label>
                        <input  type="text" 
                                class="form-control" 
                                name="email"
                                value="<?= set_value('email')?>"
                                id="emailInput"
                                placeholder="Email here" >
                                <span class="text-danger text-sm">
                                    <?= isset($validation) ? display_form_errors($validation, 'email'): '' ?>
                                </span>
                    </div>
                    <div class="form-group mb-3">
                        <label class="form-label">Password</label>
                        <input  type="password" 
                                class="form-control" 
                                name="password"
                                value="<?= set_value('password')?>"
                                id="passwordInput"
                                placeholder="Email here" >
                                <span class="text-danger text-sm">
                                    <?= isset($validation) ? display_form_errors($validation, 'password'): '' ?>
                                </span>
                    </div>
                    <div class="form-group mb-5">
                        <a href="<?= site_url('/auth/register');?>">Create an account</a>
                    </div>
                    <div class="form-group mb-3 text-center">
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <a href="<?= base_url() ?>" class="btn btn-secondary">Cancel</a>
                    </div>
                    
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js" integrity="sha384-mQ93GR66B00ZXjt0YO5KlohRA5SY2XofN4zfuZxLkoj1gXtW8ANNCe9d5Y3eG5eD" crossorigin="anonymous"></script>
</body>
</html>