<!DOCTYPE html>
<html>
<head>
	<title></title>
	<style type="text/css">
		.nav{
			background-color: #333;
			color:#fff;
			text-align: center;
			margin-bottom: 2px;
			padding: 5% 0 5% 0;
		}
	</style>
</head>
<body>
	<?php if (empty($_SESSION['username'])) { ?>
		<a href="index.php"><div class="nav">Home</div></a>
		<a href="about.php"><div class="nav">About</div></a>
		<a href="contactus.php"><div class="nav">Contact Us</div></a>
	<?php }else{ ?>
		<a href="index.php"><div class="nav">Home</div></a>
		<a href="myorders.php"><div class="nav">My Order</div></a>
		<a href="notification.php"><div class="nav">Notification</div></a>
		<a href="myupload.php"><div class="nav">My Uploads</div></a>
		<a href="sell.php"><div class="nav">Sell Your Product</div></a>
		<a href="about.php"><div class="nav">About</div></a>
		<a href="contactus.php"><div class="nav">Contact Us</div></a>
	<?php } ?>
</body>
</html>