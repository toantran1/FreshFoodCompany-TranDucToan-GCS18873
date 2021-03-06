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
<!DOCTYPE html>
<html>
<head>
<base href="http://localhost:81/website_mvc/"/>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

	<link rel="stylesheet" type="text/css" href="css/login.css">

	<title>Reset Password</title>
</head>
<body>
	
	<div class="container">
		<?php
		
		if(isset($_POST['check-email'])){
			$check_email= $cs->check_email($_POST);
		}
		?>
	
		<form action="forgotpassword.php" method="POST" class="login-email" autocomplete="">
			<p class="login-text" style="font-size: 1.5rem; font-weight: 600;">Enter your e-mail to reset password</p>
			<?php
                       if(isset($check_email)){
						   echo $check_email;
					   }
                    ?>

					
                 

			<div class="input-group">
				<input type="email" name="email"  placeholder="Enter your email..." required >
			</div>

			<div class="input-group">
				<button name="check-email" class="btn">Continue</button>
			</div>

            <center><p class="login-register-text"><a href="login.html">Back to login.</a></p></center>
	
		</form>
	
	</div>
</body>
</html>