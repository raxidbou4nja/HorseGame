<?php require APPROOT . '/views/inc/header.php'; ?>

    <div class="container mx-auto">
        <div class="row">
        <div class="col-md-6">
        <div class="card bg-light mt-5">
            <div class="card-header card-text">
                <?php flash('register_success'); ?>
                <h2 class="card-text">User login</h2>
            <p class="card-text">Please enter your username and password</p>
            </div>
        
            <div class="card-body">
                <form method="post" action="<?php echo URLROOT ;?>/comptes/login">
                    <div class="form-group">
                        <label for="email">Email<sub>*</sub></label>
                        <input type="email" name="email" class="form-control form-control-lg <?php echo (!empty($data['email_err'])) ? 'is-invalid' : '' ;?>" value="<?php echo $data['email'] ;?>">
                        <span class="invalid-feedback"><?php echo $data['email_err'] ;?> </span>
                    </div>
                    
                    <div class="form-group">
                        <label for="password">Password<sub>*</sub></label>
                        <input type="password" name="mot_de_passe" class="form-control form-control-lg <?php echo (!empty($data['mot_de_passe_err'])) ? 'is-invalid' : '' ;?>" value="<?php echo $data['mot_de_passe'] ;?>">
                        <span class="invalid-feedback"><?php echo $data['mot_de_passe_err'] ;?> </span>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col">
                                <input type="submit" class="btn btn-success btn-block pull-left" value="Login">
                            </div>
                            <div class="col">
                                <a href="<?php echo URLROOT ;?>/comptes/register" class="btn btn-light btn-block pull-right">No account? Register </a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        </div>
        <div class="col-md-6">
            <img src="<?php echo URLROOT.'/img/banner.png' ?>" width="100%">
        </div>
    </div>
</div>
<?php require APPROOT . '/views/inc/footer.php'; ?>