<?php 
require "../inc/db.php";
// Initialize the session
session_start();

// If session variable is not set it will redirect to login page
if(!isset($_SESSION['admin_username']) || empty($_SESSION['admin_username'])){
  header("location: adminlogin.php");
  exit;
}

$id = $_GET['id'];
$status = 'Approved';
$sql = 'UPDATE campaigns SET status = :status WHERE id=:id';
$statement = $pdo->prepare($sql);
if ($statement->execute([':id' => $id, ':status' => $status])) {
	$sql2 = 'SELECT user_id FROM campaigns WHERE id=:id';
	$stmt = $pdo->prepare($sql2);
	$stmt->execute([':id'=>$id]);
	$user_camp = $stmt->fetch(PDO::FETCH_OBJ);
	$campaign_user_id = $user_camp->user_id;
	$campaign_name = $user_camp->title;
	$campaign_url = $user_camp->url;
	$sql3 = 'SELECT * FROM users WHERE id=:campaign_user_id';
	$stmt = $pdo->prepare($sql3);
	$stmt->execute([':campaign_user_id' => $campaign_user_id]);
	$user_details = $stmt->fetch(PDO::FETCH_OBJ);
	$user_email = $user_details->email;
	$user_name = $user_details->name; 
	require_once "mail.php";
  header("Location: campaign_status.php");
}
?>