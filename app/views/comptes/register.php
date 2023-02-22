<?php require APPROOT . '/views/inc/header.php'; ?>

    <div class="container mx-auto">
        <div class="row"> 
          <div class="col-md-6 card bg-light mt-5">
            <div class="card-header card-text">
                <h2 class="card-text">Create Account</h2>
            <p class="card-text">Please Fill out This form to register with us</p>
            </div>
        
            <div class="card-body">
                <form method="post" action="<?php echo URLROOT ;?>/comptes/register">

                    <div class="form-group">
                        <label for="name">First Name<sub>*</sub></label>
                        <input type="text" name="prenom" class="form-control form-control-lg <?php echo (!empty($data['prenom_err'])) ? 'is-invalid' : '' ;?>" value="<?php echo $data['prenom'] ;?>">
                        <span class="invalid-feedback"><?php echo $data['prenom_err'] ;?> </span>
                    </div>
                    <div class="form-group">
                        <label for="name">First Name<sub>*</sub></label>
                        <input type="text" name="nom" class="form-control form-control-lg <?php echo (!empty($data['nom_err'])) ? 'is-invalid' : '' ;?>" value="<?php echo $data['nom'] ;?>">
                        <span class="invalid-feedback"><?php echo $data['nom_err'] ;?> </span>
                    </div>
                    <div class="form-group">
                        <label for="email">Email<sub>*</sub></label>
                        <input type="email" name="email" class="form-control form-control-lg <?php echo (!empty($data['email_err'])) ? 'is-invalid' : '' ;?>" value="<?php echo $data['email'] ;?>">
                        <span class="invalid-feedback"><?php echo $data['email_err'] ;?> </span>
                    </div>

                    <div class="form-group">
                        <label for="tel">Phone<sub>*</sub></label>
                        <input type="text" name="tel" class="form-control form-control-lg <?php echo (!empty($data['tel_err'])) ? 'is-invalid' : '' ;?>" value="<?php echo $data['tel'] ;?>">
                        <span class="invalid-feedback"><?php echo $data['tel_err'] ;?> </span>
                    </div>
                    
                    <div class="form-group">
                        <label for="password">Password<sub>*</sub></label>
                        <input type="password" name="mot_de_passe" class="form-control form-control-lg <?php echo (!empty($data['mot_de_passe_err'])) ? 'is-invalid' : '' ;?>" value="<?php echo $data['mot_de_passe'] ;?>">
                        <span class="invalid-feedback"><?php echo $data['mot_de_passe_err'] ;?> </span>
                    </div>

                    <div class="form-group">
                        <label for="confirm_mot_de_passe">Confirm Password<sub>*</sub></label>
                        <input type="password" name="confirm_mot_de_passe" class="form-control form-control-lg <?php echo (!empty($data['confirm_mot_de_passe_err'])) ? 'is-invalid' : '' ;?>" value="<?php echo $data['confirm_mot_de_passe'] ;?>">
                        <span class="invalid-feedback"><?php echo $data['confirm_mot_de_passe_err'] ;?> </span>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col">
                                <input type="submit" class="btn btn-success btn-block pull-left" value="Resgister">
                            </div>
                            <div class="col">
                                <a href="<?php echo URLROOT ;?>/users/login" class="btn btn-light btn-block pull-right">Already have account? Login </a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-md-6">
            <img src="<?php echo URLROOT.'/img/banner.png' ?>" width="100%">
        </div>
    </div>
</div>
<?php require APPROOT . '/views/inc/footer.php'; ?>