<div class="header_bottom">
		<div class="header_bottom_left">
			<div class="section group">
			<?php
			$getLastestFarmerMarkets = $product->getLastestFarmerMarkets();
			if($getLastestFarmerMarkets){
				while($resultFarmerMarkets = $getLastestFarmerMarkets->fetch_assoc()){
			
			?>
				<div class="listview_1_of_2 images_1_of_2">
					<div class="listimg listimg_2_of_1">
						 <a href="detail-products/<?php echo $resultFarmerMarkets['productId'] ?>.html"> <img src="admin/uploads/<?php echo $resultFarmerMarkets['image'] ?>" alt="" /></a>
					</div>
				    <div class="text list_2_of_1">
						<h2>Farmer Market</h2>
						<p><?php echo $resultFarmerMarkets['productName'] ?></p>
						<div class="button"><span><a href="detail-products/<?php echo $resultFarmerMarkets['productId'] ?>.html">Add to cart</a></span></div>
				   </div>
			   </div>	
			   <?php
			   }
			}
			   ?>	

			   <?php
			$getLastestThreeF= $product->getLastestThreeF();
			if($getLastestThreeF){
				while($resultThreeF = $getLastestThreeF->fetch_assoc()){
			
			?>	
				<div class="listview_1_of_2 images_1_of_2">
					<div class="listimg listimg_2_of_1">
						  <a href="detail-products/<?php echo $resultThreeF['productId'] ?>.html"><img src="admin/uploads/<?php echo $resultThreeF['image'] ?>" /></a>
					</div>
					<div class="text list_2_of_1">
						  <h2>3Fs</h2>
						  <p><?php echo $resultThreeF['productName'] ?></p>
						  <div class="button"><span><a href="detail-products/<?php echo $resultThreeF['productId'] ?>.html">Add to cart</a></span></div>
					</div>
				</div>
			</div>
			<?php
			   }
			}
			   ?>	
			   
			   <?php
			$getLastestFreshFood= $product->getLastestFreshFood();
			if($getLastestFreshFood){
				while($resultFreshFood = $getLastestFreshFood->fetch_assoc()){
			
			?>			   
			<div class="section group">
				<div class="listview_1_of_2 images_1_of_2">
					<div class="listimg listimg_2_of_1">
						 <a href="detail-products/<?php echo $resultFreshFood['productId'] ?>.html"> <img src="admin/uploads/<?php echo $resultFreshFood['image']?>" /></a>
					</div>
				    <div class="text list_2_of_1">
						<h2>Fresh Food</h2>
						<p><?php echo $resultFreshFood['productName'] ?></p>
						<div class="button"><span><a href="detail-products/<?php echo $resultFreshFood['productId'] ?>.html">Add to cart</a></span></div>
				   </div>
			   </div>	
			   <?php
			   }
			}
			   ?>	

			   <?php
			$getLastestHealthyFood= $product->getLastestHealthyFood();
			if($getLastestHealthyFood){
				while($resultHealthyFood = $getLastestHealthyFood->fetch_assoc()){			
			?>

				<div class="listview_1_of_2 images_1_of_2">
					<div class="listimg listimg_2_of_1">
						  <a href="detail-products/<?php echo $resultHealthyFood['productId'] ?>.html"><img src="admin/uploads/<?php echo $resultHealthyFood['image']?>" /></a>
					</div>
					<div class="text list_2_of_1">
						  <h2>Healthy Food</h2>
						  <p><?php echo $resultHealthyFood['productName'] ?></p>
						  <div class="button"><span><a href="detail-products/<?php echo $resultHealthyFood['productId'] ?>.html">Add to cart</a></span></div>
					</div>
				</div>
				<?php
			   }
			}
			   ?>	
			</div>
		  <div class="clear"></div>
		</div>
			 <div class="header_bottom_right_images">
		   <!-- FlexSlider -->
             
			<section class="slider">
				  <div class="flexslider">
					<ul class="slides">
						<?php
						$get_slider = $product->show_slider();
						if($get_slider){
							while($result_slider= $get_slider->fetch_assoc()){
						
						?>
						<li><a href="<?php echo $result_slider['link_slider'] ?>"><img src="admin/uploads/<?php echo $result_slider['slider_image'] ?>" alt="<?php echo $result_slider['sliderName']?>"/></a></li>
					
						<?php
							}
						}
						?>
				    </ul>
				  </div>
	      </section>
<!-- FlexSlider -->
	    </div>
	  <div class="clear"></div>
  </div>	