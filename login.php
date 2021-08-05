<?php
//include 'inc/header.php';
//include 'inc/slider.php';
?>

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
	   header('Location: order.php');
   }
?>
<?php
// $cs = new customer();

if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])){
  
    $insertCustomers = $cs->insert_customers($_POST) ;
}
?>

<?php
if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])){
  
    $login_Customers = $cs->login_customers($_POST) ;
}
?>


 <!-- <div class="main">
    <div class="content">
    	 <div class="login_panel">
        	<h3>Existing Customers</h3>
        	<p>Sign in with the form below.</p>
			<?php
				if(isset($login_Customers)){
					echo $login_Customers;
				}
			?>
        	<form action="" method="POST">
                	<input type="text" name="email" class="field" placeholder="Enter your email...">
                    <input type="password" name="password" class="field" placeholder="Enter your password...">
                 
                 <p class="note">If you forgot your passoword just enter your email and click <a href="#">here</a></p>
                    <div class="buttons"><div><input type="submit" name="login" class="grey" value="Sign In"></div></div>
			</form>
        </div>
		<?php
		
		?>

    	<div class="register_account">
    		<h3>Register New Account</h3>
			<?php
			if(isset($insertCustomers)){
				echo $insertCustomers;
			}
			?>
    		<form action="" method="POST">
		   			 <table>
		   				<tbody>
						<tr>
						<td>
							<div>
							<input type="text" name="name" placeholder="Enter name..." >
							</div>
							
							<div>
							   <input type="text" name="city"  placeholder="Enter city...">
							</div>
							
							<div>
								<input type="text" name="zipcode"  placeholder="Enter Zip-code...">
							</div>
							<div>
								<input type="text" name="email"  placeholder="Enter your Email...">
							</div>
		    			 </td>
		    			<td>
						<div>
							<input type="text" name="address"  placeholder="Enter your address...">
						</div>
		    		<div>
						<select id="country" name="country" onchange="change_country(this.value)" class="frm-field required">
							<option value="null">Select a Country</option>      

							
							<option value="hcm">Tp.Ho Chi Minh</option>
							<option value="vt">Vung Tau</option>
							<option value="la">Long An</option>
							<option value="DKLK">Dak Lak</option>
							<option value="KT">Kon Tum</option>
							

		         </select>
				 </div>		        
	
		           <div>
		          <input type="text" name="phone" placeholder="Enter your phone number...">
		          </div>
				  
				  <div>
					<input type="text" name="password" placeholder="Enter your password...">
				</div>
		    	</td>
		    </tr> 
		    </tbody></table> 
		   <div class="search"><div><input type="submit" name="submit" class="grey" value="Create Account"></div></div>

		    <p class="terms">By clicking 'Create Account' you agree to the <a href="#">Terms &amp; Conditions</a>.</p>
		    <div class="clear"></div>
		    </form>
    	</div>  	
       <div class="clear"></div>
    </div>
 </div> -->

 <!-- <?php
 include 'inc/footer.php';
 ?> -->


<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

	<link rel="stylesheet" type="text/css" href="css/login.css">

	<title>Login</title>
</head>
<body>
	<div class="container">
		
	
		<form action="" method="POST" class="login-email">
			<p class="login-text" style="font-size: 2rem; font-weight: 800;">Login</p>
			<div class="input-group">
				<input type="email" name="email"  placeholder="Enter your email..." required>
			</div>
			<div class="input-group">
				<input type="password" name="password" placeholder="Enter your password..." required>
			</div>
			<div class="input-group">
				<button name="login" class="btn">Login</button>
			</div>
			<p class="login-register-text">Don't have an account? <a href="register.php">Register Here</a>.</p>
			<p class="login-register-text"><a href="forgotpassword.php">Forgot Password?</a></p>
		</form>
		<?php
				if(isset($login_Customers)){
					echo $login_Customers;
				}
			?>
	</div>
</body>
</html>