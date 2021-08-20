<?php  
	session_start();
	include "include/db.php";
	if (empty($_SESSION['username'])) {
		header('location: index.php');
	}
	$username = $_SESSION['username'];
	$cat = $_GET['category'];
	$sort = $_GET['sort'];
	if ($sort == 1) {
		$_GLOBAL['sql'] = "SELECT * FROM `product` WHERE `category` = '$cat' AND `username` != '$username' ORDER BY `price` ASC";
	}elseif ($sort == 2) {
		$_GLOBAL['sql'] = "SELECT * FROM `product` WHERE `category` = '$cat' AND `username` != '$username' ORDER BY `price` DESC";
	}else{
		$_GLOBAL['sql'] = "SELECT * FROM `product` WHERE `category` = '$cat' AND `username` != '$username'";
	}
	
	$_GLOBAL['product'] = "";
	if ($_SERVER['REQUEST_METHOD'] == "POST") {
		$cat = $_GET['category'];
		if (isset($_POST['cat'])) {
			switch($_POST['cat']) {	
	            case 'mobile':
	            	$_SESSION['cat'] = "mobile";
	                header("Location: category.php?category=mobile&sort=0");
	                break;
	            case 'laptop':
	            	$_SESSION['cat'] = "laptop";
	                header("Location: category.php?category=laptop&sort=0");
	                break;
	            case 'pc':
	            	$_SESSION['cat'] = "pc";
	                header("Location: category.php?category=pc&sort=0");
	                break;
				case 'acc':
					$_SESSION['cat'] = "accessories";
	                header("Location: category.php?category=accessories&sort=0");
	                break;
	            case 'home':
	            	$_SESSION['cat'] = "home";
	                header("Location: category.php?category=home&sort=0");
	                break;
	            case 'other':
	            	$_SESSION['cat'] = "other";
	                header("Location: category.php?category=other&sort=0");
	                break;	                
	        }
		}
		if (isset($_POST['sort'])) {
			if ($_POST['sort'] == 1) {
				header('location: category.php?category='.$_SESSION['cat'].'&sort=1');
			}elseif ($_POST['sort'] == 2) {
				header('location: category.php?category='.$_SESSION['cat'].'&sort=2');
			}
		}
	}

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
		.card{
			background-color:  	#FFF;
			padding: 5%;
			border:1px solid grey;
			border-top-right-radius: 30px;
			min-height: 250px;
		}
		.card .details{
			text-align: left;
			font-size: 12px;
		}
		.card img{
			border:1px solid grey;
			border-top-right-radius: 20px;
			width: 100%;
		}
		.card #price{
			color:red;
		}
		.nav-vertical{
			background-color:  	#E6E6FA;
			margin: 2% 0 0 0;
			padding: 1%;
		}
		.cat,
		.sort{
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

					<table class="nav-vertical">
						<tr>
							<td width="25%"></td>
							<td width="25%"></td>
							<td width="50%">
								<form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" enctype="multipart/form-data">
									<select name="cat" class="cat" onchange="this.form.submit()">
										<option>----Category----</option>
										<option value="mobile">Mobile</option>
										<option value="laptop">Laptop</option>
										<option value="pc">Personal Computer</option>
										<option value="acc">Accessories</option>
										<option value="home">Home Appliances</option>
										<option value="other">Other</option>
									</select>

									<select class="sort" name="sort" onchange="this.form.submit()">
										<option>----sort----</option>
										<option value="1">Price [Low - High]</option>
										<option value="2">Price [High - Low]</option>
									</select>
								</form>
							</td>
						</tr>
					</table>
					<!-- Main Content -->
					<table width="100%" cellspacing="10">
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
								echo "<h2>No Product Found</h2>";
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