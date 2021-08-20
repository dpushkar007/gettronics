<?php  
	session_start();
	include "include/db.php";
	if (!empty($_SESSION['username'])) {
		$username = $_SESSION['username'];
	}else{
		$username = "demo";
	}
	
	$_GLOBAL['sql'] = "SELECT * FROM `product` WHERE `username` = '$username'";

	$search = $searchErr = "";
	if ($_SERVER['REQUEST_METHOD'] == "POST") {
		if (isset($_POST['search'])) {
			if (empty($_POST['searchName'])) {
				$searchErr = "Enter search query";
			}else{
				$search = $_POST['searchName'];
			}
			if ($searchErr == "") {
				$_SESSION['squery'] = "SELECT * FROM `product` WHERE `name` LIKE '%".$search."%'";
				header('location: search.php');
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
		#cat .card{
			background-color: white;	
			box-shadow: 0 0 10px 1px rgba(0,0,0,0.8);
			border:1px solid grey;
			border-radius: 5px;
			text-align: left;
			padding: 1%;
		}
		#cat .card #right{
			padding-left: 2%;
		}
		#cat a{
			text-decoration: none;
			color: black;
		}
		#main h1{
			color: grey;
			font-size: 30px;
		}
		#myupload .card{
			background-color:  	#FFF;
			padding: 5%;
			border:1px solid grey;
			border-top-right-radius: 30px;
			min-height: 250px;
		}
		#myupload .card .details{
			text-align: left;
			font-size: 12px;
		}
		#myupload .card img{
			border:1px solid grey;
			border-top-right-radius: 20px;
			width: 100%;
		}
		#myupload .card #price{
			color:red;
		}
		#myupload .nav-vertical{
			background-color:  	#E6E6FA;
			margin: 2% 0 0 0;
			padding: 1%;
		}
		#myupload .cat,
		#myupload .sort{
			width: 200px;
			min-height: 20px;
			text-align: center;
			border:none;
			border:1px solid lightgrey;
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
					<table class="search" width="100%" cellspacing="0" cellpadding="0">
						<form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" id="searchform">
						<tr>
							<td width="30%" align="right"><span>Category</span></td>
							<td width="40%">
								<input type="text" name="searchName" placeholder="What product you want?"><br>
								<h class="error"><?php echo $searchErr; ?></h>
							</td>
							<td width="30%" align="left"><input type="submit" name="search" value="Search"></td>
						</tr>
						</form>
					</table>
					<!-- Main Content -->
					<table id="cat" width="100%" cellspacing="20">
						<tr>
							<td width="33.33%" class="card" valign="middle">
								<table>
									<tr>
										<td id="left" width="20%"><a class="link" href="category.php?category=mobile&sort=0"><img src="media/mobile.png" height="70"></a></td>
										<td id="right" width="80%"><a class="link" href="category.php?category=mobile&sort=0">M O B I L E</a></td>
									</tr>
								</table>
							</td>
							<td width="33.33%" class="card" valign="middle">
								<table>
									<tr>
										<td id="left" width="20%"><a class="link" href="category.php?category=laptop&sort=0"><img src="media/laptop.png" height="70"></a></td>
										<td id="right" width="80%"><a class="link" href="category.php?category=laptop&sort=0">L A P T O P</a></td>
									</tr>
								</table>
							</td>
							<td width="33.33%" class="card" valign="middle">
								<table>
									<tr>
										<td id="left" width="20%"><a class="link" href="category.php?category=pc&sort=0"><img src="media/pc.png" height="70"></a></td>
										<td id="right" width="80%"><a class="link" href="category.php?category=pc&sort=0">PERSONAL COMPUTER</a></td>
									</tr>
								</table>
							</td>
						</tr>
						<tr>
							<td width="33.33%" class="card" valign="middle">
								<table>
									<tr>
										<td id="left" width="20%"><a class="link" href="category.php?category=accessories&sort=0"><img src="media/accesories.png" height="70"></a></td>
										<td id="right" width="80%"><a class="link" href="category.php?category=accessories&sort=0">A C C E S S O R I E S</a></td>
									</tr>
								</table>
							</td>
							<td width="33.33%" class="card" valign="middle">
								<table>
									<tr>
										<td id="left" width="20%"><a class="link" href="category.php?category=home&sort=0"><img src="media/home.png" height="70"></a></td>
										<td id="right" width="80%"><a class="link" href="category.php?category=home&sort=0">HOME APPLIANCES</a></td>
									</tr>
								</table>
							</td>
							<td width="33.33%" class="card" valign="middle">
								<table>
									<tr>
										<td id="left" width="20%"><a class="link" href="category.php?category=other&sort=0"><img src="media/other.png" height="70"></a></td>
										<td id="right" width="80%"><a class="link" href="category.php?category=other&sort=0">O T H E R</a></td>
									</tr>
								</table>
							</td>
						</tr>
					</table>


					<h1>Your Uploads</h1>
					<table width="100%" id="myupload" cellspacing="10">
						<?php 
							$result = mysqli_query($conn, $_GLOBAL['sql']);
							if (mysqli_num_rows($result) > 0) {
								$i=1;
								while ($show = mysqli_fetch_array($result)) {
									$product = "product.php?name=".$show['id']."&username=".$show['username']."&category=".$show['category'];
									if ($i%5 == 0) {
										echo "<tr>";
										echo "</tr>";
							?>
									<td width="25%">
										<div class="card">
											<a href="<?php echo $product; ?>"><img src="<?php echo $show['img1']; ?>" height="150"></a>
											<div class="details">
												<span style="font-weight: bold; font-size: 14px;"><a href="<?php echo $product; ?>"><?php echo $show['name']; ?></a></span><br>
												<span id="price">&#8377; <?php echo $show['price']; ?></span><br>
												<span><font style="color:grey">Seller - </font> <?php echo $show['username']; ?></span><br>
												<span><font style="color:grey">Upload Date - </font></span><br>
											</div>
										</div>
									</td>
							<?php		}else{
							?>
									<td width="25%">
										<div class="card">
											<a href="<?php echo $product; ?>"><img src="<?php echo $show['img1']; ?>" height="150"></a>
											<div class="details">
												<span style="font-weight: bold; font-size: 14px;"><a href="<?php echo $product; ?>"><?php echo $show['name']; ?></a></span><br>
												<span id="price">&#8377; <?php echo $show['price']; ?></span><br>
												<span><font style="color:grey">Seller - </font> <?php echo $show['username']; ?></span><br>
												<span><font style="color:grey">Upload Date - </font></span><br>
											</div>
										</div>
									</td>
							<?php
									}	
									$i++;
								}
							}else{
								echo "<h2>You have not uploaded any products</h2>";
							}
						?>
					</table>
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