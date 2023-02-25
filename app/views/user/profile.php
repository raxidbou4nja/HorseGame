<?php require APPROOT . '/views/user/incl/user_header.php'; ?>
<title>Profile</title>
</head>
<div class="container">
<?php require APPROOT . '/views/user/incl/user_navbar.php'; ?>
<div class="row mt-3">
    <div class="col-md-6 mx-auto">
        <a href="<?php echo URLROOT.'/users' ?>" class="btn btn-success">GO back</a>
        <div class="card bg-light mt-3">
            <?php flash('account_message'); ?>
            <div class="card-header card-text">
                <h3 class="card-text">Edit <?php echo $data['name']."'s"; ?> Account</h2>
            </div>
            <div class="card-body">
                <form method="post" action="<?php echo URLROOT."/users/profile";?>">
                    <div class="form-group">
                        <label for="name">First Name<sub>*</sub></label>
                        <input type="text" name="name" class="form-control form-control-lg <?php echo (!empty($data['name_err'])) ? 'is-invalid' : '' ;?>" value="<?php echo $data['name'] ;?>">
                        <span class="invalid-feedback"><?php echo $data['name_err'] ;?> </span>
                    </div>
                    <div class="form-group">
                        <label for="email">Email<sub>*</sub></label>
                        <input type="email" name="email" class="form-control form-control-lg <?php echo (!empty($data['email_err'])) ? 'is-invalid' : '' ;?>" value="<?php echo $data['email'] ;?>">
                        <span class="invalid-feedback"><?php echo $data['email_err'] ;?> </span>
                    </div>
                    
                    <div class="form-group">
                        <label for="password">New Password<sub>*</sub></label>
                        <input type="password" name="password" class="form-control form-control-lg <?php echo (!empty($data['password_err'])) ? 'is-invalid' : '' ;?>" value="<?php echo $data['password'] ;?>">
                        <span class="invalid-feedback"><?php echo $data['password_err'] ;?> </span>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col">
                                <input type="submit" class="btn btn-success btn-block pull-left" value="Edit Account">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php require APPROOT . '/views/inc/footer.php'; ?>