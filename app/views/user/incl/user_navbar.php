  <input type="checkbox" class="openSidebarMenu" id="openSidebarMenu">
  <label for="openSidebarMenu" class="sidebarIconToggle">
    <div class="spinner diagonal part-1"></div>
    <div class="spinner horizontal"></div>
    <div class="spinner diagonal part-2"></div>
</label>
<div id="sidebarMenu">
    <ul class="sidebarMenuInner">
      <li style="margin-left: 76px; font-size: 40px">GAMES</li>
      <li><a href="<?php echo URLROOT; ?>/users"><i class="fa fa-gamepad fa-2x"></i> Games List</a></li>
      <li><a href="<?php echo URLROOT; ?>/users/profile"><i class="fa fa-user fa-2x"></i> Profile</a></li>
      <li><a href="<?php echo URLROOT; ?>/users/deposit"><i class="fa fa-dollar fa-2x"></i> Deposit</a></li>    
  </ul>
</div>
<nav class="navbar shadow profile-navbar row">
    <div class="col-md-12 row" style="height: fit-content; line-height: 44px;">
        <div class="col-md-3 p-3">
           <div class="profile-output d-flex">
              <img src="https://ui-avatars.com/api/?name=<?php echo substr($_SESSION['name'],0,1); ?>" alt="<?php echo $_SESSION['name']; ?>'s Profile" width="40px" class="profile-img mr-2">
              <div><?php echo $_SESSION['name']; ?></div>
          </div>
      </div>
      <div class="col-md-3 d-flex p-3">
       Your level:
       <div class="data-output">
          <?php echo $data['info']->level; ?>
      </div>
    </div>
    <div class="col-md-3  d-flex p-3">
       Your Credits:
       <div class="data-output">
          $<?php echo $data['info']->score; ?>.00
      </div>
    </div>
    <div class="col-md-3 text-center p-3">
       <i class="fa fa-sign-out"></i>
       <a href="<?php echo URLROOT.'/users/log_out' ?>" class="text-dark">Log Out</a>
    </div>
    </div>
</nav>