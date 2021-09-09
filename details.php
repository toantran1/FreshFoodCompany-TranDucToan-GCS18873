<?php
include 'inc/header.php';
//include 'inc/slider.php';
?>
<?php
if(!isset($_GET['proid']) || $_GET['proid'] == NULL){                       
    echo "<script> window.location = '404.html'</script>";
}else{
    $id = $_GET['proid'];
	}
if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])){
	    $quantity = $_POST['quantity'];
		$AddtoCart = $ct->add_to_cart($quantity,$id);
	}
?>
<?php
// $customerId = Session::get('customer_id');
// if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['compare'])){	
// 	$productId = $_POST['productid'];
// 	$insertCompare = $product->insert_compare($productId,$customerId);
// }
?>
<?php
$customerId = Session::get('customer_id');
if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['favorproduct'])){	
	$productId = $_POST['productid'];
	$insertFavorite = $product->insert_favorite($productId,$customerId);
}
?>
<?php

if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit_comment'])){

	 $comment= $cs->insert_comment();
	 header("Refresh:0");

}
?>
<?php
// $customerId = Session::get('customer_id');
// if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit_comment'])){

// 	$insert_cus_comment= $cs->insert_cus_comment($customerId);

// }
?>

 <div class="main">
    <div class="content">
    	<div class="section group">
		<?php
		$get_product_details = $product->get_details($id);
		if($get_product_details){
			while($result_details= $get_product_details->fetch_assoc()){
		
		?>
				<div class="cont-desc span_1_of_2">				
					<div class="grid images_3_of_2">
						<img src="admin/uploads/<?php echo $result_details['image'] ?>" alt="" />
					</div>
				<div class="desc span_3_of_2">
					<h2><?php echo $result_details['productName']?> </h2>
					<p><?php echo $fm->textShorten($result_details['product_desc'],150)?></p>					
					<div class="price">
						<p>Price: <span><?php echo $fm->format_currency($result_details['price'])." VND"?></span></p>
						<p>Category: <span><?php echo $result_details['catName']?></span></p>
						<p>Brand:<span><?php echo $result_details['brandName']?></span></p>
					</div>
				<div class="add-cart">
					<form action="" method="post">
						<input type="number" class="buyfield" name="quantity" value="1" min="1"/>
						<input type="submit" class="buysubmit" name="submit" value="Buy Now"/><br>
					
					</form>	
					<?php
						if(isset($AddtoCart)){
							echo '<span style="color:red; font-size: 18px;">Product already added !!!!</span>';
						}
						?>			
				</div>

				<div class="add-cart">
					<div class="button_details">
					<form action="" method="post">
					<!-- <input type="hidden" name="productid"  value="<?php echo $result_details['productId']?>"/>
					<?php
					$login_check = Session:: get('customer_login');
					if($login_check ){
					  echo '<input type="submit" class="buysubmit" name="compare" value="Compare Product">';
					}
					?> -->
				
					
				
					<!-- </form>

					<form action="" method="post"> -->
										
					<input type="hidden" name="productid"  value="<?php echo $result_details['productId']?>"/>
					<?php
					$login_check = Session:: get('customer_login');
					if($login_check ){
					  echo '<input type="submit" class="buysubmit" name="favorproduct" value="Add to Favorite">';
					}
					?>
			
					</form>
				
				</div>
					<div class="clear"></div>
					
					<?php
					if(isset($insertFavorite)){
						echo $insertFavorite;
					}
					?>
					<!-- <?php
					// if(isset($insertCompare)){
					// 	echo $insertCompare;
					// }
					?> -->
				</div>
			</div>

			<div class="product-desc">
			<h2>Product Details</h2>
			<p><?php echo $fm->textShorten($result_details['product_desc'],800)?></p>
	    </div>
				
	</div>
	<?php
			}
		}
	?>
				<div class="rightsidebar span_3_of_1">
					<h2>CATEGORIES</h2>
					<ul>
					<?php
					$getAll_category = $cat->show_category_frontend();
					if($getAll_category){
						while($result_allcat = $getAll_category->fetch_assoc()){
					?>
				      <li><a href="category-product/id-<?php echo $result_allcat['catId'] ?>.html"><?php echo $result_allcat['catName'] ?></a></li>
				    <?php
						}
					}
					?>
    				</ul>
    	
 				</div>
 		</div>
 	</div>
	</div>	



<div class="content">
	<div class="section group">
				<div class="col span_2_of_3">
				<h2 style="font-weight:bold;font-size:25px;">Comment</h2>
				<?php
				if(isset($comment)){
					echo $comment;
				}
				?>
				  <div class="contact-form">
				  	
				
					    <form action="" method="post">
						<p><input type="hidden" value="<?php echo $id ?>" name ="product_id_comment"></p>
					    	<div>
								<?php
								$customerid = Session::get('customer_id');
								$show_cus = $cs->show_cus_comment($customerid);
								if($show_cus){
								$result_show_cus_cmt = $show_cus->fetch_assoc();
								}
								?>
								<div class="price">
						    	<p style="font-weight:bold;font-size:16px;">Your Name</p></div>
								  <?php
								 	 $login_check = Session:: get('customer_login');
									if($login_check == false){
									?>
									<input type= "text" placeholder="Enter your name..." class="buyfield" name ="usercomment"/>
									<?php
									}else{
										?>

									<input style='color: green;' type= "text" readonly="readonly" value="<?php echo $result_show_cus_cmt['name']; ?>" class="buyfield" name ="usercomment"/>
									<?php
								}
	 								 ?>
						    	
						    </div>
							<div class="price">
						    	<p style="font-weight:bold;font-size:16px;">Comment Detail</p></div>
						    	<span><textarea  style="resize:none" class="form-control" placeholder="Comment..." name="comment"></textarea></span>
						    </div>
						   <div>
						   		<span><input type="submit" name ="submit_comment" class="buysubmit" value="Comment"></span></br>
						  </div>
					    </form>
			</div>
			</div>
			
			<div class="section group">
				<div class="col span_2_of_3">
					<div class="pre-comment">
		<style>
		.panel {
			margin-bottom: 20px;
			background-color: #fff;
			border: 1px solid transparent;
			border-radius: 4px;
			-webkit-box-shadow: 0 1px 1px rgb(0 0 0 / 5%);
			box-shadow: 0 1px 1px rgb(0 0 0 / 5%);
		}
		.panel-default {
			border-color: #ddd;
		}
		.panel-default>.panel-heading {
			color: #333;
			background-color: #f5f5f5;
			border-color: #ddd;
		}
		.panel-heading {
			padding: 10px 15px;
			border-bottom: 1px solid transparent;
			border-top-left-radius: 3px;
			border-top-right-radius: 3px;
		}
		.panel-body {
			padding: 15px;
		}
		.panel-footer {
			padding: 10px 15px;
			background-color: #f5f5f5;
			border-top: 1px solid #ddd;
			border-bottom-right-radius: 3px;
			border-bottom-left-radius: 3px;
		}
		</style>
				<h2>All Comments</h2>
				
				<?php	
						$cmlist= $cs->show_comment($id);
						if($cmlist){
						 	while($result_comment= $cmlist->fetch_assoc()){
                ?> 
				<div class="panel panel-default">
			
					<div class="panel-heading">
						<p>By
						<b style="color:green; font-weight:bold;"><?php echo $result_comment['user_comment'] ?></b>
						on 
						<i style="font-style: italic;font-size:15px;"><?php echo $result_comment['date_cmt'] ?></i>		
						</p>
					</div>
					<div class="panel-body">
						<p><?php echo $result_comment['comment_detail'] ?></p>		
					</div>
					<!-- <div class="panel-footer"></div> -->
				</div>
				<?php
					}
				}else{
				?>
				<?php
					echo '<center><img src="images/no_comment.png" alt="" width ="450px"></center>';
				   }
				?>	
	
					</div>
				  </div>
  				</div>

			
		</div>

			
 <?php
 include 'inc/footer.php';
 ?>

	