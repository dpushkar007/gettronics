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
			font-size: 30px;
			color: grey;
		}
		.developers tr:nth-child(odd){
			background: 	#FFE4C4;
		}
		.developers tr:nth-child(even){
			background: 	#E9967A;
		}
		th{
			padding:1%;
			background-color: grey;
		}
		.developers td{
			padding:1%;
		}
		#main img{
			width: 100px;
			height:100px;
			border-radius: 100px;
			border: 1px solid #333;
			padding: 0.5%;
			background-color: #fff;
			margin: 0 1% 2% 1%;
			box-shadow: 0 0 10px 1px rgba(0,0,0,0.5);
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
					<h1>Developers</h1>
					<img src="media/profile.png">
					<img src="media/profile.png">
					<img src="media/profile.png">
					<img src="media/profile.png">
					<table class="developers">
						<tr>
							<th>Sr no.</th>
							<th>Developer's name</th>
							<th>Year</th>
							<th>Roll Number</th>
							<th>Email</th>
						</tr>
						<tr>
							<td>1</td>
							<td>Malave Prajakta P.</td>
							<td>SY B-TECH IT</td>
							<td>1854002</td>
							<td>malaveprajakta@gmail.com</td>
						</tr>
						<tr>
							<td>2</td>
							<td>More Priyanka S.</td>
							<td>SY B-TECH IT</td>
							<td>1854007</td>
							<td>priyankamore6409@gmail.com</td>
						</tr>
						<tr>
							<td>3</td>
							<td>Bhagat Pranjal E.</td>
							<td>SY B-TECH IT</td>
							<td>1854010</td>
							<td>pranjalbhagat1999@gmail.com</td>
						</tr>
						<tr>
							<td>4</td>
							<td>Kolekar Pranita A.</td>
							<td>SY B-TECH IT</td>
							<td>1854012</td>
							<td>pranitakolekar11@gmail.com</td>
						</tr>
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