<?php
if(isset($_GET['amount'])) {
  $amountPost = $_GET['amount'];
  $title = "Add money in your wallet";
} else {
  echo "Something Went Wrong";
}


?>
<h3>Your Payment Details </h3>
		<hr>
		<form action="pay.php" method="POST" accept-charset="utf-8">

		<input type="hidden" name="product_name" value="<?php echo $title; ?>">
		<input type="hidden" name="product_price" value="<?php echo $amountPost; ?>">

		<div class="form-group">
    	<label>Your Name</label>
   		<input type="text" class="form-control" name="name" placeholder="Enter your name">	 <br/>
		</div>

		<div class="form-group">
    	<label>Your Phone</label>
   		<input type="text" class="form-control" name="phone" placeholder="Enter your phone number"> <br/>
		</div>


		<div class="form-group">
    	<label>Your Email</label>
   		<input type="email" class="form-control" name="email" placeholder="Enter you email"> <br/>
		</div>


		<input type="submit" class="btn btn-success btn-lg" value="Click here to Pay $:<?php echo $amountPost; ?> ">

</form>
