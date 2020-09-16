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
$sql = 'DELETE * FROM users WHERE id=:id';
$stmt = $pdo->prepare($sql);
if($stmt->execute([':id' => $id])) {
	header("Location: user_status.php");
}
