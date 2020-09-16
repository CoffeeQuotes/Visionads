<?php
// Include config file
require_once 'inc/db.php';
// Initialize the session
session_start();

// If session variable is not set it will redirect to login page
if(!isset($_SESSION['username']) || empty($_SESSION['username'])){
  header("location: login.php");
  exit;
}
$user_id = $_SESSION['user_id'];

$sql = "SELECT * FROM campaigns WHERE user_id= :user_id";

if($stmt = $pdo->prepare($sql)) {
	$stmt->bindParam(':user_id', $param_user_id, PDO::PARAM_INT);
	$param_user_id = $user_id;
	if($stmt->execute()) {
		$campaigns = $stmt->fetchAll(PDO::FETCH_OBJ);
	} else {
		echo "Some Error Occured Internally.";
	}
} else {
	echo "Some Error Occured Internally.";
}
$page_title = "List of your Campaigns";
include_once "inc/header.php";
include_once "inc/nav.php";
?>
<section id="main-content">
	<div class="page-header">
		<div class="page-title">
            <h1>Hi, <b><?php echo htmlspecialchars($_SESSION['username']); ?></b>. It's Your Campaign list.</h1>
		</div>
	</div>
<div class="row">
	<div class="col-lg-12">
		<div class="card">
			<div class="card-title">List Campaigns</div>
			<div class="card-body">
				<div class="table-responsive">
					<table class="table table-hover">
						<thead>
							<tr>
								<th class="text-center">Title</th>
								<th class="text-center">URL</th>
								<th class="text-center">Region</th>
								<th class="text-center">Target</th>
								<th class="text-center">Description</th>
								<th class="text-center">Campaign Budget</th>
								<th class="text-center">Status</th>
								<th class="text-center">Action</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($campaigns as $campaign): ?>
								<tr>
									<td><?= $campaign->title; ?></td>
									<td><a href="<?= $campaign->url;?>"><?= $campaign->url;?></a></td>
									<td><?= $campaign->region; ?></td>
									<td><?= $campaign->target; ?></td>
									<td><?= $campaign->description;?></td>
									<td><b>$</b> <?= $campaign->campaign_budget;?></td>
									<td><?= $campaign->status; ?></td>
									<td><a href="edit.php?id=<?=$campaign->id?>" class="btn btn-info btn-sm">Edit</a>  <a onclick="return confirm('Are you sure you want to delete this entry?')" href="delete.php?id=<?= $campaign->id ?>" class='btn btn-sm btn-danger'>Delete</a></td>
								</tr>
							<?php endForeach; ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
</section>
<?php include_once "inc/footer.php" ?>
