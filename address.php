<?php
include 'inc/header.php';
//include 'inc/slider.php';
?>
<?php
$customerid = Session::get('customer_id');

if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit_address'])){
    $address = $_POST['delivery_address'];
    $insert_new_address = $cs->insert_new_address($address,$customerid) ;
}
?>

 <div class="main">
    <div class="content">
    	<div class="section group">
        <div class="content_top">
    		<div class="heading">
    		<h3>Add address</h3>
            <?php
                if(isset($insert_new_address)){
                    echo $insert_new_address;
                }
                ?>
    		</div>
    		<div class="clear"></div>
    	</div>
		<form action="" method="POST">
 		<table class="tblone">
       
            <tr>
                <td>New Address: </td>
                
                <td><input type="text" placeholde="Enter new address..." name="delivery_address"></td>
            </tr>
            <tr>
                <td><input type="submit" name="submit_address" value="Submit"></td>
             
            </tr>
            <tr>
        
            <td><a style="background:#aaec8f; border-radius: 10px; padding: 10px" href ="profile.html"> << Back to the Profile </a></td>
           
            </tr>
           

         </table>	
</form>	
 		</div>
 	</div>
        </div>
 <?php
 include 'inc/footer.php';
 ?>

	