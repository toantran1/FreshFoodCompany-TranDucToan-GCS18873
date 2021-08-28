<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/product.php';?>

<?php
$product = new product();
 if(isset($_GET['del_slider_id'])){
	 $slider_id = $_GET['del_slider_id'];
	 $update_slider = $product->show_hide_slider($slider_id);
	//  $delete_slider = $product->delete_slider($slider_id);
 }

 if(isset($_GET['del_id'])){
	$del_id = $_GET['del_id'];
	
    $delete_slider = $product->delete_slider($del_id);
}
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Slider List</h2>
        <div class="block">  
            <table class="data display datatable" id="example">
			<thead>
				<tr>
					<th>No.</th>
					<th>Slider Title</th>
					<th>Slider Image</th>
					<th>Type</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				<?php
				$product =new product();
				$get_slider_admin = $product->show_slider_admin();
				if($get_slider_admin){
					$i = 0;
					while($result_slider_admin= $get_slider_admin->fetch_assoc()){
						$i++;
				?>
				<tr class="odd gradeX">
					<td><?php echo $i ?></td>
					<td><?php echo $result_slider_admin['sliderName'] ?></td>
					<td><img src="uploads/<?php echo $result_slider_admin['slider_image'] ?>" height="100px" width="250px"/></td>	
					<td>
						<?php
						if($result_slider_admin['type']== 1){
						?>
						<a style="color:red" href="?del_slider_id=<?php echo $result_slider_admin['id'] ?>" >Off</a> 
						<?php							
						}elseif($result_slider_admin['type']== 0){
						?>
						<a style="color:green" href="?del_slider_id=<?php echo $result_slider_admin['id'] ?>" >On</a> 
						<?php
						}
						?>
						
					</td>			
				<td>
					
					<a style="color:red;" href="?del_id=<?php echo $result_slider_admin['id'] ?>" onclick="return confirm('Are you sure to Delete!');" >Delete</a> 
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
