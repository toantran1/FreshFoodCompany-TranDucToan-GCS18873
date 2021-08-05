<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/category.php';?>
<?php
$filepath = realpath(dirname(__FILE__));
include_once ($filepath.'/../classes/customer.php');
include_once ($filepath.'/../helpers/format.php');
?>
<?php
$cat = new category();

if(!isset($_GET['customerid']) || $_GET['customerid'] == NULL){                        // if Id does not exist, it will return catlist page
    echo "<script> window.location = 'inbox.php'</script>";
}else{
    $id = $_GET['customerid'];
}
$cs = new customer();

    
?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Profile Customer</h2>
            

                <?php
                $get_customer = $cs->show_customers($id);
                if($get_customer){
                    while($result = $get_customer->fetch_assoc()){           
                ?>
               <div class="block copyblock"> 
                 <form action="" method="POST">
                    <table class="form">					
                        <tr>
                        <td>Name</td>
                        <td>:</td>
                            <td>
                                <input type="text" readonly="readonly" value ="<?php echo $result['name']?>" name="name" 
                                class="medium" />
                            </td>
                      
                        </tr>

                        <tr>
                        <td>Address</td>
                        <td>:</td>
                            <td>
                                <input type="text" readonly="readonly" value ="<?php echo $result['address']?>" name="address" 
                                class="medium" />
                            </td>
                        </tr>

                        <tr>                     
                        <td>Phone</td>
                        <td>:</td>
                            <td>
                                <input type="text" readonly="readonly" value ="<?php echo $result['phone']?>" name="phone" 
                                class="medium" />
                            </td>
                        </tr>

                        <tr>
                        <td>Email</td>
                        <td>:</td>
                            <td>
                                <input type="text" readonly="readonly" value ="<?php echo $result['email']?>" name="email" 
                                class="medium" />
                            </td>
                        </tr>

                        <tr>
                        <td>City</td>
                        <td>:</td>
                            <td>
                                <input type="text" readonly="readonly" value ="<?php echo $result['city']?>" name="city" 
                                class="medium" />
                            </td>
                        </tr>
                        <td>Zip-code</td>
                        <td>:</td>
                            <td>
                                <input type="text" readonly="readonly" value ="<?php echo $result['zipcode']?>" name="zipcode" 
                                class="medium" />
                            </td>
                        </tr>
                       
					
                    </table>
                    </form>
                    <?php
                    }
                }
                    ?>
                </div>
            </div>
        </div>
<?php include 'inc/footer.php'; ?>