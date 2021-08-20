<?php  
	session_start();
	include "include/db.php";
	$username = $_SESSION['username'];
	$_GLOBAL['sql'] = "SELECT * FROM Product WHERE username = '$username'";

?>
<!DOCTYPE html>
<html lang="en-us">
<head>
	<title>HOME - gettronics</title>
	<link rel="shortcut icon" href="media/fc.png">
	<link rel="stylesheet" type="text/css" href="include/style.css">
	<meta charset="utf-8">
	<style type="text/css">
		#main h1{
			font-size: 25px;
			color: grey;
		}
		.card{
			background-color: white;
			margin: 0 auto 2% auto;
			width: 90%;
			border: 1px solid grey;
			border-radius: 5px;
		}
		.card img{
			height: 100px;
			width: 100px;
			border-radius: 100px;
			border:1px solid #333;
			padding: 1%;
		}
		.card tr input{
			min-width: 100px;
			padding: 5%;
			margin: 1%;
			border-radius: 30px;
			border:none;
		}
		.card tr input[type=button]{
			background-color:  	#008B8B;
		}
		.card tr input[type=submit]{
			color:white;
			background-color:  	#B22222;
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

					<h1>Your Products</h1>
					
					<?php 
						$result = mysqli_query($conn,$_GLOBAL['sql']);
						if (mysqli_num_rows($result) > 0) {
							while($row = mysqli_fetch_array($result)){
					?>
					<table class="card" cellpadding="5">
						<tr>
							<td width="20%"><img src="<?php echo $row['img1']; ?>"></td>
							<td width="60%" style="text-align: justify; color: #333;"><b><?php echo $row['name']; ?></b><br><?php echo $row['description']; ?></td>
							<td width="20%">&#8377; <?php echo $row['price']; ?></td>
						</tr>
					</table>
					<?php		}
						}else{
							echo "<h2>You are not upload any product</h2>";
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