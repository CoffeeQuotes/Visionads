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
$page_title = "Dashboard";
include_once "data.php";
include_once "inc/header.php";
include_once "inc/nav.php";
?>
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
	<div class="page-title">
            <h1>Hi, <b><?php echo htmlspecialchars($_SESSION['username']); ?></b>.</h1>
    </div>
</div>
<div class="col-lg-3">
	<div class="card">
		<div class="stat-widget-two">
			<div class="stat-content">
				<div class="stat-text">Total Money </div>
				<div class="stat-digit"> <i class="fa fa-usd"></i><?= $total_amount_in_wallet; ?></div>
			</div>
			<div class="progress">
				<div class="progress-bar progress-bar-success w-100" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
			</div>
		</div>
	</div>
</div>
<div class="col-lg-3">
	<div class="card">
		<div class="stat-widget-two">
			<div class="stat-content">
				<div class="stat-text">Total Campaigns</div>
				<div class="stat-digit"><?= $total_campaigns ?></div>
			</div>
			<div class="progress">
				<div class="progress-bar progress-bar-primary w-75" role="progressbar" aria-valuenow="78" aria-valuemin="0" aria-valuemax="100"></div>
			</div>
		</div>
	</div>
</div>
<div class="col-lg-3">
	<div class="card">
		<div class="stat-widget-two">
			<div class="stat-content">
				<div class="stat-text">Active Campaigns</div>
				<div class="stat-digit"><?= $total_active_campaigns ?></div>
			</div>
			<div class="progress">
				<div class="progress-bar progress-bar-warning w-50" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
			</div>
		</div>
	</div>
</div>
<div class="col-lg-3">
	<div class="card">
		<div class="stat-widget-two">
			<div class="stat-content">
				<div class="stat-text">Pending Campaigns</div>
				<div class="stat-digit"><?= $total_pending_campaigns ?></div>
			</div>
			<div class="progress">
				<div class="progress-bar progress-bar-danger w-65" role="progressbar" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100"></div>
			</div>
		</div>
	</div>
	<!-- /# card -->
</div>
<!-- /# column -->
<!-- /# row -->
<!-- column -->
<div class="col-lg-12">
	<div class="footer">
		<p>2018 © Admin Board. - <a href="#">example.com</a></p>
	</div>
</div>

		</div>
	</section>
</div>
<?php include_once "inc/footer.php" ?>
