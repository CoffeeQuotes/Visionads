<?php
// Initialize the session
session_start();

// If session variable is not set it will redirect to login page
if(!isset($_SESSION['username']) || empty($_SESSION['username'])){
  header("location: login.php");
  exit;
}
?>
<?php
if($_SERVER["REQUEST_METHOD"] == "POST"){
      $amount = $_POST['amount'];
}
  $page_title = "Payment Processing...";
?>
<?php include_once "inc/header.php"; ?>
<?php include_once "inc/nav.php"; ?>

<section id="main-content">
    <div class="page-header">
        <div class="page-title">
            <h3 class="text-primary">Proceed to Payment</h3>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-title">Amount to be paid: </div>
                <div class="card-body">
                    <h2> <span class="currency"> $ </span> <?php echo $amount; ?></h2>
<?php require_once "config.php";
 echo '
<form action="stripeIPN.php?amount='.$amount. '" method="POST">
  <script src="https://checkout.stripe.com/checkout.js" class="stripe-button"
          data-key="pk_test_uK1Uf5ssw6HAq48jqn9MSJqp"
          data-description="Add money in your wallet"
          data-amount="<?php $amount; ?>"
          data-locale="auto"></script>
</form> ';
 ?>
<?php
echo '<a class="btn btn-primary" href="payment.php?amount='.$amount.'">Pay</a>';
?>
       </div>
            </div>
        </div>
    </div>
</section>
<?php include_once "inc/footer.php"; ?>
