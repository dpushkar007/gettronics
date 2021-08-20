<?php  
	session_start();
	include "include/db.php";
	if (empty($_SESSION['username'])) {
		header('location: index.php');
	}

	$pname = $pdescription = $pprice = $pfile1 = $pfile2 = $pfile3 = $pfile4 = $pbill = $pwarrenty = $pused = $pbargain = $pcat = "";
	$pnameErr = $pdescriptionErr = $ppriceErr = $pfile1Err = $pfile2Err = $pfile3Err = $pfile4Err = $pbillErr = $pwarrentyErr = $pusedErr = $pbargainErr = $pcatErr = "";

	$path1 = $path2 = $path3 = $path4 = "";
	if ($_SERVER["REQUEST_METHOD"] == "POST"){
		if (isset($_POST['sell'])) {

			//product name
			if (empty($_POST['pname'])) {
				$pnameErr = "Enter product name";
			}else{
				$pname = test_input($_POST['pname']);
				if(!preg_match("/[a-zA-Z']/",$pname)){
					$pnameErr = "Name must contains alphabets only.";
				}
			}
			//product description
			if (empty($_POST['pdescription'])) {
				$pdescriptionErr = "Enter product description";
			}else{
				$pdescription = test_input($_POST['pdescription']);
			}
			//product price
			if (empty($_POST['pprice'])) {
				$ppriceErr = "Enter price";
			}else{
				$pprice = test_input($_POST['pprice']);
			}
			//product bill
			if (empty($_POST['pbill'])) {
				$pbillErr = "Choose correct one";
			}else{
				$pbill = $_POST['pbill'];
			}
			//product warrenty
			if (empty($_POST['pwarrenty'])) {
				$pwarrentyErr = "Choose correct one";
			}else{
				$pwarrenty = $_POST['pwarrenty'];
			}
			//product used
			if ($_POST['pused'] == 0) {
				$pusedErr = "Select one option";
			}else{
				$pused = $_POST['pused'];
			}
			//product category
			if ($_POST['pcat'] == "") {
				$pcatErr = "Select one option";
			}else{
				$pcat = $_POST['pcat'];
			}
			//product bargaining
			if (empty($_POST['pbargain'])) {
				$pbargainErr = "Choose correct one";
			}else{
				$pbargain = $_POST['pbargain'];
			}

			if ($_FILES['pfile1']['name'] == "") {
				$pfile1Err ="Selecting this is mandatory";
			}else{
				$pfile1 = $_FILES['pfile1']['name'];
				$file_size1 =$_FILES['pfile1']['size'];
				$file_tmp1 =$_FILES['pfile1']['tmp_name'];
				$file_type1=$_FILES['pfile1']['type'];
				$file_ext1=strtolower(pathinfo($pfile1, PATHINFO_EXTENSION));
				$path1 = "users/".$_SESSION['username']."/products/".$pfile1;
			}
			if ($_FILES['pfile2']['name'] == "") {
				$pfile2Err ="Selecting this is mandatory";
			}else{
				$pfile2 = $_FILES['pfile2']['name'];
				$file_size2 =$_FILES['pfile2']['size'];
				$file_tmp2 =$_FILES['pfile2']['tmp_name'];
				$file_type2=$_FILES['pfile2']['type'];
				$file_ext2=strtolower(pathinfo($pfile2, PATHINFO_EXTENSION));
				$path2 = "users/".$_SESSION['username']."/products/".$pfile2;
			}
			if ($_FILES['pfile3']['name'] != "") {
				$pfile3 = $_FILES['pfile3']['name'];
				$file_size3 =$_FILES['pfile3']['size'];
				$file_tmp3=$_FILES['pfile3']['tmp_name'];
				$file_type4=$_FILES['pfile3']['type'];
				$file_ext3=strtolower(pathinfo($pfile3, PATHINFO_EXTENSION));
				$path3 = "users/".$_SESSION['username']."/products/".$pfile3;
			}
			if ($_FILES['pfile4']['name'] != "") {
				$pfile4 = $_FILES['pfile4']['name'];
				$file_size4 =$_FILES['pfile4']['size'];
				$file_tmp4 =$_FILES['pfile4']['tmp_name'];
				$file_type4=$_FILES['pfile4']['type'];
				$file_ext4=strtolower(pathinfo($pfile4, PATHINFO_EXTENSION));
				$path4 = "users/".$_SESSION['username']."/products/".$pfile4;
			}
			
			if (($pnameErr == "") && ($pdescriptionErr == "") && ($ppriceErr == "") && ($pfile1Err == "") && ($pfile2Err == "") && ($pbillErr == "") && ($pwarrentyErr == "") && ($pusedErr == "") && ($pbargainErr == "") && ($pcatErr == "")) {
				$username = $_SESSION['username'];
				move_uploaded_file($file_tmp1,$path1);
				move_uploaded_file($file_tmp2,$path2);
				move_uploaded_file($file_tmp3,$path3);
				move_uploaded_file($file_tmp4,$path4);


				$sql = "INSERT INTO `product`(`username`, `name`, `description`, `price`, `img1`, `img2`, `img3`, `img4`, `bill`, `warrenty`, `used`, `category`, `bargaining`) VALUES ('$username','$pname','$pdescription','$pprice','$path1','$path2','$path3','$path4','$pbill','$pwarrenty','$pused','$pcat','$pbargain')";
				mysqli_query($conn, $sql);
				header('location: index.php');
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
	function test_input($data){
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
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
		#link{
			padding: 2% 0 2% 0;
			min-width: 100px;
			background-color:  #CD5C5C;
			min-width: 70%;
			margin: -3px 15% 0 15%;
			z-index: 20;
		}
		#link a{
			text-decoration: none;
			color: white;
			font-size: 14px;
		}
		.nav{
			background-color: #333;
			color:#fff;
			text-align: center;
			margin-bottom: 2px;
			padding: 5% 0 5% 0;
		}
		.sell{
			padding: 0 10% 0 10%;
			font-size: 14px;
		}
		.sell h2{
			color: grey;
			font-size: 24px;
		}
		.sell #left{
			width: 40%;
			background-color:  	 	#87CEFA;
			border-right: 2px solid blue;
			text-align: right;
			padding: 1% 2% 1% 1%;
		}
		.sell #right{
			width: 60%;
			text-align: left;
		}
		.sell #right input[type=text],
		.sell #right textarea,
		.sell #right select,
		.sell #right input[type=file]{
			width: 100%;
			min-height: 20px;
			border:1px solid #87CEFA;
			padding: 2%;
			background-color: #F5F5F5;
		}
		.sell #right input[type=reset],
		.sell #right input[type=submit]{
			width: 100px;
			padding: 2%;
			border-radius: 30px;
			border:none;
			color: white;
		}
		.sell #right input[type=reset]{
			background-color: #DC143C;
		}
		.sell #right input[type=submit]{
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
					<div width="100%" class="sell">
						<form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" enctype="multipart/form-data">
							<h2>Add your product details</h2>
							<table cellspacing="7">
								<tr>
									<td id="left">
										Product Name
									</td>
									<td id="right">
										<input type="text" name="pname">
										<span class="error"><?php echo $pnameErr; ?></span>
									</td>
								</tr>
								<tr>
									<td id="left">
										Product Description
									</td>
									<td id="right">
										<textarea name="pdescription"></textarea>
										<span class="error"><?php echo $pdescriptionErr; ?></span>
									</td>
								</tr>
								<tr>
									<td id="left">
										Price
									</td>
									<td id="right">
										<input type="text" name="pprice" onkeypress="return isNumber(event)">
										<span class="error"><?php echo $ppriceErr; ?></span>
									</td>
								</tr>
								<tr>
									<td id="left">
										Upload Preview
									</td>
									<td id="right">
										<input type="file" name="pfile1" accept="image/*">
										<span class="error"><?php echo $pfile1Err; ?></span>
										<input type="file" name="pfile2" accept="image/*">
										<span class="error"><?php echo $pfile2Err; ?></span>
										<input type="file" name="pfile3" accept="image/*">
										<input type="file" name="pfile4" accept="image/*">
									</td>
								</tr>
								<tr>
									<td id="left">
										Bill Available?
									</td>
									<td id="right">
										<input type="radio" name="pbill" value="yes"> Yes 
										<input type="radio" name="pbill" value="no"> No 
										<span class="error"><?php echo $pbillErr; ?></span>
									</td>
								</tr>
								<tr>
									<td id="left">
										In Warranty?
									</td>
									<td id="right">
										<input type="radio" name="pwarrenty" value="yes"> Yes 
										<input type="radio" name="pwarrenty" value="no"> No 
										<span class="error"><?php echo $pwarrentyErr; ?></span>
									</td>
								</tr>
								<tr>
									<td id="left">
										Product Used
									</td>
									<td id="right">
										<select name="pused">
											<option value="0">------SELECT ONE------</option>
											<option value="1month">1 Month</option>
											<option value="2month">2 Month</option>
											<option value="6month">6 Month</option>
											<option value="1year">1 Year</option>
											<option value="2year">2 Year</option>
											<option value="more2year">More than 2 Year</option>
										</select>
										<span class="error"><?php echo $pusedErr; ?></span>
									</td>
								</tr>
								<tr>
									<td id="left">
										Product Categry
									</td>
									<td id="right">
										<select name="pcat">
											<option value="">------SELECT ONE------</option>
											<option value="mobile">Mobile</option>
											<option value="laptop">Laptop</option>
											<option value="pc">Personal Computer</option>
											<option value="accesories">Accessories</option>
											<option value="home">Home Appliances</option>
											<option value="other">Other</option>
										</select>
										<span class="error"><?php echo $pcatErr; ?></span>
									</td>
								</tr>
								<tr>
									<td id="left">
										Bargaining
									</td>
									<td id="right">
										<input type="radio" name="pbargain" value="yes"> Yes 
										<input type="radio" name="pbargain" value="no"> No 
										<span class="error"><?php echo $pbargainErr; ?></span>
									</td>
								</tr>
								<tr>
									<td></td>
									<td id="right">
										<input type="reset" name="reset" value="Reset">
										<input type="submit" name="sell" value="Sell Now">
									</td>
								</tr>
							</table>
						</form>
					</div>
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
<script type="text/javascript">
	function isNumber(evt) {
		evt = (evt) ? evt : window.event;
		var charCode = (evt.which) ? evt.which : evt.keyCode;
		if (charCode > 31 && (charCode < 48 || charCode > 57) && (charCode != 46)) {
			return false;
		}
		return true;
	}
</script>