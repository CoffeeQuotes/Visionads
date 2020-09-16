<?php
session_start();

// If session variable is not set it will redirect to login page
if(!isset($_SESSION['username']) || empty($_SESSION['username'])){
    header("location: login.php");
    exit;
}

$product_name = $_POST["product_name"];
$price = $_POST["product_price"];
$name = $_POST["name"];
$phone = $_POST["phone"];
$email = $_POST["email"];


include 'src/instamojo.php';
require_once 'inc/db.php';
require_once "config.php";

$api = new Instamojo\Instamojo('test_745d887938b801835623a159293', 'test_fdcd3e6a793b2ae8feb32696037','https://test.instamojo.com/api/1.1/');


try {
    $response = $api->paymentRequestCreate(array(
        "purpose" => $product_name,
        "amount" => $price,
        "buyer_name" => $name,
        "phone" => $phone,
        "send_email" => true,
        "send_sms" => true,
        "email" => $email,
        'allow_repeated_payments' => false,
        "redirect_url" => "http://localhost/visionads/thankyou.php",
        "webhook" => "http://demo.coregenie.com/instamojo/webhook.php"
        ));
    //print_r($response);

    $pay_ulr = $response['longurl'];

    //Redirect($response['longurl'],302); //Go to Payment page

    // Updating the wallet
    $user_id = $_SESSION['user_id'];
    $amountPost = $price;
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
    header("Location: $pay_ulr");
    exit();
}
catch (Exception $e) {
    print('Error: ' . $e->getMessage());
}
  ?>
