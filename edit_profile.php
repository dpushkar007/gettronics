<?php  
	session_start();
	include "include/db.php";
	if (empty($_SESSION['username'])) {
		header('location: index.php');
	}

	$email = $mobile = $address = $pincode = $profile = "";
	$emailErr = $mobileErr = $addressErr = $pincodeErr = $profileErr = "";

	if (!empty($_SESSION['username'])) {
		$username = $_SESSION['username'];
	}else{
		header('location: index.php');
	}

	$sql = "SELECT * FROM user WHERE `username` = '$username'";
	$result = mysqli_query($conn, $sql);
	$show = mysqli_fetch_array($result);
	$email = $show['email'];
	$mobile = $show['mobile'];
	$address = $show['address'];
	$pincode = $show['pincode'];
	$profile = "users/".$username."/profile.png";


	if ($_SERVER["REQUEST_METHOD"] = "POST") {
		if (isset($_POST["submit"])) {
			//email
			if(empty($_POST['email'])){
				$emailErr = "Enter your email";
			}else{
				$email = test_input($_POST['email']);
				if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
					$emailErr = "Invalid email format";
				}
			}
			//mobile
			if (empty($_POST['mobile'])) {
				$mobileErr = "Enter your mobile number number";
			}else{
				$mobile = test_input($_POST['mobile']);
				if(!preg_match("/^[0-9]{10}+$/", $mobile)){
					$mobileErr = "Invalid mobile number";
				}
			}
			//address
			if (empty($_POST['address'])) {
				$addressErr = "Enter Address";
			}else{
				$address = test_input($_POST['address']);
			}
			//pincode
			if (empty($_POST['pincode'])) {
				$pincodeErr = "Enter your pincode number";
			}else{
				$pincode = test_input($_POST['pincode']);
				if(!preg_match("/^[0-9]{5,6}+$/", $pincode)){
					$pincodeErr = "Invalid pincode";
				}
			}
			
			//declaring and initializing some variables
			$file_name = $_FILES['profileUpload']['name'];
			$file_size =$_FILES['profileUpload']['size'];
			$file_tmp =$_FILES['profileUpload']['tmp_name'];
			$file_type=$_FILES['profileUpload']['type'];
			$file_ext=strtolower(end(explode('.',$_FILES['profileUpload']['name'])));

			if (($emailErr == "") && ($mobileErr == "") && ($addressErr == "") && ($pincodeErr == "")) {

				move_uploaded_file($file_tmp,"users/".$username."/".$file_name);
				rename( "users/".$username."/".$file_name, "users/".$username."/profile.png");

				$sql = "UPDATE `user` SET `email`='$email',`mobile`='$mobile',`address`='$address',`pincode`='$pincode' WHERE `username` = '$username'";
				mysqli_query($conn, $sql);
				header('location: index.php');
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
	<script src="include/jquery.min.js"></script>
	<meta charset="utf-8">
	<style type="text/css">
		#login{
			text-align: center;
			background-image: url("media/main.png");
			padding: 3% 0 3% 0;
		}
		.login-form{
			background-color: white;
			box-shadow: 0 0 15px 1px rgba(0,0,0,0.1);
			border-radius: 5px;
			padding: 3% 0 3% 0;
		}
		.login-form td{
			padding: 1% 0 0 0;
		}
		.login-form label{
			background-color: #333;
			color:#fff;
			padding: 4%;
		}
		.login-form input[type=text],
		.login-form input[type=password],
		.login-form textarea{
			width: 70%;
			height: 30px;
			border:none;;
			border-bottom: 2px solid grey;
			background-color: #F5F5DC;
			padding: 0 0 0 3%;
		}
		.login-form textarea{
			min-height: 100px;
		}
		.login-form input[type=reset],
		.login-form input[type=submit],
		.login-form input[type=button]{
			min-width: 100px;
			height: 30px;
			border-radius: 30px;
			border:none;
			color: #fff;
		}
		.login-form input[type=reset]{
			background-color:  	#8B0000;
		}
		.login-form input[type=submit]{
			background-color:  	#228B22;
		}
		.login-form input[type=button]{
			background-color:  	#1E90FF;
		}
		.login-form a{
			border-bottom: 1px solid darkblue;
			color: darkblue;
		}
		.login-form img{
			border-radius: 100px;
			border:5px solid #333;
			width: 100px;
			padding: 1%;
		}
	</style>
</head>
<body>
	<header>
		<?php include "include/header.html"; ?>
	</header>
	<section>
		<div id="login">
			<table class="main-table" width="100%" cellspacing="0" cellpadding="0">
				<tr>
					<td width="30%"></td>
					<td width="40%" class="login-form">
						<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
							<h2>U P D A T E &nbsp; P R O F I L E</h2>
							<h4><?php echo "Hello - ".$_SESSION['username']; ?></h4>
							<table cellspacing="0" cellpadding="0">
								<tr>
									<td colspan="2">
										<img id="profilepic" src="<?php echo $profile; ?>" height="100" class="profilepic"><br>
										<input type="file" id="profileUpload" name="profileUpload" accept="image/*" style="display:none;"/> 
										<a id="openProfileUpload">change profile picture</a><br><br>
									</td>
								</tr>
								<tr>
									<td align="right" width="40%"><label>Email</label></td>
									<td align="left" ><input type="text" name="email" value="<?php echo $email; ?>"></td>
								</tr>
								<tr>
									<td colspan="2" class="error">
										<?php echo $emailErr; ?>
									</td>
								</tr>
								<tr>
									<td align="right" width="40%"><label>Mobile Number</label></td>
									<td align="left" ><input type="text" name="mobile" onkeypress="return isNumber(event)" value="<?php echo $mobile; ?>"></td>
								</tr>
								<tr>
									<td colspan="2" class="error">
										<?php echo $mobileErr; ?>
									</td>
								</tr>
								<tr>
									<td align="right" width="40%"><label>Address</label></td>
									<td align="left" ><textarea name="address"><?php echo $address; ?></textarea></td>
								</tr>
								<tr>
									<td colspan="2" class="error">
										<?php echo $addressErr; ?>
									</td>
								</tr>
								<tr>
									<td align="right" width="40%"><label>Pincode</label></td>
									<td align="left" ><input type="text" maxlength="6" name="pincode" onkeypress="return isNumber(event)" value="<?php echo $pincode; ?>"></td>
								</tr>
								<tr>
									<td colspan="2" class="error">
										<?php echo $pincodeErr; ?>
									</td>
								</tr>
								
								<tr>
									<td align="right" width="40%" style="padding-right: 1%;">
										<a href="index.php" style="text-decoration: none;"><input type="button" name="back" value="Back"></a>
									</td>
									<td align="left">
										<input type="reset" name="reset" value="Clear">
										<input type="submit" name="submit" value="Update">
									</td>
								</tr>
							</table>
						</form>
					</td>
					<td width="30%"></td>
				</tr>
			</table>
		</div>
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
		if (charCode > 31 && (charCode < 48 || charCode > 57)) {
			return false;
		}
		return true;
	}
	

	$(document).ready(function() {
	    var readURL = function(input) {
	        if (input.files && input.files[0]) {
	            var reader = new FileReader();

	            reader.onload = function (e) {
	                $('#profilepic').attr('src', e.target.result);
	            }
	    
	            reader.readAsDataURL(input.files[0]);
	        }
	    }
	    

	    $("#profileUpload").on('change', function(){
	        readURL(this);
	    });
	    
	    $("#openProfileUpload").on('click', function() {
	       $("#profileUpload").click();
	    });
	});
</script>