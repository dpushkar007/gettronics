<?php  
	session_start();
	include "include/db.php";
	if (empty($_SESSION['username'])) {
		header('location: index.php');
	}
	$name = $_GET['name'];
	$username = $_GET['username'];
	$user = $_SESSION['username'];
	$sql = "SELECT * FROM product WHERE id = '$name' AND username = '$username'";
	$result = mysqli_query($conn,$sql);
	$show1 = mysqli_fetch_array($result);

	$cat = $_GET['category'];
	$_GLOBAL['sql1'] = "SELECT * FROM `product` WHERE `category` = '$cat' AND `id` != '$name' AND `username` != '$user'";
	$_GLOBAL['product'] = "";



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
		.product{
			background-color: #fff;
			box-shadow: 0px 0px 2px 1px rgba(0, 0, 0, 0.2);
			min-height: 200px;
			margin: 2%;
		}
		.product-img{
			text-align: center;
			border:1px solid #E6E6FA;
			border-radius: 3px;
			background-color: whitesmoke;
		}
		.product-img img{
			display: block;
			margin-left: auto;
			margin-right: auto;
			max-width: 100%;
		}
		.mySlides {display:none;}
		.product-info h3{
			color: #333;
		}
		.info1{
			text-align: left;
			padding: 0 1% 0 1%;
			color: grey;
		}
		button{
			background-color: #333;
			color: #fff;
			border:none;
			min-width: 40px;
			padding: 1%;
		}
		.button-group input{
			min-width: 100px;
			padding: 1%;
			border-radius: 30px;
			border:none;
			margin:1% 0 1% 0;
			color:white;
		}
		.button-group input[name=home]{
			background-color: #4169E1;
		}
		.button-group input[name=contact]{
			background-color: #FA8072;
		}
		.button-group input[name=buynow]{
			background-color: #3CB371;
		}
		.button-group a{
			text-decoration: none;
		}
		.card{
			background-color:  	#FFF;
			padding: 5%;
			box-shadow: 0px 0px 2px 1px rgba(0, 0, 0, 0.2);
			border-top-right-radius: 30px;
			min-height: 250px;
		}
		.card .details{
			text-align: left;
			font-size: 12px;
		}
		.card img{
			box-shadow: 0px 0px 2px 1px rgba(0, 0, 0, 0.1);
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
		.terms{
			font-size: 12px;
			color: grey;
		}
		.terms #termHead{
			font-size: 14px;
			color: red;
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
					<div class="product">
						<table>					
							<tr>
								<td width="50%">
									<div class="product-img">
									  <img class="mySlides" src="<?php echo $show1['img1']; ?>" height = "300">
									  <img class="mySlides" src="<?php echo $show1['img2']; ?>" height = "300">
									  <img class="mySlides" src="<?php echo $show1['img3']; ?>" height = "300">
									  <img class="mySlides" src="<?php echo $show1['img4']; ?>" height = "300">
									</div>
									Prev
									<button onclick="plusDivs(-1)">&#10094;</button>
									<button onclick="plusDivs(1)">&#10095;</button>
									Next
								</td>
								<td width="50%" valign="top" class="product-info">
									<h3><?php echo $show1['name']; ?></h3>
									<div class="info1">
										<p><b>Price: </b> <font color="red"><?php echo $show1['price']; ?> /-</font></p>
										<p><b>Description: </b><?php echo $show1['description']; ?></p>
										<p><b>Seller: </b><?php echo $show1['username']; ?></p>
										<p><b>Bill Available: </b><?php echo $show1['bill']; ?></p>
										<p><b>Product is in warrenty? : </b><?php echo $show1['warrenty']; ?></p>
										<p><b>Bargaining Available: </b><?php echo $show1['bargaining']; ?></p>
									</div>
								</td>
							</tr>
						</table>
						<div class="button-group">
							<input type="button" name="home" value="Back" onclick="goBack()">
							<a href="purchase.php?action=contact&pid=<?php echo $show1['id']; ?>"><input type="button" name="contact" value="Contact Seller"></a>
							<a href="purchase.php?action=buy&pid=<?php echo $show1['id']; ?>"><input type="button" name="buynow" value="Buy Now"></a>
						</div>
					

					<div class="terms" align="justify" style="padding: 1% 2% 1% 2%;">
						<p id="termHead">Terms And Conditions*</p><hr>
						<p>1.	The product related anything is seller’s responsibility, such as its quality, price or any kind of defects; these are did not concerned in our systems policy. One has to contact the seller itself for that.</p>
						<p>2.	You understand and agree that sending unsolicited email advertisements or other unsolicited communication to or from our systems is expressly prohibited by the term. Violations of such terms may subject the sender and his or her agents to civil and criminal penalties.</p>
						<p>3.	You agree not to post, email, host, display, upload, modify, publish, transmit, update or share any information on the site, or otherwise make available <br>	
						Content: <br>
						&nbsp;&nbsp;i.	that violates any law or regulation; <br>
						&nbsp;ii.	that is copyrighted or patented, protected by trade secret or trademark. <br>
						iii.	that infringes any of the foregoing intellectual property right of any party, or is content that you do not have a right to make available under any la, regulation, contractual relation(s). <br>
						iv.	that  is harmful, abusive, unlawful, threatening, harassing, pornographic, paedophilic, invasive of another’s privacy or rights.
						</p>
						<p>4.	Posting Agents: <br>
								&nbsp;&nbsp;&nbsp;&nbsp;As used herein, the term ‘Posting Agent’ refers to a third-party agent, service or intermediary that offers to post content to the service on behalf of others. We prohibit the use of Posting Agents, directly or indirectly.
						</p>
						<p>5.	These terms and the other policies posted on the platform constitute the complete and exclusive understanding and agreement between you and gettronics and govern your use of the services and the platform suspending all prior understandings, proposals, agreements, negotiations and discussions between the parties, whether oral or written.   </p>
					</div>


					</div>						
					<h3>Related to This Product</h3>
					<hr style="margin: 0 5% 0 5%">
					<table width="100%" cellspacing="10">
						<?php 
							$result = mysqli_query($conn, $_GLOBAL['sql1']);
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
												<span><font style="color:grey">Seller -</font> <?php echo $show['username']; ?></span><br>
												<span><font style="color:grey">Upload Date - </font></span><br>
											</div>
										</div>
									</td>
							<?php		
									}else{
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
								echo "<h6>No Product Found</h6>";
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
<script>
	var slideIndex = 1;
	showDivs(slideIndex);

	function plusDivs(n) {
	  showDivs(slideIndex += n);
	}

	function showDivs(n) {
	  var i;
	  var x = document.getElementsByClassName("mySlides");
	  if (n > x.length) {slideIndex = 1}
	  if (n < 1) {slideIndex = x.length}
	  for (i = 0; i < x.length; i++) {
	    x[i].style.display = "none";  
	  }
	  x[slideIndex-1].style.display = "block";  
	}

	function goBack() {
	  window.history.back();
	}
</script>