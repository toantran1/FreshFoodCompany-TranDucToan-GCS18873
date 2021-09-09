<?php
//include 'inc/header.php';
//include 'inc/slider.php';
?>

<?php 
include 'lib/session.php';
Session::init();
?>
<?php
include_once 'lib/database.php';
include_once 'helpers/format.php';

spl_autoload_register(function($className){
	include_once "classes/".$className.".php";
});
$db = new Database();
$fm = new Format();
$ct = new cart();
$us = new user();
$cat = new category();
$cs = new customer();
$product = new product();
?>
<?php
  header("Cache-Control: no-cache, must-revalidate");
  header("Pragma: no-cache"); 
  header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); 
  header("Cache-Control: max-age=2592000");
  
?>
<?php 
$email = $_SESSION['email'];
if($email == false){
  header('Location: login.html');
}
?>
<!DOCTYPE html>
<html>
<head>
<base href="http://localhost:81/website_mvc/"/>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

	<link rel="stylesheet" type="text/css" href="css/login.css">

	<title>New Password</title>
</head>
<body>
	<div class="container">
    <?php
		$cs = new customer();
		if(isset($_POST['change-password'])){
			$change_password= $cs->change_password($_POST);
		}
		?>
	
		<form action="new-password.html" method="POST" class="login-email" autocomplete="off">
			<p class="login-text" style="font-size: 1.5rem; font-weight: 600;">Enter your new password</p>

            <?php 
                if(isset($change_password)){
                    echo $change_password;
                }
            ?>
			
			<div class="input-group">
				<input type="password" name="new_password"  placeholder="Enter your password..." required>
			</div>

            <div class="input-group">
				<input type="password" name="confirm_password"  placeholder="Confirm your password..." required>
			</div>

			<div class="input-group">
				<button name="change-password" class="btn">Continue</button>
			</div>
            
	
		</form>
	
	</div>
</body>
</html>