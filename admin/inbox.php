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
	
	$processed = $ct->processed($id,$time);
	
}

if(isset($_GET['deleid'])){                      
    $id = $_GET['deleid'];
	$time = $_GET['time'];
	
	$del_processed = $ct->delete_completed_orer($id,$time);
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
							<th width="5%">No.</th>
							<th width="10%">Order Time</th>
							<th width="13%">Bill Code</th>
							<th width="12%">Name</th>
							<th width="20%">Delivery address</th>
							<th width="10%">Bill detail</th>
							<th width="10%">Profile</th>
							<th width="10%">Payments</th>
							<th width="10%">Action</th>
						</tr>
					</thead>
					<tbody>
					<?php
					$fm = new format();
					$ct = new cart();
					$getInboxBill = $ct->getInboxBill();
					if($getInboxBill){
						$i =0;
						while($result= $getInboxBill->fetch_assoc()){
							$i++;
					
					?>
						<tr class="odd gradeX">
							<td><?php echo $i; ?></td>
							<td><?php echo $fm->formatDate($result['date_order'])?></td>
							<td><?php echo $result['code_bill']?></td>
							<td><?php echo $result['customerName']?></td>
							<td><?php echo $result['address_delivery']?></td>
							<td>
								<!-- <?php echo $result['email']?> -->
							<a style="color:blue;" href= "detailBill.php?cusId=<?php echo $result['customerId']?>&ID_bill=<?php echo $result['code_bill']?>">View detail</a>
							</td>
							<td><a style="color:blue;" href= "customer.php?customerid=<?php echo $result['customerId']?>&bill_Id=<?php echo $result['code_bill']?>">View User</a></td>
							<td><?php echo $result['payments']?></td>
							<td>

							<?php
							if($result['status']== 0){
							?>

							<a href="?processid=<?php echo $result['bill_id'] ?>&time=<?php echo $result['date_order']?>">Processing</a>
						
							<?php
							}elseif($result['status']== 1){
								echo 'Delivering...';
							?>
							<?php							
							}elseif($result['status']== 2){						
							?>
 
							<a style="color: red" href="?deleid=<?php echo $result['bill_id'] ?>&time=<?php echo $result['date_order']?>">Delete</a>
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
