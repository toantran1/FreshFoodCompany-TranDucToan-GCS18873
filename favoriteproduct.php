<?php
include_once 'inc/header.php';
//include_once 'inc/slider.php';
?>
<?php
 if(isset($_GET['proid'])){  
       $customerid=Session::get('customer_id');                      
       $productid = $_GET['proid'];
	   
       $del_favorite = $product->del_favor_product($productid,$customerid);
 }
?>
<style>
    .content h2{
    /* font-size: 23px; */
    color: #bf0d2e;
    font-family: 'Monda', sans-serif;
    }
</style>
 <div class="main">
    <div class="content">
    	<div class="cartoption">		
			<div class="cartpage">
			    	<h2><img src="images/love_product.png" alt="" width="40px" height="40px">Favorite Product</h2>
					
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
							$get_favor_product = $ct->get_favor_product($customerId);
							if($get_favor_product){
								$i = 0;
								while($result = $get_favor_product->fetch_assoc()){
									$i++;
							?>

							
							<tr>
								<td><?php echo $i; ?></td>
								<td><?php echo $result['productName'] ?></td>
								<td><img src="admin/uploads/<?php echo $result['image'] ?>" alt=""/></td>
								<td><?php echo $fm->format_currency($result['price'])." VND" ?></td>
							
								<td>
                                <a href="?proid=<?php echo $result['productId'] ?>">Remove</a> ||
                                <a href="details.php?proid=<?php echo $result['productId'] ?>">Buy now</a>
                                </td>
							</tr>
							
                            <?php
                                }
							}else{
                               
							 ?>
							
						</table>
						<table>
						<?php
                         echo '<center><img src="images/empty_favorite2.png" alt="" width ="450px"></center>';
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
