<?php  
	session_start();
	include "include/db.php";
	
	$username = $email = $mobile = $password = $cpassword = "";
	$usernameErr = $emailErr = $mobileErr = $passwordErr = $cpasswordErr = "";

	if ($_SERVER["REQUEST_METHOD"] = "POST") {
		if (isset($_POST["submit"])) {
			//username
			if(empty($_POST['username'])){
				$usernameErr = "Please enter the username";
			}else{
				$username = test_input($_POST['username']);
				if(!(preg_match('/^\w{6,}$/', $username))){
					$usernameErr = "Username must contains alphanumeric characters and atleast 6 character long";
				}else{
					$sql = "SELECT * FROM `user` WHERE `username`= '$username' ";
					$result = mysqli_query($conn, $sql);
					if(mysqli_num_rows($result) > 0){
						$usernameErr = "Sorry, username is already taken try by another..";
					}
				}
			}
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
				$mobileErr = "Enter your mobile number";
			}else{
				$mobile = test_input($_POST['mobile']);
				if(!preg_match("/^[0-9]{10}+$/", $mobile)){
					$mobileErr = "Invalid mobile number";
				}
			}
			//password
			if(empty($_POST['password'])){
				$passwordErr = "Please enter your password";
			}else{
				$password = test_input($_POST['password']);
				if(!preg_match('/^(?=.*\d)(?=.*[A-Za-z])[0-9A-Za-z!@#$%]{8,}$/', $password)){
					$passwordErr = "Password must contains one letter, one symbol, one number and atleast 8 character long!! ";
				}
			}
			//confirm password
			if(empty($_POST['cpassword'])){
				$cpasswordErr = "Please enter your password again.";
			}else{
				$cpassword = test_input($_POST['cpassword']);
				if($password != $cpassword){
					$cpasswordErr = "Password do not match!!";
				}
			}

			if (($usernameErr == "") && ($emailErr == "") && ($mobileErr == "") && ($passwordErr == "") && ($cpasswordErr == "")) {
				

				mkdir('users/'.$username);
				mkdir('users/'.$username.'/products/');
				copy("media/profile.png", "users/".$username.'/profile.png'); 

				$sql = "INSERT INTO `user`(`username`, `email`, `mobile`, `password`) VALUES ('$username', '$email', '$mobile', '$password')";
				mysqli_query($conn, $sql);
				$_SESSION['username'] = $username;
				header("location: index.php");
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
		.main-table{
			margin: 3% 0 3% 0;
		}
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
		.login-form input[type=password]{
			width: 70%;
			height: 30px;
			border:none;;
			border-bottom: 2px solid grey;
			background-color: #F5F5DC;
			padding: 0 0 0 3%;
		}
		.login-form input[type=reset],
		.login-form input[type=submit]{
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
						<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
							<h2>S I G N &nbsp; U P</h2>
							<table cellspacing="0" cellpadding="0">
								<tr>
									<td align="right" width="40%"><label>User-name</label></td>
									<td align="left" ><input type="text" name="username"></td>
								</tr>
								<tr>
									<td colspan="2" class="error">
										<?php echo $usernameErr; ?>
									</td>
								</tr>
								<tr>
									<td align="right" width="40%"><label>Email</label></td>
									<td align="left" ><input type="text" name="email"></td>
								</tr>
								<tr>
									<td colspan="2" class="error">
										<?php echo $emailErr; ?>
									</td>
								</tr>
								<tr>
									<td align="right" width="40%"><label>Mobile Number</label></td>
									<td align="left" ><input type="text" name="mobile" onkeypress="return isNumber(event)"></td>
								</tr>
								<tr>
									<td colspan="2" class="error">
										<?php echo $mobileErr; ?>
									</td>
								</tr>
								<tr>
									<td align="right" width="40%"><label>Password</label></td>
									<td align="left"><input type="password" name="password"></td>
								</tr>
								<tr>
									<td colspan="2" class="error">
										<?php echo $passwordErr; ?>
									</td>
								</tr>
								<tr>
									<td align="right" width="40%"><label>Confirm-Password</label></td>
									<td align="left"><input type="password" name="cpassword"></td>
								</tr>
								<tr>
									<td colspan="2" class="error">
										<?php echo $cpasswordErr; ?>
									</td>
								</tr>
								<tr>
									<td align="right" width="40%"></td>
									<td align="left">
										<input type="reset" name="reset" value="Clear">
										<input type="submit" name="submit" value="Sign Up">
									</td>
								</tr>
								<tr>
									<td colspan="2">
										Already Have an Account --> <a href="index.php">Login Here</a>
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
</script>