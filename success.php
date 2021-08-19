<?php
include 'inc/header.php';
//include 'inc/slider.php';
?>
<?php
if(isset($_GET['orderid']) && $_GET['orderid'] == 'order'){                        // if Id does not exist, it will return catlist page
    $customerid= Session::get('customer_id');
	$insertOrder = $ct->insertOrder($customerid);
	$delCart = $ct->del_all_data_cart();
	header('Location:success.php');
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
       <?php
       $customerid= Session::get('customer_id');
       $get_total_price = $ct->getTotalPrice($customerid);
       if($get_total_price){
           $total= 0; 
           while($result= $get_total_price->fetch_assoc()){
               $price = $result['price'];
               $total += $price;

         
       ?>
       <div class="total">
           
       <h2 class="order_success">Order Successfully, We will contact for you soon. Thanks you and see you again !!!</h2>
       <p class="note_order">Total price you bought: 
       <?php 
       $vat = $total*0.1;
       $totalPrice = $total + $vat;
       echo $fm->format_currency($totalPrice).' VND';  ?>  </p>
       <?php echo '<center><img src="images/success_icon.png" alt="" width ="100px"></center>'; ?>
       <p class="Bill">Please click Bill to see your order again <a href="orderdetails.php">Your Bill</a></p>
    </div>
    <?php
      }
    }else{
        echo '<center><img src="images/empty_bag_order.png" alt="" width ="500px"></center>';
    ?>
    		<div class="shopping">
                        <style>
                            .con_shopping img{
                                outline:none;
                                margin-left: 37.5%;

                            }
                        </style>
						<div class="con_shopping">
							<p><a href="index.php"> <img src="images/shop.png" alt="" /></a><p>
						</div>
					
					</div>
                    <?php
    }
                    ?>
 		</div>
 	</div>
    
</div>
        </form>
 <?php
 include 'inc/footer.php';
 ?>

	