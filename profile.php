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
        
            <tr>
                <td>Phone number </td>
                <td>:</td>
                <td><?php echo $result['phone'] ?></td>
            </tr>
       
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
        


            <tr>
                <td colspan="3"><a href="editprofile">Update Profile</a> </td>
                
            </tr>

            <?php
                }
            }
            ?>
        

         </table>		

         </div>
 	</div>
     
        </div>
 <?php
 include 'inc/footer.php';
 ?>

	