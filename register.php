<?php //===========================TEST========================================
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
  //=======================================================================
?>


<?php
   $login_check = Session:: get('customer_login');
   if($login_check){
	   header('Location: order.html');
   }
?>
<?php
// $cs = new customer();

if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])){
  
    $insertCustomers = $cs->insert_customers($_POST) ;
}
?>

<!-- <?php
if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])){
  
    $login_Customers = $cs->login_customers($_POST) ;
}
?> -->

<!DOCTYPE html>
<html>
<head>
<base href="http://localhost:81/website_mvc/"/>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

	<link rel="stylesheet" type="text/css" href="css/login.css">

	<title>Register</title>
</head>
<body>
	<div class="container">
            <?php
			if(isset($insertCustomers)){
				echo $insertCustomers;
			}
			?>
		<form action="register.html" method="POST" class="login-email">
            <p class="login-text" style="font-size: 2rem; font-weight: 800;">Register</p>
			<div class="input-group">
            <input type="text" name="name" placeholder="Enter name..." required>
			</div>
			<div class="input-group">
            <input type="text" name="city"  placeholder="Enter city..." required>
			</div>
			<div class="input-group">
            <input type="text" name="zipcode"  placeholder="Enter Zip-code..." required>
            </div>
            <div class="input-group">
            <input type="email" name="email"  placeholder="Enter your Email..." required>
			</div>
            <div class="input-group">
            <input type="text" name="address"  placeholder="Enter your address..." required>
			</div>
            <div class="input-group">
            <select id="country" name="country" onchange="change_country(this.value)" class="frm-field required">
							<option value="null">----Select a Country----</option>      

							
							<option value="hcm">Tp.Ho Chi Minh</option>
							<option value="vt">Vung Tau</option>
							<option value="la">Long An</option>
							<option value="DKLK">Dak Lak</option>
							<option value="KT">Kon Tum</option>
							

		         </select>
			</div>
            <div class="input-group">
            <input type="text" name="phone" placeholder="Enter your phone number..." required>
			</div>
		
            <div class="input-group">
            <input type="text" name="password" placeholder="Enter your password..." required>
			</div>
			<div class="input-group">
				<button name="submit" class="btn">Register</button>
			</div>
			<p class="login-register-text">Have an account? <a href="login.html">Login Here</a>.</p>
		</form>
	</div>
</body>
</html>