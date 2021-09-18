<?php
include_once 'inc/header.php';
//include_once 'inc/slider.php';
?>
<?php

$login_check = Session:: get('customer_login');
if($login_check == false){
  header('Location:login.html');
}

?>
<?php
$ct = new cart();
if(isset($_GET['receiveid'])){                        
  $id = $_GET['receiveid'];
  $time = $_GET['time'];

  $received = $ct->received($id,$time);
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
			    	<h2>Your Bill</h2>
					
						<table class="tblone">
							<tr>
                                <th width="3%">ID</th>
								<th width="10%">Bill Code</th>
								<th width="13%">Name</th>
								<th width="19%">Delivery Address</th>
								<!-- <th width="15%">email</th> -->
                                <th width="15%">Date</th>
                                <th width="15%">Detail</th>
                                <th width="10%">Status</th>								
								<th width="10%">Action</th>
							</tr>
							<?php
                            $customerid= Session::get('customer_id');
							$get_bill = $ct->get_bill($customerid);
							if($get_bill){
								$i = 0;
								$qty = 0;
								while($result = $get_bill->fetch_assoc()){
                                    $i++;
							?>

							
							<tr>
                                <td><?php echo $i; ?></td>
								<td style="font-weight:bold; color:green;"><?php echo $result['code_bill'] ?></td>
								<td><?php echo $result['customerName'] ?></td>
                                <td><?php echo $result['address_delivery'] ?></td>
                                
                                <td><?php echo $fm->formatDate($result['date_order']); ?></td>
                                <td><a style="color:#00136c;" href= "orderdetails.html?bill_Id=<?php echo $result['code_bill']?>">View details</a></td>
                                <td>
                                <?php
                                if($result['status']== 0){
                                    echo 'Processing';
                                }elseif($result['status']==  1){
                                   
                                ?>
                                    
                                    <span>Delivering</span>
                                <?php
                                }else{
                                    echo 'Received';
                                }
                                ?>
                                </td>
                                <?php
                                if($result['status']== 0){
                                   
                                ?>
                                <td><?php echo "N/A"; ?></td>

                                <?php
                                }elseif($result['status']== 1){
                                ?>
                                 <td><a href="bill?receiveid=<?php echo $result['bill_id'] ?>&time=<?php echo $result['date_order']?>">Confirm</a></td>
                               <?php
                                }elseif($result['status']== 2){
                               ?>
                                <td><?php echo 'Received' ?></td>
                                <?php
                                    }else{
                                        ?>
                                        <td><?php echo 'Received' ?></td>
                                        <?php
                                        
                                    }
                                ?>

							</tr>

							<?php
							}
                        }else{
                        ?>
							
						</table>
                        <table>
                        <?php
                            echo '<center><img src="images/empty_state1.png" alt="" width ="300px"></center>';
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
							<p><a href="index.html"> <img src="images/shop.png" alt="" /></a><p>
						</div>
					
					</div>
    	</div>  	
       <div class="clear"></div>
    </div>
 </div>

 <?php
 include 'inc/footer.php';
 ?>
