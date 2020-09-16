<?php
// Initialize the session
session_start();

// If session variable is not set it will redirect to login page
if(!isset($_SESSION['admin_username']) || empty($_SESSION['admin_username'])){
  header("location: adminlogin.php");
  exit;
}
include_once "../inc/db.php";
$sql = "SELECT * FROM campaigns;";
$stmt = $pdo->prepare($sql);
if($stmt->execute()) {
    $campaigns = $stmt->fetchAll(PDO::FETCH_OBJ);
  } else {
    echo "Sorry, Some Error Occured Internally.";
}
?>
<?php include_once 'includes/header.php'; ?>
<?php include_once 'includes/sidebar.php'; ?>
  <!--main content start-->
    <section id="main-content">
      <section class="wrapper">
        <div class="row">
          <div class="col-lg-12">
            <h3 class="page-header"><i class="fa fa fa-bars"></i>Campaign Status</h3>
            <div style="clear:both;"></div>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-12">
            <section class="panel">
              <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                      <tr>
                        <th>Title</th>
                        <th>URL</th>
                        <th>Region</th>
                        <th>Target</th>
                        <th>Description</th>
                        <th>Campaign Budget</th>
                        <th>Current Status</th>
                        <th>Update Status</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach ($campaigns as $campaign): ?>
                        <tr>
                          <td><?= $campaign->title; ?></td>
                          <td><a href="<?= $campaign->url;?>"><?= $campaign->url;?></a></td>
                          <td><?= $campaign->region;?></td>
                          <td><?= $campaign->target;?></td>
                          <td><?= $campaign->description;?></td>
                          <td><b>$</b> <?= $campaign->campaign_budget;?></td>
                          <td><?= $campaign->status; ?></td>
                          <td><div class="btn-group-xs"><a href="update_status_pending.php?id=<?= $campaign->id ?>" class="btn btn-warning btn-xs">Set Pending</a> <a href="update_status_disapproved.php?id=<?= $campaign->id ?>" class="btn btn-danger btn-xs">Disapprove</a> <a href="update_status_approved.php?id=<?= $campaign->id ?>" class="btn btn-success btn-xs">Approve</a></div></td>
                        </tr>
                      <?php endForeach; ?> 
                    </tbody>
                </table>
              </div> <!-- table responsive --> 
            </section> <!-- Panel ends --> 
          </div>
      </div>
    </section> <!--Main Content ends -->
  </section>
<?php include_once 'includes/footer.php'; ?>