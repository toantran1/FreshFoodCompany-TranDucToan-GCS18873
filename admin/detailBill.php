<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
<?php
$filepath = realpath(dirname(__FILE__));
include_once($filepath . '/../classes/product.php');
include_once($filepath . '/../helpers/format.php');
?>
<?php
if (!isset($_GET['ID_bill']) || $_GET['ID_bill'] == NULL) {
	echo "<script> window.location = 'inbox.php'</script>";
} else {
	$bill_id = $_GET['ID_bill'];
}

?>
<?php

if (!isset($_GET['cusId']) || $_GET['cusId'] == NULL) {                        // if Id does not exist, it will return catlist page
	echo "<script> window.location = 'inbox.php'</script>";
} else {
	$id = $_GET['cusId'];
}

?>


<div class="grid_10">
	<div class="box round first grid">
		<h2>Bill details</h2>
		<div class="block">
			<?php
			if (isset($processed)) {
				echo $processed;
			}
			if (isset($del_processed)) {
				echo $del_processed;
			}
			?>
			<table class="data display datatable" id="example">
				<thead>
					<tr>
						<th width="10%">No.</th>
						<th width="10%">Product ID</th>
						<th width="20%">Product Name</th>
						<th width="20%">Image</th>

						<th width="20%">Quantity</th>
						<th width="20%">Total Price</th>

					</tr>
				</thead>
				<tbody>
					<?php
					$fm = new format();
					$product = new product();
					$getInboxBill_detail = $product->getInboxBill_detail($id, $bill_id);
					if ($getInboxBill_detail) {
						$i = 0;
						$subtotal = 0;
						$qty = 0;
						while ($result = $getInboxBill_detail->fetch_assoc()) {
							$i++;

					?>
							<tr class="odd gradeX">
								<td><?php echo $i; ?></td>
								<td><?php echo $result['productId'] ?></td>
								<td><?php echo $result['productName'] ?></td>
								<td><img src="uploads/<?php echo $result['image'] ?>" width="100px;" style="margin-top: 10px;" alt="" /></td>

								<td><?php echo $result['quantity'] ?></td>

								<td>
									<?php
									$total = $result['price'];
									echo $fm->format_currency($total) . " VND";
									?>
								</td>
							</tr>
					<?php
							$subtotal += $total;
							$qty = $qty + $result['quantity'];
						}
					}
					?>
					
								<th>Sub Total : </th>
								<td><?php	
														
								echo $fm->format_currency($subtotal)." VND";
								Session::set('sum',$subtotal);
								Session::set('qty',$qty);                    //Quantity
								?></td>
							
						
								<th>VAT : </th>
								<?php
								$VAT = 0.1 * $subtotal;
								?>
								<td>10%(<?php echo $fm->format_currency($VAT)  ?>)</td>
						
								<th>Grand Total :</th>
								<td><?php
								
								
								$gtotal = $subtotal + $VAT;
								echo $fm->format_currency($gtotal)." VND";
								?></td>
							
				</tbody>
			</table><br>
		
		</div>
	</div>
</div>
<script type="text/javascript">
	$(document).ready(function() {
		setupLeftMenu();

		$('.datatable').dataTable();
		setSidebarHeight();
	});
</script>
<?php include 'inc/footer.php'; ?>