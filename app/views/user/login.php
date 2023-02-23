<?php require APPROOT . '/views/inc/header.php'; ?>
    <div class="container">
    	<div class="row">
    		<div class="col-md-6">
    			<div class="infos font-italic p-3">More than a technological <br>platform</div>
    			<img src="img/index1.png" width="100%">
    		</div>
    		<div class="col-md-6">
            <form action="<?php echo URLROOT ;?>/user/login" method="post">
                <div class="form-group">
                        <label for="name">Email Address<sub>*</sub></label>
                        <input type="text" name="email" class="form-control <?php echo (!empty($data['email_err'])) ? 'is-invalid' : '' ;?>" value="<?php echo $data['email'] ;?>" placeholder="Your Email">
                        <span class="invalid-feedback"><?php echo $data['email_err'] ;?> </span>
                    </div>
                <div class="form-group">
                        <label for="name">Name<sub>*</sub></label>
                        <input type="text" name="name" class="form-control <?php echo (!empty($data['name_err'])) ? 'is-invalid' : '' ;?>" value="<?php echo $data['name'] ;?>" placeholder="Your Name">
                        <span class="invalid-feedback"><?php echo $data['name_err'] ;?> </span>
                    </div>
                <div class="form-group">
                        <label for="name">Password<sub>*</sub></label>
                        <input type="password" name="password" class="form-control <?php echo (!empty($data['email_err'])) ? 'is-invalid' : '' ;?>" value="<?php echo $data['email'] ;?>" placeholder="Your Password">
                        <span class="invalid-feedback"><?php echo $data['email_err'] ;?> </span>
                    </div>
                <div class="form-group">
                        <label for="name">Confirm Password <sup class="text-danger">*</sup></label>
                        <input type="password" name="confirm_password" class="form-control <?php echo (!empty($data['password_err'])) ? 'is-invalid' : '' ;?>" value="<?php echo $data['password'] ;?>" placeholder="Confirm Your Password">
                        <span class="invalid-feedback"><?php echo $data['password_err'] ;?> </span>
                    </div>
            </form>

    		</div>
    	</div>
    </div>
<?php require APPROOT . '/views/inc/footer.php'; ?>