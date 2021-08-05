<?php
include_once 'inc/header.php';
//include_once 'inc/slider.php';
?>
<?php

$login_check = Session:: get('customer_login');
if($login_check == false){
  header('Location:login.php');
}

?>
<?php
$ct = new cart();
if(isset($_GET['receiveid'])){                        
  $id = $_GET['receiveid'];
  $time = $_GET['time'];
  $price = $_GET['price'];
  $received = $ct->received($id,$time,$price);
}

// if(isset($_GET['deleteOrderid'])){                      
//     $id = $_GET['deleteOrderid'];
// 	// $time = $_GET['time'];
// 	// $price = $_GET['price'];
// 	$del_ordered = $ct->delete_order_detail($id);
// }
?>

 <div class="main">
    <div class="content">
    	<div class="cartoption">		
			<div class="cartpage">
			    	<h2>Your Ordered Details</h2>
					
						<table class="tblone">
							<tr>
                                <th width="5%">ID</th>
								<th width="20%">Product Name</th>
								<th width="10%">Image</th>
								<th width="15%">Price</th>
								<th width="15%">Quantity</th>
                                <th width="15%">Date</th>	
                                <th width="10%">Status</th>								
								<th width="10%">Action</th>
							</tr>
							<?php
                            $customerid= Session::get('customer_id');
							$get_ordered_detail = $ct->get_ordered_detail($customerid);
							if($get_ordered_detail){
								$i = 0;
								$qty = 0;
								while($result = $get_ordered_detail->fetch_assoc()){
                                    $i++;
							?>

							
							<tr>
                                <td><?php echo $i; ?></td>
								<td><?php echo $result['productName'] ?></td>
								<td><img src="admin/uploads/<?php echo $result['image'] ?>" alt=""/></td>
								<td><?php echo $result['price'].' VND' ?></td>
								<td>
									
                                    <?php echo $result['quantity'] ?>
								
								</td>

								
                                
                                <td><?php echo $fm->formatDate($result['dateOrder']); ?></td>
                                <td>
                                <?php
                                if($result['status']== '0'){
                                    echo 'Processing';
                                }elseif($result['status']==  1){
                                   
                                    ?>
                                    <!-- <a href="?receiveid=<?php echo $result['id'] ?>&price=<?php echo $result['price']?>&time=<?php echo $result['dateOrder']?>">Delivering</a> -->
                                    <span>Delivering</span>
                                <?php
                                }else{
                                    echo 'Received';
                                }
                                ?>
                                </td>
                                <?php
                                if($result['status']== '0'){
                                   
                                ?>
                                <td><?php echo "N/A"; ?></td>

                                <?php
                                }elseif($result['status']== '1'){
                                ?>
                                 <td><a href="?receiveid=<?php echo $result['id'] ?>&price=<?php echo $result['price']?>&time=<?php echo $result['dateOrder']?>">Confirm</a></td>
                               <?php
                                }elseif($result['status']== '2'){
                               ?>
                                <td><?php echo 'Received' ?></td>
                                <?php
                                    }
                                ?>
								
							
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
       <div class="clear"></div>
    </div>
 </div>
 <?php
 include 'inc/footer.php';
 ?>
