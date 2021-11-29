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
$paypal = new paypal();
?>
<?php
  header("Cache-Control: no-cache, must-revalidate");
  header("Pragma: no-cache"); 
  header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); 
  header("Cache-Control: max-age=2592000");
?>

<!DOCTYPE HTML>
<head>
<title>Fresh Food Company</title>
<base href="http://localhost:81/website_mvc/"/>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<link href="css/style.css" rel="stylesheet" type="text/css" media="all"/>
<link href="css/menu.css" rel="stylesheet" type="text/css" media="all"/>
<script src="js/jquerymain.js"></script>
<script src="js/script.js" type="text/javascript"></script>
<script type="text/javascript" src="js/jquery-1.7.2.min.js"></script> 
<script type="text/javascript" src="js/nav.js"></script>
<script type="text/javascript" src="js/move-top.js"></script>
<script type="text/javascript" src="js/easing.js"></script> 
<script type="text/javascript" src="js/nav-hover.js"></script>
<link href='http://fonts.googleapis.com/css?family=Monda' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Doppio+One' rel='stylesheet' type='text/css'>



<link href='https://fonts.googleapis.com/icon?family=Material+Icons' rel='stylesheet'>
<script type="text/javascript">
  $(document).ready(function($){
    $('#dc_mega-menu-orange').dcMegaMenu({rowItems:'4',speed:'fast',effect:'fade'});
  });
</script>

<div class="zalo-chat-widget" data-oaid="4200222155839716907" data-welcome-message="Welcome to Fresh Food Company. How can we support you?" data-autopopup="0" data-width="" data-height=""></div>

<script src="https://sp.zalo.me/plugins/sdk.js"></script>
</head>
<body>
  <div class="wrap">
		<div class="header_top">
			<div class="logo">
				<a href="index.html"><img src="images/logo1.png" alt="home" /></a>
			</div>
			  <div class="header_top_right">
				
			    <div class="search_box">
				    <form action="search.html" method="GET">
				    	<input type="text" placeholder="Search for products..." name="search_prod"><input type="submit" name="search_submit" value="SEARCH">
				    </form>
					
			    </div>
				
			    <div class="shopping_cart">
					<div class="cart">
						<a href="cart.php" title="View my shopping cart" rel="nofollow">
								<span class="cart_title">Cart</span>
								<span class="no_product">
								<?php
								$check_cart = $ct->check_cart();
								if($check_cart){
								$sum = Session::get("sum");
								$qty = Session::get("qty");
								echo $fm->format_currency($sum).' VND'.'-'.'Qty:'.$qty;
								}else{
									echo 'Empty';
								}
								?>
								</span>
							</a>
						</div>
			      </div>

				  <?php
				 	if(isset($_GET['customerid'])){
						 $customerid= $_GET['customerid'];
						 $delCart = $ct->del_all_data_cart();
						//  $delCompare = $ct->del_all_data_compare($customerid);
						 Session::destroy();
					 } 
				  ?>
		   <div class="login">
		   <?php
		   $login_check = Session:: get('customer_login');
	
		 
		   if($login_check == false){
			   echo '<a href="login.html">Login</a></div>';
		   } else{
				// Checking the time now when home page starts.
			    $now = time(); 
				

				if ($now >  $_SESSION['expire']) {
						
					session::destroy();
					
				}
			
				echo '<a href="?customerid='.Session::get("customer_id").'">Logout</a></div>';	
				// }else{
			       
				// }
		   }		   
		   ?>
		
		 <div class="clear"></div>
		 </div>
	 <div class="clear"></div>
	 <div class="float_right">
		
        <?php
	 	 $login_check = Session:: get('customer_login');
		  $check_name= Session:: get('customer_name');
		if($login_check == false){
			echo '';
		}else{
			
		?>  
		<div class="float_left">
			<img src="admin/img/img-profile.jpg" alt="Profile Pic" /></div>
			<div class="float_left marginleft10px"> 
					<div class="inline">
			<a  style="color:green; font-weight:600" href="profile.html ">Hello! <?php echo $check_name ?></a></div>
		</div>
		<?php
		}
	  ?>
	</div>  
 </div>


<div class="menu">

    
	<ul id="dc_mega-menu-orange" class="dc_mm-orange">
	  <li><a href="index.html">Home</a></li>
	  <li><a href="products.html">Products</a> </li>


	  <?php
	 	$check_cart = $ct->check_cart();
		 if($check_cart){
			 echo ' <li><a href="cart.html">Cart</a></li>';
		 }else{
			 echo '';
		 }
	  ?>

		<?php
		 $customerid= Session::get('customer_id');
	 	$check_bill = $ct->check_bill($customerid);
		 if($check_bill){
			 echo ' <li><a href="bill">Bill</a></li>';
		 }else{
			 echo '';
		 }
	  	?>
	 
	  <?php
	 	 $login_check = Session:: get('customer_login');
		  if($login_check == false){
			echo '';
		}else{
			echo '<li><a href="profile.html">Profile</a> </li>';
		}
	  ?>


		<?php
	  
	  $login_check = Session:: get('customer_login');
	  if($login_check ){
		echo '<li><a href="favoriteproduct.html">Favorite</a> </li>';
	  }
	  ?>

	  <li><a href="contact.html">Contact</a> </li>	


	  <div class="clear"></div>
	  
	</ul>

</div>