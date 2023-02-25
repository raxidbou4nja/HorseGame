<?php require APPROOT . '/views/inc/header.php'; ?>
    <div class="container" style="margin-top: 96px;">
        <div class="row">
            <div class="col-md-6">
                <div class="infos font-italic p-3">More than a technological <br>platform</div>
                <img src="<?php echo URLROOT.'/img/index1.png';?>" width="100%">
            </div>
            <div class="col-md-6">
            <form action="<?php echo URLROOT ;?>/users/register" method="post" class="col-md-9">
                <div class="h2 text-center text-bold p-2 font-weight-bold">
                    Sign Up
                </div>
                <div class="form-group">
                        <label for="email">Email Address<sup>*</sub></label>
                        <input type="text" name="email" class="form-control <?php echo (!empty($data['email_err'])) ? 'is-invalid' : '' ;?>" value="<?php echo $data['email'] ;?>" placeholder="Your Email">
                        <span class="invalid-feedback"><?php echo $data['email_err'] ;?> </span>
                    </div>
                <div class="form-group">
                        <label for="name">Name<sup>*</sub></label>
                        <input type="text" name="name" class="form-control <?php echo (!empty($data['name_err'])) ? 'is-invalid' : '' ;?>" value="<?php echo $data['name'] ;?>" placeholder="Your Name">
                        <span class="invalid-feedback"><?php echo $data['name_err'] ;?> </span>
                    </div>
                <div class="form-group">
                        <label for="password">Password<sup>*</sub></label>
                        <input type="password" name="password" class="form-control <?php echo (!empty($data['password_err'])) ? 'is-invalid' : '' ;?>" value="<?php echo $data['password'] ;?>" placeholder="Your Password">
                        <span class="invalid-feedback"><?php echo $data['password_err'] ;?> </span>
                    </div>
                <div class="form-group">
                        <label for="confirm-password">Confirm Password<sup>*</sup></label>
                        <input type="password" name="confirm_password" class="form-control <?php echo (!empty($data['confirm_password_err'])) ? 'is-invalid' : '' ;?>" value="<?php echo $data['confirm_password'] ;?>" placeholder="Confirm Your Password">
                        <span class="invalid-feedback"><?php echo $data['confirm_password_err'] ;?> </span>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" name="check_terms" value="1">
                      <label for="check_terms">have read and agree to the <a href="#">Terms of Use</a> and <a href="#">Privacy Policy</a>.</label>                        
                      <small class="text-danger"><?php echo $data['terms_err'] ;?> </small>
                  </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-bronze col-12" class="register-user-btn">Register</button>
                    <div class="text-right p-2 font-italic">
                        Already Have Account <a href="<?php echo URLROOT.'/users/login' ?>" class="font-weight-bold">Log-In</a>
                    </div>
                </div>
            </form>
            </div>
        </div>
    </div>
<?php require APPROOT . '/views/inc/footer.php'; ?>