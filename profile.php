<?php
include 'inc/header.php';
//include 'inc/slider.php';
?>
 <?php
	 	 $login_check = Session:: get('customer_login');
		  if($login_check == false){
			header('Location:login.php');
		}
	  ?>

<?php

 $id = Session::get('customer_id');

if( isset($_GET['idaddress'])){
   $idaddress= $_GET['idaddress'];
   
    $set_default = $cs->set_default($id,$idaddress);
 
}

?>
<?php

$id = Session::get('customer_id');

if( isset($_GET['deladdress'])){
  $del_address= $_GET['deladdress'];
  
   $delete_address_delivery = $cs->delete_address_delivery($id,$del_address);

}

?>
 <div class="main">
    <div class="content">
    	<div class="section group">
        <div class="content_top">
    		<div class="heading">
    		<h3>Profile Customer</h3>
    		</div>
    		<div class="clear"></div>
    	</div>
		
 		<table class="tblone">
         <?php
         $id = Session::get('customer_id');
            $get_customers = $cs->show_customers($id);
            if($get_customers){
                while($result = $get_customers->fetch_assoc()){

            
         ?>
            <tr>
                <td>Name </td>
                <td>:</td>
                <td><?php echo $result['name'] ?></td>
            </tr>
            <!-- <tr>
                <td>City </td>
                <td>:</td>
                <td><?php echo $result['city'] ?></td>
            </tr> -->
            <tr>
                <td>Phone number </td>
                <td>:</td>
                <td><?php echo $result['phone'] ?></td>
            </tr>
            <!-- <tr>
                <td>Country </td>
                <td>:</td>
                <td><?php echo $result['country'] ?></td>
            </tr> -->
            <tr>
                <td>Zip-code </td>
                <td>:</td>
                <td><?php echo $result['zipcode'] ?></td>
            </tr>
            <tr>
                <td>Email </td>
                <td>:</td>
                <td><?php echo $result['email'] ?></td>
            </tr>
            <tr>
                <td>Address </td>
                <td>:</td>
                <td><?php echo $result['address'] ?></td>
            </tr>
                    <!-- <tr>
            <form action="" method="POST">
                <style>
                    .box_left {
    width: 50%;
    border: 1px solid #666;
    float: left;
    padding: 10px;

}
                </style>
                    <div class="box_left">
                        <h3>Delivery Address:</h3>
                        <input type="Text" placeholder="Enter new address..."/>
                    </div>  

            </form>
</tr> -->


            <tr>
                <td colspan="3"><a href="editprofile.html">Update Profile</a> </td>
                
            </tr>

            <?php
                }
            }
            ?>
           

         </table>		

         </div>
 	</div>
        
     <div class="content">
    	<div class="section group">
        <div class="content_top">
    		<div class="heading">
    		<h3>Delivery Address</h3>
    		</div>
    		<div class="clear"></div>
    	</div>
<table class="tblone">

    <form action="" method="GET">
         <?php
         $id = Session::get('customer_id');
            $get_address = $cs->show_delivery_address($id);
            if($get_address){
                $i = 0;
                while($result_deli = $get_address->fetch_assoc()){
                        $i++;
            
         ?>
            <tr>
                
                <td><?php echo $i; ?>-Delivery Address </td>
                <td>:</td>
                <td><?php echo $result_deli['address_delivery'] ?></td>
                <td><a href="profile.html?idaddress=<?php echo $result_deli['id'] ?>" type="submit" name="set_default" >Use</a></td>
                <td>||</td>
                <td><a href="?deladdress=<?php echo $result_deli['id'] ?>" type="submit" name="del_address" >Delete</a> </td>
              
            </tr>
           
       
            <?php
                }
            }else{
                echo'<center><img src="images/address_icon.png" alt="" width ="150px"></center>';
                echo '<center><a style="color:#cc3636; font-weight: 600;" ">No new shipping addresses have been added yet!</a></center>';
            }
            ?>
            <tr>

            </tr>
             <tr>
                <td colspan="3"><a href="address.html">Add Delivery Address</a> </td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                
            </tr>
            <tr>
            <td><a style="background:#aaec8f; border-radius: 10px; padding: 10px" href ="offlinepayment.php"> << Back to the Payment </a></td>
            </tr>
    </form>
</table>		
 		</div>
 	</div>
        </div>
 <?php
 include 'inc/footer.php';
 ?>

	