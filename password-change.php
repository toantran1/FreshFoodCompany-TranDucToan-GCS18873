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
$email = Session::get('email');
if($email == false){
  header('Location: login.html');
}
?>
<?php
if($_SESSION['info'] == false){
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
  <center><img src="images/success_icon.png" alt="" width ="150px"></center>
        
	
		<form action="password-change.html" method="POST">
    <?php 
            if(isset($_SESSION['info'])){
            
             ?>
             <center style="font-weight:600;">
               <?php
               echo $_SESSION['info'];
                ?>

             </center>
            <?php
            }
            ?>
        
	 <center><p class="login-register-text"><a href="login.html">Back to login.</a></p></center>
            
	
		</form>
	
	</div>
</body>
</html>