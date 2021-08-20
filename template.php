<?php  
	session_start();
	include "include/db.php";
	if (!empty($_SESSION['username'])) {
		$username = $_SESSION['username'];
	}else{
		$username = "demo";
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