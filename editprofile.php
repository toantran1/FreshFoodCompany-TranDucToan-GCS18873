<?php
include 'inc/header.php';
//include 'inc/slider.php';
?>
 <?php
	 	 $login_check = Session:: get('customer_login');
		  if($login_check == false){
			header('Location:login.html');
		}
	  ?>
<?php
// if(!isset($_GET['proid']) || $_GET['proid'] == NULL){                        // if Id does not exist, it will return catlist page
//     echo "<script> window.location = '404.php'</script>";
// }else{
//     $id = $_GET['proid'];
// 	}
$id = Session::get('customer_id');
if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['save'])){
	  
		$updateCustomers = $cs->update_customers($_POST,$id);
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
		<form action="" method="post">
 		<table class="tblone">
        <tr>
            
                <?php
                if(isset($updateCustomers)){
                    echo '<td colspan="3">'.$updateCustomers.'</td>';
                }
                ?>
            
        </tr>
         <?php
         $id = Session::get('customer_id');
            $get_customers = $cs->show_customers($id);
            if($get_customers){
                while($result = $get_customers->fetch_assoc()){

            
         ?>
            <tr>
                <td>Name </td>
                <td>:</td>
                <td><input type ="text" name="name" value="<?php echo $result['name'] ?>"> </td>
                
            </tr>
         
            <tr>
                <td>Phone number </td>
                <td>:</td>
                <td><input type ="text" name="phone" value="<?php echo $result['phone'] ?>"> </td>
                
            </tr>
               
            <tr>
                <td>Zip-code </td>
                <td>:</td>
                <td><input type ="text" name="zipcode" value="<?php echo $result['zipcode'] ?>"> </td>
         
            </tr>
            <tr>
                <td>Email </td>
                <td>:</td>
                <td><input type ="text" name="email" value="<?php echo $result['email'] ?>"> </td>
                
            </tr>
            <tr>
                <td>Address </td>
                <td>:</td>
                <td><input type ="text" name="address" value="<?php echo $result['address'] ?>"> </td>
               
            </tr>

      
        

            <tr>
                <td colspan="3"><input type="submit" name ="save" value="Save" class="grey"> </td>
                
            </tr>
       
            <?php
                }
            }
            ?>

         </table>	
         </form>	
 		</div>
 	</div>
        </div>
 <?php
 include 'inc/footer.php';
 ?>

	