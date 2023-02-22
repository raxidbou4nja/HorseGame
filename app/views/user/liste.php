<?php require APPROOT . '/views/inc/header.php'; ?>
    <?php flash('account_message'); ?>
  <div class="row ">
      <div class="col-md-8">
          <h2>Accounts</h2>
      </div>
      <div class="col-md-4">
          <a class="btn btn-primary pull-right" href="<?php echo URLROOT ;?>/comptes/add"><i class="fa fa-pencil"></i> Add Account</a>
      </div>
  </div>

<table class="table table-bordered">
  <thead>
    <tr>
      <td>ID</td>
      <td>First Name</td>
      <td>Last Name</td>
      <td>Email</td>
      <td>Etat</td>
      <td>Actions</td>
    </tr>
  </thead>
  <tbody>

  <?php foreach ($data['comptes'] as $compte) : ?>
    <tr>
      <td><?php echo $compte->id; ?></td>
      <td><?php echo $compte->prenom; ?></td>
      <td><?php echo $compte->nom; ?></td>
      <td><?php echo $compte->email; ?></td>
      <td><?php echo ($compte->etat == 1)? "Active" : "InActive"; ?></td>
      <td>
          <a href="<?php echo URLROOT."/comptes/edit/". $compte->id ?>" class="btn btn-sm btn-primary">
            <i class="fa fa-edit"></i>
          </a>
          <a href="<?php echo URLROOT."/comptes/deleteCompte/". $compte->id; ?>" class="btn btn-sm btn-danger">
            <i class="fa fa-trash"></i>
          </a>
      </td>
    </tr>
  <?php endforeach ;?>
    
  </tbody>
</table>
<?php require APPROOT . '/views/inc/footer.php'; ?>