<?php
include_once 'inc/header.php';
//include_once 'inc/slider.php';
?>
<?php
if(isset($_GET['productId'])){        
	$customerid=Session::get('customer_id');                   
    $productid = $_GET['productId'];
	$delCart = $product->delete_product_cart_hide($productid, $customerid);
}
if(isset($_GET['cartid'])){                        
    $cartId = $_GET['cartid'];
	$delCart = $ct->delete_product_cart($cartId);
}
if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])){
		$cartId = $_POST['cartId'];
	    $quantity = $_POST['quantity'];
		$update_quantity_cart = $ct->update_quantity_cart($quantity,$cartId);
		if($quantity==0){
			$delCart = $ct->delete_product_cart($cartId);

		}
	}
?>
<?php 
if(!isset($_GET['id'])){
	echo "<meta http-equiv='refresh' content='0;URL=cart.html?id=live'>";
}
?>
 <div class="main">
    <div class="content">
    	<div class="cartoption">		
			<div class="cartpage">
			    	<h2><img src="images/shopping_cart1.png" alt="" width="35px">Your Cart</h2>
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
								<th width="20%">Product Name</th>
								<th width="10%">Image</th>
								<th width="15%">Price</th>
								<th width="25%">Quantity</th>
								<th width="20%">Total Price</th>
								<th width="10%">Action</th>
							</tr>
							<?php
							$get_product_cart = $ct->get_product_cart();
							if($get_product_cart){
								$subtotal = 0;
								$qty = 0;
								while($result = $get_product_cart->fetch_assoc()){
							
							?>

							
							<tr>
								<td><?php echo $result['productName'] ?></td>
								<td><img src="admin/uploads/<?php echo $result['image'] ?>" alt=""/></td>
								<td><?php echo $fm->format_currency($result['price']) ?></td>
								<td>
									<form action="" method="post">
										<input type="hidden" name="cartId" min= "0" value="<?php echo $result['cartId'] ?>"/>
										<input type="number" name="quantity" min= "0" value="<?php echo $result['quantity'] ?>"/>
										<input type="submit" name="submit" value="Update"/>
									</form>
								</td>
								<td>
								<?php
								$total = $result['price'] * $result['quantity'];
								echo $fm->format_currency($total)." VND"; 
								?>
								</td>
								<td><a onclick="return confirm('Do you want to delete this item from your cart?');" href="cart.html?cartid=<?php echo $result['cartId'] ?>.html">Delete</a></td>
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
						<table style="float:right;text-align:left;" width="40%">
							<tr>
								<th>Sub Total : </th>
								<td><?php	
														
								echo $fm->format_currency($subtotal)." VND";
								Session::set('sum',$subtotal);
								Session::set('qty',$qty);                    //So luong
								?></td>
							</tr>
							<tr>
								<th>VAT : </th>
								<?php
								$VAT = 0.1 * $subtotal;
								?>
								<td>10%(<?php echo $fm->format_currency($VAT)  ?>)</td>
							</tr>
							<tr>
								<th>Grand Total :</th>
								<td><?php
								
								
								$gtotal = $subtotal + $VAT;
								echo $fm->format_currency($gtotal)." VND";
								?></td>
							</tr>
					   </table>
					</div>
					   <div class="shopping">
						<div class="shopleft">
							<a href="index.html"> <img src="images/shop.png" alt="" /></a>
						</div>
						<div class="shopright">
							<a href="payment.html"> <img src="images/checkout.png" alt="" /></a>
						</div>
					</div>
					   <?php
								}else{
									
									echo '<center><img src="images/empty_cart1.png" alt="" width ="400px"></center>';
									echo '<center>Your Cart is empty. Please Shopping now, thanks you!!!</center>';
								?>
					</div>
								<div class="shopping">
									<div class="">
										<center><a href="index.html"> <img src="images/shop.png" alt="" /></a><center>
									</div>
								</div>
								
								<?php
								} 
					   ?>
					
					<!-- <div class="shopping">
						<div class="shopleft">
							<a href="index.html"> <img src="images/shop.png" alt="" /></a>
						</div>
						<div class="shopright">
							<a href="payment.html"> <img src="images/checkout.png" alt="" /></a>
						</div>
					</div> -->
    	</div>  	
       <div class="clear"></div>
    </div>
 </div>
						
 <?php
 include 'inc/footer.php';
 ?>
