<?php  
	session_start();
	include "include/db.php";
?>
<!DOCTYPE html>
<html lang="en-us">
<head>
	<title>HOME - gettronics</title>
	<link rel="shortcut icon" href="media/fc.png">
	<link rel="stylesheet" type="text/css" href="include/style.css">
	<meta charset="utf-8">
	<style type="text/css">
		h1{
			color: grey;
			font-size: 30px;
		}
		p{
			text-align: justify;
			font-size: 18px;
			color: #333;
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
				<td width="85%" id="main" valign="top">
					<!-- Main Content -->
					<h1>About gettronics</h1>
					<table>
						<td width="20%"></td>
						<td width="40%">
							<p>&nbsp;&nbsp;&nbsp;&nbsp;We know that in India quantity of e-waste is much larger which is quite an issue, and it is most rapidly growing segment of the formal municipal waste stream in the world. E-waste or Waste Electrical and Electronic Equipments (WEEE) are loosely discarded, surplus, obsolete, broken, or mostly used devices.</p>

							<p>&nbsp;&nbsp;&nbsp;&nbsp;People generally do not know how to discard these things, so it becomes waste. Due to this balance of nature is getting worse and worse by each day. So we are providing this web system for trading electrical or electronics equipments, so we can contribute some for nature.</p>

							<p>&nbsp;&nbsp;&nbsp;&nbsp;The system we designed is a web based application. It includes selling and buying of electronic devices such as mobile phones, computer, laptops, accessories, home appliances, and other items. User have to create a login to trade things. In login phone number will be provided so that buyer and seller can communicate. You’ll get to search the products as per your wish, prices, requirement etc. </p>
						</td>
						<td width="15%"></td>
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