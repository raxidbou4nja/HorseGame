<?php require APPROOT . '/views/inc/header.php'; ?>
    <div class="container" >
    	<div class="row" style="margin-top: 96px;">
    		<div class="col-md-6">
    			<div class="infos font-italic p-3">More than a technological <br>platform</div>
    			<img src="<?php echo URLROOT; ?>/img/index1.png" width="100%">
    		</div>
    		<div class="col-md-6 text-center">
    			<div class="">
    				<img src="<?php echo URLROOT; ?>/img/index2.png" width="100%">
    			</div>
    			<div class="font-italic mt-2">
    				<a href="<?php echo URLROOT; ?>/users/register" class="btn btn-font-bronze m-2">
                        <i class="fa fa-user-plus"></i>
                        Register
                    </a>
    				<a href="<?php echo URLROOT; ?>/users/login" class="btn btn-font-bronze m-2">
                        <i class="fa fa-user"></i>
                        Login
                     </a>
                    <a href="<?php echo URLROOT; ?>/pages/how_to_play" class="btn btn-font-bronze m-2">
                        <i class="fa fa-gamepad"></i>
                        How To Play
                     </a>
                </div>
    		</div>
    	</div>
    </div>
<?php require APPROOT . '/views/inc/footer.php'; ?>
