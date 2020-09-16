<?php
require 'inc/db.php';
session_start();

// If session variable is not set it will redirect to login page
if(!isset($_SESSION['username']) || empty($_SESSION['username'])){
  header("location: login.php");
  exit;
}
$id = $_GET['id'];
$sql = 'DELETE FROM campaigns WHERE id=:id';
$statement = $pdo->prepare($sql);
if ($statement->execute([':id' => $id])) {
  header("Location: list_campaign.php");
}
