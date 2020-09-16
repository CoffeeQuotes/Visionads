<?php 
 require_once 'inc/db.php';
 $sql = 'SELECT * FROM campaigns WHERE user_id =:user_id';
 $user_id = $_SESSION['user_id'];
 $stmt = $pdo->prepare($sql);
 if($stmt->execute(['user_id'=> $user_id])) {
 	$total_campaigns = $stmt->rowCount();
 }
 
 $sql = 'SELECT * FROM campaigns WHERE status=:status && user_id=:user_id';
 $stmt = $pdo->prepare($sql);
 $status = 'Approved';
 if($stmt->execute([':status'=> $status, ':user_id'=> $user_id])) {
 	$total_active_campaigns = $stmt->rowCount();
 	echo $total_active_campaigns;
 } 
 

 $sql = 'SELECT * FROM campaigns WHERE status=:status && user_id=:user_id';
 $stmt = $pdo->prepare($sql);
 $status = 'Pending';
 if($stmt->execute([':status'=> $status, ':user_id'=> $user_id])) {
 	$total_pending_campaigns = $stmt->rowCount();
 	echo $total_active_campaigns;
 } 
 
 $sql = 'SELECT * FROM users';
 $stmt = $pdo->prepare($sql);
 if($stmt->execute()) {
 	$total_users = $stmt->rowCount();
 }

 $sql = 'SELECT SUM(amount) as totalAmount FROM wallets WHERE user_id= :user_id';
 $stmt = $pdo->prepare($sql);
 if($stmt->execute([':user_id'=>$user_id])) {
 	$row = $stmt->fetch(PDO::FETCH_ASSOC);
 	$total_amount_in_wallet = $row['totalAmount'];
 }
?>