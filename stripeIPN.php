<?php
// Initialize the session
session_start();

// If session variable is not set it will redirect to login page
if(!isset($_SESSION['username']) || empty($_SESSION['username'])){
    header("location: login.php");
    exit;
}
require_once 'inc/db.php';
require_once "config.php";
\Stripe\Stripe::setVerifySslCerts(false);
// Token is created using Checkout or Elements!
// Get the payment token ID submitted by the form:
$amountPost = $_GET['amount'];

if(!isset($_POST['stripeToken']) ||!isset($amountPost)) {
    header("Location: add_balance.php");
    exit();
}
$token = $_POST['stripeToken'];
$email = $_POST['stripeEmail'];
// Charge the user's card:
$charge = \Stripe\Charge::create(array(
    "amount" => $amountPost*100,
    "currency" => "usd",
    "description" => "Add money in your account",
    "source" => $token,
));?>
<!DOCTYPE html>
<html>
	<head>
		<title>Payment Status</title>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	</head>
	<body>
	<div class="cotaniner mx-auto py-5 mt-5 bg-dark">
	<?php
echo "<p class=\"lead text-success\">Success, you have successfully charged $ $amountPost";
echo "</p>";		
// What I want to do here
// I want to check if the current user have balance in account
// If yes then add then update the amount if not
// Then Please insert the amount

$user_id = $_SESSION['user_id'];

$sql = 'SELECT amount FROM wallets WHERE user_id = :user_id';
if($stmt = $pdo->prepare($sql)) {
    $stmt->bindParam(':user_id', $param_user_id, PDO::PARAM_INT);
    //Set parameter
    $param_user_id = $user_id;
    if($stmt->execute()) {
        $num_rows = $stmt->rowcount();
        if($num_rows > 0) {
            $result = $stmt->fetchObject();
            $oldAmount = $result->amount;
            $amountNew = ($amountPost + $oldAmount);
            try {
				$sql2 = 'UPDATE wallets SET amount = :amount WHERE user_id = :user_id';
                if($stmt2 = $pdo->prepare($sql2)) {
                    $stmt2->bindParam(':amount', $param_amount, PDO::PARAM_STR);
                    $stmt2->bindParam(':user_id', $param_user_id, PDO::PARAM_INT);
                    $param_amount = $amountNew;
                    $param_user_id = $user_id;
                    if($stmt2->execute()){
                        echo "<h2 class=\"text-info\">Your balance Updated Successfully</h2>";
                    } else {
                        echo "Sorry, Something Went Wrong.";
                    }
                }

            }

            catch(PDOException $e)

            {
                echo 'Error: ' . $e->getMessage();
            }
        }
        else if ($num_rows == 0)
        {
            try {
                $sql3 = 'INSERT INTO wallets(user_id, amount) VALUES (:user_id, :amount)';
                if($stmt3 = $pdo->prepare($sql3)) {
                    $stmt3->bindParam(':user_id',$param_user_id, PDO::PARAM_INT);
                    $stmt3->bindParam(':amount',$param_amount, PDO::PARAM_STR);
                    $param_amount = $amountPost;
                    $param_user_id = $user_id;
                    if($stmt3->execute()){
                        echo "<h2 class=\"text-info\">Your balance added Successfully</h2>";
                    } else {
                        echo "Sorry, Something Went Wrong.";
                    }
                }
            }
            catch(PDOException $e)
            {
                echo 'Error: ' . $e->getMessage();
            }

        } else
            {
            echo "Unknown Error Occurred While processing your request";
        }

    }

} // first query
?>
<a href="dashboard.php" class="btn btn-sm btn-info">Go to Dashboard</a>
</div> 
<script src="https://code.jquery.com/jquery-migrate-1.4.1.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
	</body>
</html>

