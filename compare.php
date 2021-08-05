<?php
include_once 'inc/header.php';
//include_once 'inc/slider.php';
?>
<?php
// if(isset($_GET['cartid'])){                        
//     $cartid = $_GET['cartid'];
// 	$delCart = $ct->delete_product_cart($cartid);
// }
// if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])){
// 		$cartId = $_POST['cartId'];
// 	    $quantity = $_POST['quantity'];
// 		$update_quantity_cart = $ct->update_quantity_cart($quantity,$cartId);
// 		if($quantity==0){
// 			$delCart = $ct->delete_product_cart($cartId);

// 		}
// 	}
?>
<!-- <?php 
if(!isset($_GET['id'])){
	echo "<meta http-equiv='refresh' content='0;URL=?id=live'>";
}
?> -->
 <div class="main">
    <div class="content">
    	<div class="cartoption">		
			<div class="cartpage">
			    	<h2>Compare Product</h2>
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
								<th width="10%">ID</th>
								<th width="25%">Product Name</th>
								<th width="25%">Image</th>
								<th width="20%">Price</th>
								<th width="20%">Action</th>
								
							</tr>
							<?php
							$customerId = Session::get('customer_id');
							$get_compare_product = $ct->get_compare_product($customerId);
							if($get_compare_product){
								$i = 0;
								while($result = $get_compare_product->fetch_assoc()){
									$i++;
							?>

							
							<tr>
								<td><?php echo $i; ?></td>
								<td><?php echo $result['productName'] ?></td>
								<td><img src="admin/uploads/<?php echo $result['image'] ?>" alt=""/></td>
								<td><?php echo $result['price'] ?></td>
							
								<td><a href="details.php?proid=<?php echo $result['productId'] ?>">View</a></td>
							</tr>
							
							 <?php
								}
							}
							 ?>
							
						</table>
						
					
					   
					</div>
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
					</div>
    	</div>  	
       <div class="clear"></div>
    </div>
 </div>
 <?php
 include 'inc/footer.php';
 ?>
