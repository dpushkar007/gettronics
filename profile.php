<?php 
	$username = $password = "";
	$error="";
	/*if (empty($_SESSION['username'])) {
		header('location: index.php');
	}*/

	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		if (isset($_POST['login'])) {
			$username = $_POST['username'];
			$password = $_POST['password'];

			$sql = "SELECT * FROM user WHERE `username` = '$username' AND `password` = '$password'";
			$result = mysqli_query($conn,$sql);
			if (mysqli_num_rows($result) > 0) {
			}else{
				$error = "Invalid Credentials";
			}
			if ($error == "") {
				$_SESSION['username'] = $username;
				header('location:index.php');
			}
			
		}
		if (isset($_POST['logout'])) {
			unset($_SESSION['username']);
			header('location:index.php');
		}
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<style type="text/css">
		#profile{
			background-color: #333;
			color:#fff;
			text-align: center;
		}
		#profile form{
			margin: 2% 0 10% 0;
		}
		#profile input[type=text],
		#profile input[type=password]{
			width: 90%;
			min-height: 20px;
			border:1px solid grey;
			border-radius: 3px;
			padding: 1% 1% 1% 3%;
		}
		#profile input[type=submit],
		#profile input[type=reset]{
			width: 40%;
			margin: 5% 0 5% 0;
			min-height: 20px;
			border:none;;
			border-radius: 30px;
			padding: 2% 0 2% 0
		}
		#profile input[type=submit]{
			background-color:  	#32CD32;
			color:#fff;
		}
		#profile .logout input{
			width: 90%;
			padding: 3%;
			min-height: 30px;
			border-radius: 30px;
			border:none;
			color: white;
		}
		#profile .profilepic{
			border-radius: 100px;
		}
		#profile .logout input[type=submit]{
			background-color: #696969;
		}
		#profile .logout input[type=button]{
			background-color: #4169E1;
		}
		#profile input[type=reset]{
			background-color:  	#CD5C5C;
			color:#fff;
		}
		#profile .forgot{
			font-size: 14px;
		}
		#profile .forgot a{
			text-decoration: none;
			color: #e75480;
		}
		#profile .info{
			padding: 2%;
			font-size: 12px;
			text-align: left;
		}
		#profile .info td{
			vertical-align: top;
			border-bottom: 1px solid grey;
		}
	</style>
</head>
<body>
	<?php if (empty($_SESSION['username'])) { ?>
		<h1>L O G I N</h1>
		<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
			<span>user-name</span>
			<input type="text" name="username">
			<span>password</span>
			<input type="password" name="password">
			<span class="error"><?php echo $error; ?></span>
			<input type="reset" name="reset" value="clear">
			<input type="submit" name="login" value="login">
			<br>
			<span class="forgot">
				<a href="#">[ Forgot Passowrd ]</a><br>
				--NEW USER-- 
				<a href="signup.php"><br>Register Here</a>
			</span>
		</form>
	<?php }else{ 
			$user = $_SESSION['username'];
			$sql = "SELECT * FROM user WHERE `username` = '$user'";
			$result = mysqli_query($conn, $sql);
			$show = mysqli_fetch_array($result);
			$profile = "users/".$user."/profile.png";
		?>
		<img src="<?php echo $profile; ?>" height="100" width = "100" class="profilepic">
		<p>Hello, <b><?php echo $show['username']; ?></b></p>
		<div class="info">
			<table cellpadding="1">
				<tr>
					<td>Email:</td>
					<td width="10%"><?php echo $show['email']; ?></td>
				</tr>
				<tr>
					<td>Mobile No:</td>
					<td><?php echo $show['mobile']; ?></td>
				</tr>
				<tr>
					<td>Address:</td>
					<td><?php echo $show['address']; ?></td>
				</tr>
				<tr>
					<td>Pin Code:</td>
					<td><?php echo $show['pincode']; ?></td>
				</tr>
			</table>
		</div>
		
		<table class="logout">
			<tr>
				<form method="POST" action="">
					<td width="50%">
						<input type="submit" name="logout" value="Log Out">	
					</td>
					<td width="50%">
						<input type="button" name="edit" value="Edit Profile" onclick="location.href = 'edit_profile.php';">
					</td>
				</form>
			</tr>
		</table>

	<?php	
	} ?>
					
</body>
</html>