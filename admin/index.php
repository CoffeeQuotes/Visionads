<?php
// Initialize the session
session_start();

// If session variable is not set it will redirect to login page
if(!isset($_SESSION['admin_username']) || empty($_SESSION['admin_username'])){
  header("location: adminlogin.php");
  exit;
}
?>
<?php include_once 'includes/header.php'; ?>
<?php include_once 'includes/sidebar.php'; ?>
<?php include_once 'data.php'; ?>
<section id="main-content">
<section class="wrapper">
<div class="row">
          <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
            <div class="info-box blue-bg">
              <i class="fa fa-cubes"></i>
              <div class="count"><?= $total_campaigns; ?></div>
              <div class="title">Campaigns</div>
            </div>
            <!--/.info-box-->
          </div>
          <!--/.col-->

          <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
            <div class="info-box brown-bg">
              <i class="fa fa-paper-plane"></i>
              <div class="count"><?= $total_active_campaigns; ?></div>
              <div class="title">Active Campaigns</div>
            </div>
            <!--/.info-box-->
          </div>
          <!--/.col-->

          <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
            <div class="info-box dark-bg">
              <i class="fa fa-user"></i>
              <div class="count"><?= $total_users; ?></div>
              <div class="title">Users</div>
            </div>
            <!--/.info-box-->
          </div>
          <!--/.col-->

          <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
            <div class="info-box green-bg">
              <i class="fa fa-money"></i>
              <div class="count"><b>$</b> <?= $total_amount_in_wallet; ?></div>
              <div class="title">Total Money</div>
            </div>
            <!--/.info-box-->
          </div>
          <!--/.col-->        
      </div>
</section>      
<?php include_once 'includes/footer.php'; ?>