<?php require APPROOT . '/views/inc/header.php'; ?>
    <div class="container bg-white" style="margin-top: 96px;">
        <div class="row">
            <div class="col-md-6">
                <div class="infos font-italic p-3">More than a technological <br>platform</div>
                <img src="<?php echo URLROOT.'/img/index1.png';?>" width="100%">
            </div>
            <div class="col-md-6">
            <form action="<?php echo URLROOT ;?>/users/login" method="post" class="col-md-9">
                <div class="h2 text-center text-bold font-italic p-2 font-weight-bold">
                    Sign In
                </div>
                <div><?php echo flash("account_message") ?></div>
                <div class="form-group">
                        <label for="email">Email Address<sup>*</sub></label>
                        <input type="text" name="email" class="form-control <?php echo (!empty($data['email_err'])) ? 'is-invalid' : '' ;?>" value="<?php echo $data['email'] ;?>" placeholder="Your Email">
                        <span class="invalid-feedback"><?php echo $data['email_err'] ;?> </span>
                    </div>
                <div class="form-group">
                        <label for="password">Password<sup>*</sub></label>
                        <input type="password" name="password" class="form-control <?php echo (!empty($data['password_err'])) ? 'is-invalid' : '' ;?>" value="<?php echo $data['password'] ;?>" placeholder="Your Password">
                        <span class="invalid-feedback"><?php echo $data['password_err'] ;?> </span>
                    </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-bronze col-12" class="Login-user-btn">Login</button>
                    <div class="text-right p-2 font-italic">
                        I Don't Have Account <a href="<?php echo URLROOT.'/users/register' ?>" class="font-weight-bold">Create Account</a>
                    </div>
                </div>
            </form>
            </div>
        </div>
    </div>
<?php require APPROOT . '/views/inc/footer.php'; ?>