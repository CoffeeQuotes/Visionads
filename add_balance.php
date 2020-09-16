<?php
// Initialize the session
session_start();

// If session variable is not set it will redirect to login page
if(!isset($_SESSION['username']) || empty($_SESSION['username'])){
  header("location: login.php");
  exit;
}
  $balance = "";
  $user_id = $_SESSION['user_id'];
  require_once "inc/db.php";
  $sql = "SELECT amount FROM wallets WHERE user_id = :user_id";
  if ($stmt = $pdo->prepare($sql)) {
      $stmt->bindParam(':user_id', $param_user_id, PDO::PARAM_INT);
      $param_user_id = $user_id;
      if ($stmt->execute()) {
          $num_rows = $stmt->rowCount();
          if ($num_rows < 0) {
              $balance = 0;
              unset($stmt);
              unset($pdo);
          } else {
              $result = $stmt->fetchObject();
              $balance = $result->amount;
          }
          unset($stmt);
          unset($pdo);
      } else {
          echo "Failed to load.";
      }
  }
  $page_title = "Add money in wallet";
?>
<?php include_once "inc/header.php"; ?>
<?php include_once "inc/nav.php"; ?>
<!-- <div class="col-lg-12 p-r-0 title-margin-right"> -->

<!-- </div> -->
<section id="main-content">
  <div class="page-header">
        <div class="page-title">
            <h1>Hi, <b><?php echo htmlspecialchars($_SESSION['username']); ?></b>. You can check and add Balance here.</h1>
        </div>
  </div>
  <div class="clearfix"></div>
  <div class="row">
    <div class="col-lg-6">
      <div class="card">
        <div class="card-title text-center mb-4">Add Money</div>
        <div class="card-body">
            <form action="processing_payment.php" method="post">
              <div class="form-group">
                <div class="input-group input-group-rounded">
                  <input type="text" name="amount" placeholder="amount" class="form-control">
                <span class="input-group-btn">
                  <button type="submit" class="btn btn-primary btn-group-right"><i class="ti-money"></i> Pay </button>
                </span>
                </div>
              </div>
            </form>
        </div>
      </div>
    </div>
    <div class="col-lg-6">
      <div class="card">
        <div class="card-title">Your Current Balance is</div>
          <div class="card-body text-center"><h1><span class="currency">$ </span><?php echo $balance; ?></h1></div>
      </div>
    </div>
  </div>
</section>
<?php include_once "inc/footer.php"; ?>
