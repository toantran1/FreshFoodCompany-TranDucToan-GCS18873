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
<style>
.box_left {
    width: 50%;
    border: 1px solid #666;
    float: left;
    padding: 10px;

}
.box_right {
    width: 44%;
    border: 1px solid #666;
    float: right;
    padding: 10px;

}

a.a_order{
   /* padding:10px 70px;
    border:none;
    background: green;
    font-size: 26px;
    color: white;
    margin: 10px; 
    cursor:pointer; */ 
	background: green;
	padding: 10px 70px;
	color: white;
	font-size: 25px;

}
</style>
<form action="" method="POST">
 <div class="main">
    <div class="content">
    	<div class="section group">
        <div class="heading">
    		<h3>Offline Payment</h3>
            </div>
           
    		<div class="clear"></div>
            <div class="box_left">
            <div class="cartpage">
			    	
					<?php
					if(isset($update_quantity_cart)){
						echo $update_quantity_cart;

					}
					?>
					<?php
					if(isset($delCart)){
						echo $delCart;

					}
					?>
						<table class="tblone">
							<tr>
                                <th width="5%">ID</th>
								<th width="15%">Product Name</th>
								<!-- <th width="10%">Image</th> -->
								<th width="15%">Price (VND)</th>
								<th width="25%">Quantity</th>
								<th width="20%">Total Price (VND)</th>
								<!-- <th width="10%">Action</th> -->
							</tr>
							<?php
							$get_product_cart = $ct->get_product_cart();
							if($get_product_cart){
								$subtotal = 0;
								$qty = 0;
                                $i = 0;
								while($result = $get_product_cart->fetch_assoc()){
                                    $i++;
							?>

							
							<tr>
                                <td><?php echo $i ?></td>
								<td><?php echo $result['productName'] ?></td>
								<td><?php echo $result['price']?></td>
								<td>
									
										
                                <?php echo $result['quantity'] ?>
										
									
								</td>
								<td>
								<?php
								$total = $result['price'] * $result['quantity'];
								echo $total; 
								?>
							
							</tr>
							
							 <?php
							 $subtotal += $total;
							 $qty = $qty + $result['quantity'];	
							 }
							}
							 ?>
							
						</table>
						<?php
								$check_cart = $ct->check_cart();
								if($check_cart){
								?>
						<table style="float:right;text-align:left; margin:6px" width="40%">
							<tr>
								<th>Sub Total : </th>
								<td><?php	
														
								echo $subtotal.' VND';
								Session::set('sum',$subtotal);
								Session::set('qty',$qty);                    //So luong
								?></td>
							</tr>
							<tr>
								<th>VAT : </th>
								<td>10% (<?php echo $VAT = 0.1 * $subtotal; ?>)</td>
							</tr>
							<tr>
								<th>Grand Total :</th>
								<td><?php
								$VAT = 0.1 * $subtotal;
								$gtotal = $subtotal + $VAT;
								echo $gtotal.' VND';
								?></td>
							</tr>
                          
					   </table>
					   <?php
								}else{
									echo 'Your Cart is empty. Please Shopping now, thanks you!!!';
								} 
					   ?>
					</div>
            </div>
            <div class="box_right">
            <table class="tblone">
         <?php
         $id = Session::get('customer_id');
            $get_customers = $cs->show_customers($id);
            if($get_customers){
                while($result = $get_customers->fetch_assoc()){

            
         ?>
            <tr>
                <td>Name </td>
                <td>:</td>
                <td><?php echo $result['name'] ?></td>
            </tr>
            <!-- <tr>
                <td>City </td>
                <td>:</td>
                <td><?php echo $result['city'] ?></td>
            </tr> -->
            <tr>
                <td>Phone number </td>
                <td>:</td>
                <td><?php echo $result['phone'] ?></td>
            </tr>
            <!-- <tr>
                <td>Country </td>
                <td>:</td>
                <td><?php echo $result['country'] ?></td>
            </tr> -->
            <tr>
                <td>Zip-code </td>
                <td>:</td>
                <td><?php echo $result['zipcode'] ?></td>
            </tr>
            <tr>
                <td>Email </td>
                <td>:</td>
                <td><?php echo $result['email'] ?></td>
            </tr>
            <tr>
                <td>Address </td>
                <td>:</td>
                <td><?php echo $result['address'] ?></td>
            </tr>

            <tr>
                <td colspan="3"><a href="editprofile.php">Update Profile</a> </td>
                
            </tr>
       
            <?php
                }
            }
            ?>

         </table>		
            </div>
   	
 		</div>
 	</div>
    <center><a href="?orderid=order" class="a_order">Order</a></center></br>
</div>
        </form>
 <?php
 include 'inc/footer.php';
 ?>

	