<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/customer.php'?>

<?php
$cs = new customer();
if(isset($_GET['cusid'])){                       
    $id = $_GET['cusid'];
	
	$activate = $cs->activate_account($id);
}
?>

        <div class="grid_10">
            <div class="box round first grid">
                <h2>User Account</h2>
                <div class="block">    
			
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th>No.</th>
							<th>User Name</th>					
							<th>Customer ID</th>
                            <th>Email</th>
							<th>Status</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
					<?php
				
					$cs = new customer();
					$showcustomeraccount = $cs->show_customer_account();
					if($showcustomeraccount){
						$i =0;
						while($result= $showcustomeraccount->fetch_assoc()){
							$i++;
					
					?>
						<tr class="odd gradeX">
							<td><?php echo $i; ?></td>
							
							<td><?php echo $result['name']?></td>
							<td><?php echo $result['id']?></td>
							<td><?php echo $result['email']?></td>
							
							<td><a style="color: blue" href= "customer.php?customerid=<?php echo $result['id'] ?>">View User</a></td>
							
							
                            <td>

							<?php
							if($result['block']== 0){
							?>

							<a style="color: green" href="?cusid=<?php echo $result['id'] ?>">Active</a>
						
							<?php
							}elseif($result['block']== 1){	
							?>

							<a style="color: red" href="?cusid=<?php echo $result['id'] ?>">Blocked</a>
	
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
