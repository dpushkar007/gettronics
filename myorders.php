<?php  
	session_start();
	include "include/db.php";
	if (empty($_SESSION['username'])) {
		header('location: index.php');
	}
	$username = $_SESSION['username'];
	$_GLOBAL['sql'] = "SELECT * FROM `orders` WHERE `username` = '$username' ORDER BY id DESC";

?>
<!DOCTYPE html>
<html lang="en-us">
<head>
	<title>HOME - gettronics</title>
	<link rel="shortcut icon" href="media/fc.png">
	<link rel="stylesheet" type="text/css" href="include/style.css">
	<meta charset="utf-8">
	<style type="text/css">
		.card{
			border:1px solid grey;
			background-color: white;
			border-radius: 5px;
			margin: 0 5% 2% 5%;
		}
		.card td{
			padding: 2%;
		}
		.card td img{
			width: 70px;
			height: 70px;
			border-radius: 100px;
			border: 1px solid #333;
			padding: 2%;
		}
		.card input{
			min-width: 100px;
			padding: 4%;
			border-radius: 30px;
			border:none;
			background-color:  	#CD5C5C;
			color: white;
		}
	</style>
</head>
<body>
	<header>
		<?php include "include/header.html"; ?>
	</header>
	<section>
		<table>
			<tr>
				<td width="15%" id="profile"><?php include "profile.php"; ?></td>
				<td width="70%" id="main" valign="top">
					<!-- Main Content -->
					<h1 style="color: grey;font-size: 30px;">Your Orders</h1>

					<?php
						$result = mysqli_query($conn, $_GLOBAL['sql']);
						if (mysqli_num_rows($result) > 0) {
							while($row = mysqli_fetch_array($result)){
								$pid = $row['productid'];
								$seller = $row['seller'];
								$sql = "SELECT * FROM `product` WHERE `id`= '$pid'";
								$result1 = mysqli_query($conn, $sql);
								$row1 = mysqli_fetch_array($result1);
								if ($row['flag'] == 0) {           ?>
									<div class="card">
										<table>
											<tr>
												<td width="20%"><img src="<?php echo $row1['img1']; ?>"></td>
												<td align="justify" width="40%" valign="top">
													<b><?php echo $row1['name']; ?></b><hr>
													Price - <span class="error">&#8377; <?php echo $row1['price']; ?></span>
													
												</td>
												<td width="40%" align="justify" valign="top">Status <hr> <b>Your Inquiry is under scrunity</b></td>
											</tr>
										</table>
									</div>
					<?php		}elseif ($row['flag'] == 1) {      ?>
									<div class="card">
										<table>
											<tr>
												<td width="20%"><img src="<?php echo $row1['img1']; ?>"></td>
												<td align="justify" width="40%" valign="top">
													<b><?php echo $row1['name']; ?></b><hr>
													Price - <span class="error">&#8377; <?php echo $row1['price']; ?></span>
													
												</td>
												<td width="40%" align="justify" valign="top">Status <hr> <b>You requested to buy this product.</b></td>
											</tr>
										</table>
									</div>
					<?php		}elseif ($row['flag'] == 2) {      ?>  
									<div class="card">
										<table>
											<tr>
												<td width="20%"><img src="<?php echo $row1['img1']; ?>"></td>
												<td align="justify" width="40%" valign="top">
													<b><?php echo $row1['name']; ?></b><hr>
													Price - <span class="error">&#8377; <?php echo $row1['price']; ?></span>
													
												</td>
												<td width="40%" align="justify" valign="top">
													Status <hr><b>Your purchase is approved.</b><br>
													<?php 
														$sql2 = "SELECT * FROM user WHERE username = '$seller'";
														$result2 = mysqli_query($conn, $sql2);
														$row2 = mysqli_fetch_array($result2);
													?>
													contact to number: <b class="error"><?php echo $row2['mobile']; ?></b>
												</td>
											</tr>
										</table>
									</div>
					<?php		}elseif ($row['flag'] == 3) {      ?>  
									<div class="card">
										<table>
											<tr>
												<td width="20%"><img src="<?php echo $row1['img1']; ?>"></td>
												<td align="justify" width="40%" valign="top">
													<b><?php echo $row1['name']; ?></b><hr>
													Price - <span class="error">&#8377; <?php echo $row1['price']; ?></span>
													
												</td>
												<td width="40%" align="justify" valign="top">
													Status <hr><b>Seller wants to make contact with you.</b><br>
													<?php 
														$sql2 = "SELECT * FROM user WHERE username = '$seller'";
														$result2 = mysqli_query($conn, $sql2);
														$row2 = mysqli_fetch_array($result2);
													?>
													contact to number: <b class="error"><?php echo $row2['mobile']; ?></b>
												</td>
											</tr>
										</table>
									</div>
					<?php		}elseif ($row['flag'] == 4) {      ?>
									<div class="card">
										<table>
											<tr>
												<td width="20%"><img src="<?php echo $row1['img1']; ?>"></td>
												<td align="justify" width="40%" valign="top">
													<b><?php echo $row1['name']; ?></b><hr>
													Price - <span class="error">&#8377; <?php echo $row1['price']; ?></span>
													
												</td>
												<td width="40%" align="justify" valign="top">Status <hr> Sorry seller dont want to sell his product to you. Search for similar one.</td>
											</tr>
										</table>
									</div>
					<?php		}
							}
						}else{
							echo "<h2>No Data Found</h2>";
						}
					?>

									




					<!-- Main Content Ends -->
				</td>
				<td width="15%" id="navigation" valign="top"><?php include "navigation.php"; ?></td>
			</tr>
		</table>
	</section>
	<footer>
		<?php include "include/footer.html"; ?>
	</footer>
</body>
</html>