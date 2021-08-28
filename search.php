<?php
include 'inc/header.php';
include 'inc/slider.php';
?>


 <div class="main">
    <div class="content">
    	<div class="content_top">
    		<div class="heading">
    		<h3>Search result</h3>
    		</div>
    		<div class="clear"></div>
    	</div>
	      <div class="section group">
          <?php
				 if(isset($_GET['search_prod']) && $_GET['search_submit'] != '' ){
					 $search = $_GET['search_prod'];
					 $search_prod = $product->search_product($search);
					
					if($search_prod){
						 while($res_search = $search_prod->fetch_assoc()){
					
				  ?>
				<div class="grid_1_of_4 images_1_of_4">
					 <a href="detail-products/<?php echo $res_search['productId'] ?>.html"><img src="admin/uploads/<?php echo $res_search['image'] ?>" alt="" /></a>
					 <h2><?php echo $res_search['productName'] ?></h2>
					 <p><?php echo $fm->textShorten($res_search['product_desc'], 50) ?></p>
					 <p><span class="price"><?php echo $fm->format_currency($res_search['price'])." VND"?></span></p>
				     <div class="button"><span><a href="detail-products/<?php echo $res_search['productId'] ?>.html" class="details">Details</a></span></div>
				</div>
				<?php
                 }
			}elseif(empty($_GET['search_prod'])){
                echo '<center><img src="images/no_finding.png" alt="" width ="450px"></center>';
            }else{
                echo '<center><img src="images/noresult.png" alt="" width ="450px"></center>';
                   
        }
    }
				?>
			</div>	
    </div>
 </div>

 <?php
 include 'inc/footer.php';
 ?>
 