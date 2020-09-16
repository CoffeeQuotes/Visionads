<?php 
 require_once '../inc/db.php';
 $sql = 'SELECT * FROM campaigns';
 $stmt = $pdo->prepare($sql);
 if($stmt->execute()) {
 	$total_campaigns = $stmt->rowCount();
 }
 
 $sql = 'SELECT * FROM campaigns WHERE status=:status';
 $stmt = $pdo->prepare($sql);
 $status = 'Approved';
 if($stmt->execute([':status'=> $status])) {
 	$total_active_campaigns = $stmt->rowCount();
 	echo $total_active_campaigns;
 } 
 
 $sql = 'SELECT * FROM users';
 $stmt = $pdo->prepare($sql);
 if($stmt->execute()) {
 	$total_users = $stmt->rowCount();
 }

 $sql = 'SELECT SUM(amount) as totalAmount FROM wallets';
 $stmt = $pdo->prepare($sql);
 if($stmt->execute()) {
 	$row = $stmt->fetch(PDO::FETCH_ASSOC);
 	$total_amount_in_wallet = $row['totalAmount'];
 }
?>