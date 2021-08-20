<?php  
	session_start();
	include "include/db.php";
	if (empty($_SESSION['username'])) {
		header('location: index.php');
	}
	$username = $_SESSION['username'];
	$_GLOBAL['comment'] = "";
	$_GLOBAL['sql'] = "SELECT * FROM `orders` WHERE `seller` = '$username' AND (`flag` = '0' OR `flag` = '1')";

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
			padding-top: 2%;
		}
		.card td img{
			width: 70px;
			height: 70px;
			border-radius: 100px;
			border: 1px solid #333;
			padding: 1%;
		}
		.card input{
			min-width: 100px;
			padding: 4%;
			border-radius: 30px;
			border:none;
			margin: 1% 0 1% 0;
			color: #fff;
		}
		.card input[name=accept]{
			background-color: green;
		}
		.card input[name=contact]{
			background-color:  	#008B8B;
		}
		.card input[name=decline]{
			background-color: red;
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
					<h1 style="color: grey; font-size: 30px;">Notifications</h1>
					<!-- Main Content -->
					<?php 
						$result = mysqli_query($conn, $_GLOBAL['sql']);
						if (mysqli_num_rows($result) > 0) {
							while ($row = mysqli_fetch_array($result)) {
								$user = $row['username'];
								$sql = "SELECT * FROM user WHERE username = '$user'";
								$result1 = mysqli_query($conn, $sql);
								$row1 = mysqli_fetch_array($result1);
								$pid = $row['productid'];
								$sql1 = "SELECT * FROM product WHERE id = '$pid'";
								$result2 = mysqli_query($conn, $sql1);
								$row2 = mysqli_fetch_array($result2);
								$path = "users/".$row['username']."/profile.png";
								if ($row['comment'] == "") {
									$_GLOBAL['comment'] = "<b style='color:red;'>".$row['username']."</b> wants to purchase this product";
								}else{
									$_GLOBAL['comment'] = $row['comment'];
								}
								$_GLOBAL['pid'] = $row['id'];

								$_GLOBAL['contact'] = "UPDATE `orders` SET `flag`= '3' WHERE `id` = '$pid'";
								$_GLOBAL['decline'] = "UPDATE `orders` SET `flag`= '4' WHERE `id` = '$pid'";
					?>
							<div class="card">
								<form method="POST" accept="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
								<table cellpadding="15">
									<tr>
										<td width="10%" valign="middle"><img src="<?php echo $path; ?>" height="100"></td>
										<td width="30%" align="justify" valign="top">
											Customer - <b><?php echo $row['username']; ?></b> <hr> <?php echo $_GLOBAL['comment']; ?>
										</td>
										<td width="40%" align="justify" valign="top">
											<?php echo $row2['name']; ?> <hr> <font color="red">&#8377; <?php echo $row2['price']; ?></font>
										</td>
										<td width="20%" valign="middle">
											<input type="submit" name="accept" value="Accept">
											<input type="submit" name="contact" value="Contact Buyer">
											<input type="submit" name="decline" value="Decline">
										</td>
									</tr>
								</table>
								</form>	
							</div>
					<?php		}
						}else{
							echo "<h2>No data Found</h2>";
						}
						if ($_SERVER['REQUEST_METHOD'] == 'POST'){
							if (isset($_POST['accept'])) {
								$pid = $_GLOBAL['pid'];
								$_GLOBAL['accept'] = "UPDATE `orders` SET `flag`= '2' WHERE `id` = '$pid'";
								mysqli_query($conn, $_GLOBAL['accept']);
								echo("<meta http-equiv='refresh' content='1'>");
							}
							if (isset($_POST['contact'])) {
								$pid = $_GLOBAL['pid'];
								$_GLOBAL['accept'] = "UPDATE `orders` SET `flag`= '3' WHERE `id` = '$pid'";
								mysqli_query($conn, $_GLOBAL['accept']);
								echo("<meta http-equiv='refresh' content='1'>");
							}
							if (isset($_POST['decline'])) {
								$pid = $_GLOBAL['pid'];
								$_GLOBAL['accept'] = "UPDATE `orders` SET `flag`= '4' WHERE `id` = '$pid'";
								mysqli_query($conn, $_GLOBAL['accept']);
								echo("<meta http-equiv='refresh' content='1'>");
							}
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