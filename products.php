<?php
include 'inc/header.php';
include 'inc/slider.php';
?>

 <div class="main">
    <div class="content">
    	<div class="content_top">
    		<div class="heading">
    		<h3>Vegetable</h3>
    		</div>
    		<div class="clear"></div>
    	</div>
	      <div class="section group">
			  <?php
			  
			  $get_vegetable = $product->getvegetable();
			  if($get_vegetable){
				  while( $result_get_vegetable= $get_vegetable->fetch_assoc()){
			  
			  ?>
				<div class="grid_1_of_4 images_1_of_4">
				<a href="detail-products/<?php echo $result_get_vegetable['productId'] ?>.html"> <img src="admin/uploads/<?php echo $result_get_vegetable['image'] ?>" alt="" width="112px" height ="112px" /></a>
				<p><?php echo $result_get_vegetable['productName'] ?></p>
				<p><?php echo $result_get_vegetable['product_desc'] ?></p>
				<p><span class="price"><?php echo $fm->format_currency($result_get_vegetable['price'])." VND" ?></span></p>
				<div class="button"><span><a href="detail-products/<?php echo $result_get_vegetable['productId'] ?>.html">Details</a></span></div>
				</div>
				<?php
				}
			  }
			  ?>
				
			</div>
			<div class="">
			<?php
			$product_vegetable = $product->product_vegetable();
			$pr_vege_count = mysqli_num_rows($product_vegetable);
			
			$pr_vege_button =ceil($pr_vege_count/8);

			$i = 0;
			echo '<p>Page: </p>';
			for($i=1;$i<=$pr_vege_button;$i++){
				echo '<a style="margin:0 5px" href="products.php?vegetablepage='.$i.'">'.$i.'</a>';
			}

			?>

	    	</div>

			<div class="content_bottom">
    		<div class="heading">
    		<h3>Fruit</h3>
    		</div>
    		<div class="clear"></div>
    	</div>
			<div class="section group">
			<?php
			  
			  $get_fruit = $product->getfruit();
			  if($get_fruit){
				  while( $result_get_fruit= $get_fruit->fetch_assoc()){
			  
			  ?>
				<div class="grid_1_of_4 images_1_of_4">
				<a href="detail-products/<?php echo $result_get_fruit['productId'] ?>.html"> <img src="admin/uploads/<?php echo $result_get_fruit['image'] ?>" alt="" /></a>
				<p><?php echo $result_get_fruit['productName'] ?></p>
				<p><?php echo $result_get_fruit['product_desc'] ?></p>
				<p><span class="price"><?php echo $fm->format_currency($result_get_fruit['price'])." VND" ?></span></p>
				<div class="button"><span><a href="detail-products/<?php echo $result_get_fruit['productId'] ?>.html">Details</a></span></div>
				</div>
				
				<?php
				}
			  }
			  ?>
    </div>
	<div class="">
			<?php
			$product_fruit = $product->product_fruit();
			$pr_fruit_count = mysqli_num_rows($product_fruit);
			
			$pr_fruit_button =ceil($pr_fruit_count/8);

			$i = 0;
			echo '<p>Page: </p>';
			for($i=1;$i<=$pr_fruit_button;$i++){
				echo '<a style="margin:0 5px" href="products.php?fruitpage='.$i.'">'.$i.'</a>';
			}

			?>

	    	</div>
	<div class="content_bottom">
    		<div class="heading">
    		<h3>Meat</h3>
    		</div>
    		<div class="clear"></div>
    	</div>
			<div class="section group">
			<?php
			  
			  $get_meat = $product->getmeat();
			  if($get_meat){
				  while( $result_get_meat= $get_meat->fetch_assoc()){
			  
			  ?>
				<div class="grid_1_of_4 images_1_of_4">
				<a href="detail-products/<?php echo $result_get_meat['productId'] ?>.html"> <img src="admin/uploads/<?php echo $result_get_meat['image'] ?>" alt="" /></a>
				<p><?php echo $result_get_meat['productName'] ?></p>
				<p><?php echo $result_get_meat['product_desc'] ?></p>
				<p><span class="price"><?php echo $fm->format_currency($result_get_meat['price'])." VND" ?></span></p>
				<div class="button"><span><a href="detail-products/<?php echo $result_get_meat['productId'] ?>.html">Details</a></span></div>
				</div>
				
				<?php
				}
			  }
			  ?>
    </div>
	<div class="">
			<?php
			$product_meat = $product->product_meat();
			$pr_meat_count = mysqli_num_rows($product_meat);
			
			$pr_meat_button =ceil($pr_meat_count/8);

			$i = 0;
			echo '<p>Page: </p>';
			for($i=1;$i<=$pr_meat_button;$i++){
				echo '<a style="margin:0 5px" href="products.php?meatpage='.$i.'">'.$i.'</a>';
			}

			?>

	    	</div>
	<div class="content_bottom">
    		<div class="heading">
    		<h3>Chicken</h3>
    		</div>
    		<div class="clear"></div>
    	</div>
			<div class="section group">
			<?php
			  
			  $get_chicken = $product->getchicken();
			  if($get_chicken){
				  while( $result_get_chicken= $get_chicken->fetch_assoc()){
			  
			  ?>
				<div class="grid_1_of_4 images_1_of_4">
				<a href="detail-products/<?php echo $result_get_chicken['productId'] ?>.html"> <img src="admin/uploads/<?php echo $result_get_chicken['image'] ?>" alt="" /></a>
				<p><?php echo $result_get_chicken['productName'] ?></p>
				<p><?php echo $result_get_chicken['product_desc'] ?></p>
				<p><span class="price"><?php echo $fm->format_currency($result_get_chicken['price'])." VND"?></span></p>
				<div class="button"><span><a href="detail-products/<?php echo $result_get_chicken['productId'] ?>.html">Details</a></span></div>
				</div>
				
				<?php
				}
			  }
			  ?>
    </div>
	<div class="">
			<?php
			$product_chicken = $product->product_chicken();
			$pr_chicken_count = mysqli_num_rows($product_chicken);
			
			$pr_chicken_button =ceil($pr_chicken_count/8);

			$i = 0;
			echo '<p>Page: </p>';
			for($i=1;$i<=$pr_chicken_button;$i++){
				echo '<a style="margin:0 5px" href="products.php?chickenpage='.$i.'">'.$i.'</a>';
			}

			?>

	    	</div>

			<div class="content_bottom">
    		<div class="heading">
    		<h3>Fish</h3>
    		</div>
    		<div class="clear"></div>
    	</div>
			<div class="section group">
			<?php
			  
			  $get_fish = $product->getfish();
			  if($get_fish){
				  while( $result_get_fish= $get_fish->fetch_assoc()){
			  
			  ?>
				<div class="grid_1_of_4 images_1_of_4">
				<a href="detail-products/<?php echo $result_get_fish['productId'] ?>.html"> <img src="admin/uploads/<?php echo $result_get_fish['image'] ?>" alt="" /></a>
				<p><?php echo $result_get_fish['productName'] ?></p>
				<p><?php echo $result_get_fish['product_desc'] ?></p>
				<p><span class="price"><?php echo $fm->format_currency($result_get_fish['price'])." VND"?></span></p>
				<div class="button"><span><a href="detail-products/<?php echo $result_get_fish['productId'] ?>.html">Details</a></span></div>
				</div>
				
				<?php
				}
			  }
			  ?>
    </div>
	<div class="">
			<?php
			$product_fish = $product->product_fish();
			$pr_fish_count = mysqli_num_rows($product_fish);
			
			$pr_fish_button =ceil($pr_fish_count/8);

			$i = 0;
			echo '<p>Page: </p>';
			for($i=1;$i<=$pr_fish_button;$i++){
				echo '<a style="margin:0 5px" href="products.php?fishpage='.$i.'">'.$i.'</a>';
			}

			?>

	    	</div>
 </div>
</div>

 <?php
 include 'inc/footer.php';
 ?>

