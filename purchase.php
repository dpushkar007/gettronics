<?php  
	session_start();
	include "include/db.php";
	if (empty($_SESSION['username'])) {
		header('location: index.php');
	}

	$action = $_GET['action'];
	$pid = $_GET['pid'];
	$username = $_SESSION['username'];

	$sql = "SELECT * FROM product WHERE id = '$pid'";
	$result = mysqli_query($conn, $sql);
	$row = mysqli_fetch_array($result);
	$seller = $row['username'];

	$sql = "SELECT * FROM user WHERE username= '$username'";
	$result = mysqli_query($conn, $sql);
	$row1 = mysqli_fetch_array($result);

	$address = $pincode = $name = $price = $comment = $flag = "";
	$addressErr = $pincodeErr = $commentErr = "";

	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		if (isset($_POST['submit'])) {
			$action = $_POST['action'];
			if ($action == 'contact') {
				//address
				if (empty($_POST['comment'])) {
					$commentErr = "Enter your query";
				}else{
					$comment = $_POST['comment'];
				}
				if ($commentErr == "") {
					$flag = 0;
					$seller = $_POST['seller'];
					$productid = $_POST['pid'];

					$sql = "INSERT INTO `orders`( `username`, `seller`, `productid`, `address`, `pincode`, `comment`, `flag`) VALUES ('$username', '$seller', '$productid', '$address', '$pincode', '$comment', '$flag')";
					mysqli_query($conn, $sql);
					header('location: myorders.php');
				}

			}elseif ($action == 'buy') {
				//address
				if (empty($_POST['address'])) {
					$addressErr = "Enter Address";
				}else{
					$address = $_POST['address'];
				}
				//pincode
				if (empty($_POST['pincode'])) {
					$pincodeErr = "Enter your pincode number";
				}else{
					$pincode = $_POST['pincode'];
					if(!preg_match("/^[0-9]{5,6}+$/", $pincode)){
						$pincodeErr = "Invalid pincode";
					}
				}
			
				if (($addressErr == "") && ($pincodeErr == "")) {
					$flag = 1;
					$seller = $_POST['seller'];
					$productid = $_POST['pid'];
					$sql = "INSERT INTO `orders`( `username`, `seller`, `productid`, `address`, `pincode`, `comment`, `flag`) VALUES ('$username', '$seller', '$productid', '$address', '$pincode', '$comment', '$flag')";
					mysqli_query($conn, $sql);
					header('location: myorders.php');
				}
			}else{
				echo "INVALID ID";
			}
				
		}
	}
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
			background-color: white;
			box-shadow: 0 0 15px 1px rgba(0,0,0,0.1);
			border-radius: 5px;
			margin:2% 15% 2% 15%;
			padding: 3% 0 3% 0;
		}
		.card h1{
			color: grey;
		}
		.card label{
			background-color: #87CEFA;
			border-right: 2px solid blue;
			text-align: right;
			padding: 3%;
		}
		.card td{
			padding: 1% 0 0 0;
		}
		.card input[type=text],
		.card textarea{
			width: 70%;
			height: 30px;
			border:1px solid #87CEFA;
			background-color: #F5F5F5;
			padding: 0 0 0 3%;
		}
		.card textarea{
			min-height: 100px;
			padding-top: 1%;
		}
		.card input[type=button],
		.card input[type=submit]{
			min-width: 100px;
			padding:2%;
			border-radius: 30px;
			border:none;
			color: #fff;
		}
		.card input[type=button]{
			background-color: #DC143C;
		}
		.card input[type=submit]{
			background-color: #4169E1;
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
					<div class="card">
						<!-- Main Content -->
						<?php if ($action == "contact") { ?>
							<h1>Inquiry About Product</h1>
							<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
								<table width="100%">
									<span style="display: none;">
										<input type="text" name="pid" value="<?php echo $row['id']; ?>">
										<input type="text" name="seller" value="<?php echo $row['username']; ?>">
										<input type="text" name="action" value="contact">
									</span>
									<tr>
										<td align="right" width="40%"><label>Product name</label></td>
										<td align="left" ><input type="text" name="" value="<?php echo $row['name']; ?>" disabled></td>
									</tr>
									<tr>
										<td align="right" width="40%"><label>Price</label></td>
										<td align="left" ><input type="text" name="" value="<?php echo $row['price']; ?>" disabled></td>
									</tr>
									<tr>
										<td align="right" width="40%"><label>Yours query/ Suggestion</label></td>
										<td align="left">
											<textarea name="comment"></textarea>
											<span class="error"><?php echo $commentErr; ?></span>
										</td>
									</tr>
									<tr>
										<td align="right" width="40%"></td>
										<td align="left">
											<input type="button" name="" value="Cancel" onclick="goBack()">
											<input type="submit" name="submit" value="Send">
										</td>
									</tr>
								</table>
							</form>
						<?php }elseif ($action == "buy") { ?>
							<h1>Buy this product</h1>
							<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
								<table width="100%">
									<span style="display: none;">
										<input type="text" name="pid" value="<?php echo $row['id']; ?>">
										<input type="text" name="seller" value="<?php echo $row['username']; ?>">
										<input type="text" name="action" value="buy">
									</span>
									<tr>
										<td align="right" width="40%"><label>Product name</label></td>
										<td align="left" ><input type="text" name="pname" value="<?php echo $row['name']; ?>" readonly="readonly"></td>
									</tr>
									<tr>
										<td align="right" width="40%"><label>Price</label></td>
										<td align="left" ><input type="text" name="pprice" value="<?php echo $row['price']; ?>" readonly="readonly"></td>
									</tr>
									<tr>
										<td align="right" width="40%"><label>What comes in box?</label></td>
										<td align="left">
											<div style="padding-left: 3%; font-size: 14px; color: #333;">
												Device - <b>Yes</b> <br>
												Bill - <b><?php echo $row['bill']; ?></b> <br>
												Warrenty card - <b><?php echo $row['warrenty']; ?></b> <br>
												Accesories - <b>Yes</b>
											</div>
										</td>
									</tr>
									<tr>
										<td align="right" width="40%"><label>Address</label></td>
										<td align="left" ><textarea name="address"><?php echo $row1['address']; ?></textarea></td>
									</tr>
									<tr>
										<td align="right" width="40%"><label>Pin code</label></td>
										<td align="left" >
											<input type="text" name="pincode" value="<?php echo $row1['pincode']; ?>">
											<span class="error"><?php echo $pincodeErr; ?></span>
										</td>
									</tr>
									<tr>
										<td align="right" width="40%"><label>Payment Method</label></td>
										<td align="left"><input type="text" name="" value="Cash On Delivery" disabled></td>
									</tr>
									<tr>
										<td align="right" width="40%"></td>
										<td align="left">
											<input type="button" name="" value="Cancel" onclick="goBack()">
											<input type="submit" name="submit" value="Buy Now">
										</td>
									</tr>
								</table>
							</form>
						<?php } ?>
						<!-- Main Content Ends -->
					</div>
						
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
<script>
function goBack() {
  window.history.back();
}
</script>