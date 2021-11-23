<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php
$filepath = realpath(dirname(__FILE__));
include_once ($filepath.'/../classes/customer.php');
include_once ($filepath.'/../helpers/format.php');
?>
<?php
$cs = new customer();
if(isset($_GET['contactid'])){                       
    $id = $_GET['contactid'];
	$contactUser = $cs->contact_user($id);

}

if(isset($_GET['delcontactid'])){                      
    $id_del = $_GET['delcontactid'];

	$del_contact_user = $cs->delete_contact_user($id_del);
	
}

?>


        <div class="grid_10">
            <div class="box round first grid">
                <h2>Contact</h2>
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
							<th>Send Time</th>
							<!-- <th>Customer Name</th> -->
							<th>Email</th>
							<th>Phone</th>
							<th>Subject</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
					<?php
					$fm = new format();
					$cs = new customer();
					$getUserContact = $cs->getUserContact();
					if($getUserContact){
						$i =0;
						while($result= $getUserContact->fetch_assoc()){
							$i++;
					
					?>
						<tr class="odd gradeX">
							<td><?php echo $i; ?></td>
							<td><?php echo $fm->formatDate($result['date_send'])?></td>
						 
							<td><?php echo $result['customer_email']?></td>						
							<td><?php echo $result['phone']?></td>
                            <td><?php echo $fm->textShorten($result['subject'],20)?></td>
										
							<td>

							<?php
							if($result['contact_status']== 0){
							?>

							<a style="color: green;" href="?contactid=<?php echo $result['id_contact'] ?>">Done</a>
						
							<?php							
							}elseif($result['contact_status']== 1){						
							?>
 
							<a style="color: red" href="?delcontactid=<?php echo $result['id_contact'] ?>">Delete</a>
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
