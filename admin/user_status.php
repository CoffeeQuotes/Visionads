<?php 
// Initialize the session
session_start();

// If session variable is not set it will redirect to login page
if(!isset($_SESSION['admin_username']) || empty($_SESSION['admin_username'])){
  header("location: adminlogin.php");
  exit;
}
include_once "../inc/db.php";
$sql = 'SELECT * FROM users;';
$stmt = $pdo->prepare($sql);
if($stmt->execute()) {
	$users = $stmt->fetchAll(PDO::FETCH_OBJ);
} else {
	echo "Sorry, Some error occurred internally.";
} 
?>
<?php include_once 'includes/header.php'; ?>
<?php include_once 'includes/sidebar.php'; ?>
<!--main content start-->
    <section id="main-content">
      <section class="wrapper">
        <div class="row">
          <div class="col-lg-12">
            <h3 class="page-header"><i class="fa fa fa-bars"></i>Users Status</h3>
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
                        <th>Username</th>
                        <th>Email</th>
                        <th>Created At</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach ($users as $user): ?>
                        <tr>
                          <td><?= $user->username; ?></td>
                          <td><?= $user->email;?></td>
                          <td><?= $user->created_at;?></td>
                          <td><a href="delete_user.php?id=<?= $user->id ?>" onclick="return confirm('Are you sure you want to delete this user?')" class="btn btn-danger btn-sm">Delete</a></td>
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