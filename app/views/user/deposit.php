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
                <h3 class="card-text text-center">Deposit Credits</h2>
            </div>
            <div class="card-body">
                <form method="post" action="<?php echo URLROOT."/users/deposit";?>">
                    <div class="form-group">
                        <div class="text-center h1">
                            <div class="h3">20 Level => 100$</div>
                             <i class="fa fa-credit-card"></i>
                        </div>
                        <div class="row">
                            <div class="col">
                                <input type="submit" class="btn btn-success btn-block pull-left" value="Add Money">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php require APPROOT . '/views/user/incl/user_footer.php'; ?>
</body>
</html>