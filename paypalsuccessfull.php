<?php
include 'inc/header.php';
?>
<?php
$ct =new cart;
if(isset($_GET['orderID'])&& $_GET['Cusname'] && $_GET['email']&& $_GET['address_Delivery']){                        
    $customerid= Session::get('customer_id');
    $orderID= $_GET['orderID'];
    $name= $_GET['Cusname'];
    $email= $_GET['email'];
    $addressDelivery = $_GET['address_Delivery'];
	$insertOrder = $ct->insertOrderpaypal($customerid,$orderID,$name,$email,$addressDelivery);
	// $delCart = $ct->del_all_data_cart_paypal();
    	  
}else{
    header('Location:index.html');
}
?>
<style type="text/css">
h2.order_success{
    text-align: center;
    color: red;
} 
p.note_order{
    text-align: center;
    padding: 10px;
    font-size: 20px;
}
p.Bill{
    text-align: center;
    padding: 10px;
    font-size: 20px;
}
</style>
<form action="" method="POST">
 <div class="main">
    <div class="content">
    	<div class="section group">
        <div class="shopping">
                        <style>
                            .con_shopping img{
                                outline:none;
                                margin-left: 37.5%;

                            }
                           
                        </style>
                        <center><img src="images/success_icon.png" alt="" width ="100px"></center><br>
                        <center><h1 style="color: #3bb54a; font-weight:600; font-size:1.5em;">Payment successfull! </h1></center></br></br>
                        <!-- <center><h1 style="color: green; font-weight:600; font-size:1.5em;">The invoice you have paid has a total amount of :<p style="color:red;"> <?php echo $price?> $</p></h1></center></br></br> -->
                        <p class="Bill">Please click Bill to see your order again <a style="color:green;" href="bill">Your Bill</a></p>
					
					</div>
     
    </div>
    </div>
    
 	</div>
    
</div>
        </form>
 <?php
 include 'inc/footer.php';
 ?>

	