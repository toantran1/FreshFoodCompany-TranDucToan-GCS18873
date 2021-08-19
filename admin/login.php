<?php
include '../classes/adminlogin.php';
?>

<?php
$class = new adminlogin();
 if($_SERVER['REQUEST_METHOD'] === 'POST'){
	 $adminUser = $_POST['adminUser'];
	 $adminPass = md5($_POST['adminPass']);

	 $login_check = $class->login_admin($adminUser, $adminPass) ;
 }
?>
<!-- <!DOCTYPE html>
<head>
<meta charset="utf-8">
<title>Login</title>
    <link rel="stylesheet" type="text/css" href="css/stylelogin.css" media="screen" />
</head>
<body>
<div class="container">
	<section id="content">
		<form action="login.php" method="post">
			<h1>Admin Login</h1>
			<span><?php
			if(isset($login_check)){
				echo $login_check;
			}
			?>
			</span>
			<div>
				<input type="text" placeholder="Username"  name="adminUser"/>
			</div>
			<div>
				<input type="password" placeholder="Password"  name="adminPass"/>
			</div>
			<div>
				<input type="submit" value="Log in" />
			</div>
		</form>
		<div class="button">
			<a href="../index.php">Fresh Food Company</a>
		</div>
	</section>
</div>
</body>
</html> -->





<!DOCTYPE html>
<html lang="en">
	
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="css/login.css" media="screen" />
	<link rel="stylesheet" type="text/css" href="../css/login.css">
	<title>Admin Login</title>
</head>
<body>
<form action="login.php" method="post">
  <h1>ADMIN LOGIN</h1>
  <?php
			if(isset($login_check)){
				echo $login_check;
			}
			?>
  <div class="inset">
  <p>
    <label for="email">ADMIN</label>
    <input type="text" name="adminUser" placeholder="Username">
  </p>
  <p>
    <label for="password">PASSWORD</label>
    <input type="password" name="adminPass" placeholder="Password" >
  </p>
  <!-- <p>
    <input type="checkbox" name="remember" id="remember">
    <label for="remember">Remember me for 14 days</label>
  </p> -->
  </div>
  <p class="p-container">
    <span><a href="#">Forgot password?</a></span>
    <input type="submit" value="Log in" />
  </p>
  <p class="p-container">
  <center><p class="fresh_food"><a href="../index.php">Fresh Food Company</a></p></center>
  </p>
</form>
</body>
</html>