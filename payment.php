<?php
include 'inc/header.php';
//include 'inc/slider.php';
?>
 <?php
	 	 $login_check = Session:: get('customer_login');
		  if($login_check == false){
			header('Location:login.html');
		}
	  ?>

<style>
/* h3.payment{
    margin-bottom: 20px;
    text-align: center;
    font-size: 20px;
    font-weight: bold;
    text-decoration: underline;
} */
.wrapper_method{
    text-align: center;
    width:550px;
    margin: 0 auto;
    border: 1px soid #666;
    padding: 20px;
    

}
.wrapper_method a{
    font-weight: 550;
    padding: 10px;
    background: #2da91f;
    color: #fff;
    border-radius: 10px;
}

</style>
 <div class="main">
    <div class="content">
    	<div class="section group">
        <div class="content_top">
    		<div class="heading">
    		<h3>Payment Method</h3>
            </div>
           
    		<div class="clear"></div>
            <div class ="wrapper_method">
            <!-- <h3 class ="payment"> Please, choose your payment method</h3> -->
            <center><img src="images/payment_icon.png"><center>
            <a class ="payment_href" href="offlinepayment"> Offline Payment</a>
            <a class ="payment_href" href="onlinepayment"> Online Payment</a></br></br></br>
            <a style="background:#ab2222; border-radius: 10px" href ="cart.html"> << Back the Cart </a>
            </div>
            
    	</div>
		
 		
 		</div>
 	</div>
</div>
 <?php
 include 'inc/footer.php';
 ?>

	