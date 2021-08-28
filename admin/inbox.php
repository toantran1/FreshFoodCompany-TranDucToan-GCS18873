<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php
$filepath = realpath(dirname(__FILE__));
include_once ($filepath.'/../classes/cart.php');
include_once ($filepath.'/../helpers/format.php');
?>
<?php
$ct = new cart();
if(isset($_GET['processid'])){                       
    $id = $_GET['processid'];
	$time = $_GET['time'];
	$price = $_GET['price'];
	$processed = $ct->processed($id,$time,$price);
}

if(isset($_GET['deleid'])){                      
    $id = $_GET['deleid'];
	$time = $_GET['time'];
	$price = $_GET['price'];
	$del_processed = $ct->delete_completed_orer($id,$time,$price);
}
?>


        <div class="grid_10">
            <div class="box round first grid">
                <h2>Inbox</h2>
                <div class="block">    
				<?php
				if(isset($processed)){
					echo $processed;
				}
				if(isset($del_processed)){
					echo $del_processed;
				}
				?>    
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th>No.</th>
							<th>Order Time</th>
							<th>Product</th>
							<th>Quantity</th>
							<th>Price</th>
							<!-- <th>Customer Name</th> -->
							<th>Profile</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
					<?php
					$fm = new format();
					$ct = new cart();
					$getInboxCart = $ct->getInboxCart();
					if($getInboxCart){
						$i =0;
						while($result= $getInboxCart->fetch_assoc()){
							$i++;
					
					?>
						<tr class="odd gradeX">
							<td><?php echo $i; ?></td>
							<td><?php echo $fm->formatDate($result['dateOrder'])?></td>
							<td><?php echo $result['productName']?></td>
							<td><?php echo $result['quantity']?></td>
							<td><?php echo $fm->format_currency($result['price']).' VND'?></td>
							<!-- <td><?php echo $result['customerId']?></td> -->
							<td><a style="color:blue;" href= "customer.php?customerid=<?php echo $result['customerId'] ?>">View User</a></td>
							
							<td>

							<?php
							if($result['status']== 0){
							?>

							<a href="?processid=<?php echo $result['id'] ?>&price=<?php echo $result['price']?>&time=<?php echo $result['dateOrder']?>">Processing</a>
						
							<?php
							}elseif($result['status']== 1){
								echo 'Delivering...';
							?>
							<?php							
							}elseif($result['status']== 2){						
							?>
 
							<a style="color: red" href="?deleid=<?php echo $result['id'] ?>&price=<?php echo $result['price']?>&time=<?php echo $result['dateOrder']?>">Delete</a>
							<?php
							}
							?>

							</td>
						</tr>
					<?php
					}
				}
					?>
					</tbody>
				</table>
               </div>
            </div>
        </div>
<script type="text/javascript">
    $(document).ready(function () {
        setupLeftMenu();

        $('.datatable').dataTable();
        setSidebarHeight();
    });
</script>
<?php include 'inc/footer.php';?>
