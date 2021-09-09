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

	<title>Code Verification</title>
</head>
<body>
	<div class="container">
    <?php		
		if(isset($_POST['check-reset-otp'])){
			$check_reset_otp_code= $cs->check_reset_otp_code($_POST);
		}
		?>
	
		<form action="reset-code.html" method="POST" class="login-email" autocomplete="off">
			<p class="login-text" style="font-size: 1.5rem; font-weight: 600;">Code Verification</p>
            <?php 
                if(isset($check_reset_otp_code)){
                    echo $check_reset_otp_code;
                }
            ?>
			  
			<div class="input-group">
				<input type="number" name="otp"  placeholder="Enter your verification code" required>
			</div>

			<div class="input-group">
				<button id="btnResetCode" name="check-reset-otp" class="btn">Submit</button>
			</div>

			<?php 
                    if(isset($_SESSION['info'])){
                        ?>
                        <span style="color:green; font-weight:600;">
                            <?php echo $_SESSION['info']?>
						
					</span>
                        <?php
                    }
                    ?>
         
            <!-- <center><p class="login-register-text"><a href="login.html">Back to login.</a></p></center> -->
	
		</form>
	
	</div>


</body>
</html>