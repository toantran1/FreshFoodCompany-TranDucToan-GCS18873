<?php
$filepath = realpath(dirname(__FILE__));
include_once ($filepath.'/../lib/database.php');
include_once ($filepath.'/../helpers/format.php');
?>

<?php
class cart{

    private $db;             //database 
    private $fm;             //format

    public function __construct(){
        $this-> db = new Database();
        $this-> fm = new Format();

    }



    public function add_to_cart($quantity,$id){
        
        $quantity = $this->fm->validation($quantity);
        $quantity = mysqli_real_escape_string($this->db->link, $quantity);
        $id = mysqli_real_escape_string($this->db->link, $id);
        $sId = session_id();

        $query = "SELECT * FROM tbl_product WHERE productId ='$id'";
        $result = $this->db->select($query)->fetch_assoc();
        
        $image = $result['image']; 
        $price = $result['price']; 
        $productName = $result['productName']; 

        $check_cart ="SELECT * FROM tbl_cart WHERE productId ='$id' AND sId ='$sId'";
        $result_check = $this->db->select($check_cart);
        if($result_check){
            $msg = "Product already added";
            return $msg;
        }else{

            $query_insert = "INSERT INTO tbl_cart(productId,quantity,sId,image,price,productName) 
                                VALUES('$id','$quantity','$sId','$image','$price','$productName')";
            $insert_cart = $this->db->insert($query_insert);

            if($insert_cart){
                header('location:cart.html');
            }else{
                header('location:404.html'); 
                } 
            }         
    }
    public function get_product_cart(){
        $sId = session_id();
        $query = "SELECT * FROM tbl_cart WHERE sId ='$sId'";
        $result = $this->db->select($query);

        return $result;
    }

   
    public function update_quantity_cart($quantity,$cartId){
        $quantity = $this->fm->validation($quantity);
        $cartId = $this->fm->validation($cartId);

        $quantity = mysqli_real_escape_string($this->db->link, $quantity);
        $cartId = mysqli_real_escape_string($this->db->link, $cartId);
        $query = "UPDATE tbl_cart SET quantity = '$quantity' WHERE cartId = '$cartId'";
        $result = $this->db->update($query);
        if($result){
            header('location:cart.html'); 
        }else{
            $msg = "<span style='color: red;'> Product quantity update failed!!!</span>";
            return $msg;

        }
    }
    
    public function delete_product_cart($cartId){
        $cartId = mysqli_real_escape_string($this->db->link, $cartId);
        $query = "DELETE FROM tbl_cart WHERE cartId ='$cartId'";
        $result = $this->db->delete($query);
        if($result){
            header('location:cart.html');           
        }else{
            $msg = "<span style='color: red;'> Product delete failed!!!</span>";
            return $msg;

        }
    }
    public function check_cart(){
        $sId = session_id();
        $query = "SELECT * FROM tbl_cart WHERE sId ='$sId'";
        $result = $this->db->select($query);
        return $result;
    }

    public function check_bill($customerid){
        
        $query = "SELECT * FROM tbl_bill WHERE customerId ='$customerid'";
        $result = $this->db->select($query);
        return $result;
    }



    public function del_all_data_cart(){
        $sId = session_id();
        $query = "DELETE FROM tbl_cart WHERE sId ='$sId'";
        $result = $this->db->select($query);
        return $result;
    }

    public function del_all_data_compare($customerid){
        $sId = session_id();
        $query = "DELETE FROM tbl_compare WHERE customerId ='$customerid'";
        $result = $this->db->delete($query);
        return $result;
    }

 //BILL
 public function insert_bill($customerid){
    $delivery_address= $_POST['delivery_address'];
    $name = $_POST['name'];
    $email = $_POST['email'];

    if($delivery_address ==''){
        $alert= "<span class='error'>Fields can't be empty </span>";
            return $alert;
    }else{
        // $code_bill = rand(9999,111111);
        
        $permitted_chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        $_SESSION['code_bill'] = substr(str_shuffle($permitted_chars), 0, 15);
        $code_bill = $_SESSION['code_bill'];
        $customerId= $customerid;

        $query_order_cus = "INSERT INTO tbl_bill(code_bill,customerId,customerName,email,address_delivery) 
                            VALUES('$code_bill','$customerId','$name','$email','$delivery_address')";

        $insert_order_cus = $this->db->insert($query_order_cus);

        $sId = session_id();
      
        $query = "SELECT * FROM tbl_cart WHERE sId ='$sId'";        
        $get_product = $this->db->select($query);       
     
        if($get_product){
            while($result = $get_product->fetch_assoc()){
                
                $productId = $result['productId'];            
                $productName = $result['productName'];
                $quantity = $result['quantity'];
                $price = $result['price'] * $quantity;
                $image = $result['image'];
                $customerId = $customerid;
                $bill_id = $code_bill;
            
                $query_order = "INSERT INTO tbl_order(bill_id,productId,productName,quantity,price,image,customerId) 
                                VALUES('$bill_id','$productId','$productName','$quantity','$price','$image','$customerId')";

                $insert_order = $this->db->insert($query_order);
                   
            }
           
        }   
        
    
}

    // $query_cus = "SELECT * FROM tbl_customer WHERE tbl_customer.id = '$customerid' ";
    // $res_cus = $this->db->select($query_cus);

    // if($res_cus){
    //     while($get_cus = $res_cus->fetch_assoc()){
    //         $customerName = $get_cus['name'];
            // $code_bill = rand(0,9999);
            // $customerId= $customerid;
            // // $delivery_address = $get_cus['address_delivery']; 
          
            // $query_order_cus = "INSERT INTO tbl_bill(code_bill,customerId,customerName,address_delivery) 
            //                     VALUES('$code_bill','$customerId','$name','$delivery_address')";

            // $insert_order_cus = $this->db->insert($query_order_cus);
         
    //     }
    // }
    // $id = msqli_insert_id();
    // var_dump($id);
    // exit;

}

    // public function insertOrder($customerid){
    //     $sId = session_id();  
    //     $query = "SELECT * FROM tbl_cart WHERE sId ='$sId'";        
    //     $get_product = $this->db->select($query);       
     
    //     if($get_product){
    //         while($result = $get_product->fetch_assoc()){
                
    //             $productId = $result['productId'];            
    //             $productName = $result['productName'];
    //             $quantity = $result['quantity'];
    //             $price = $result['price'] * $quantity;
    //             $image = $result['image'];
    //             $customerId = $customerid;

    //             $query_order = "INSERT INTO tbl_order(productId,productName,quantity,price,image,customerId) 
    //                             VALUES('$productId','$productName','$quantity','$price','$image','$customerId')";

    //             $insert_order = $this->db->insert($query_order);
                   
    //         }
           
    //     }
    // }

    public function get_bill($customerid){
        $query = "SELECT * FROM tbl_bill WHERE customerId = '$customerid' ORDER BY bill_id desc";
        $get_ordered_bill = $this->db-> select($query);
        return $get_ordered_bill;
    }

    public function getTotalPrice($customerid,$code_bill){
        
        $query = "SELECT price FROM tbl_order WHERE customerId = '$customerid' AND bill_id= '$code_bill'";
        $get_price = $this->db-> select($query);
        if($get_price){
            return $get_price;
        }else{
            $query_delete_bill = "DELETE FROM tbl_bill WHERE customerId = '$customerid' AND code_bill= '$code_bill'";
            $de_bill = $this->db-> delete($query_delete_bill);
        }
    }

    public function get_ordered_detail($customerid,$code_bill){
        
        $query = "SELECT * FROM tbl_order WHERE customerId = '$customerid' AND bill_id= '$code_bill' ";
        $get_ordered_detail = $this->db-> select($query);
        return $get_ordered_detail;
    }

    public function getInboxBill(){
        $query = "SELECT * FROM tbl_bill WHERE status != '3' ORDER BY date_order desc";
        $get_inbox_bill = $this->db-> select($query);
        return $get_inbox_bill;
    }

    // public function processed($id,$time,$price){
    //     $id = mysqli_real_escape_string($this->db->link, $id);
    //     $time = mysqli_real_escape_string($this->db->link, $time);
    //     $price = mysqli_real_escape_string($this->db->link, $price);

    //     $query = "UPDATE tbl_order SET status = '1'
    //               WHERE id = '$id' AND dateOrder = '$time' AND price = '$price'";
    //     $result = $this->db->update($query);
    //     if($result){
    //         $msg = "<span style='color: green;'> Update order successfully !!!</span>";
    //         return $msg;; 
    //     }else{
    //         $msg = "<span style='color: red;'>  Update order failded !!!</span>";
    //         return $msg;

    //     }
    // }

    public function processed($id,$time){
        $id = mysqli_real_escape_string($this->db->link, $id);
        $time = mysqli_real_escape_string($this->db->link, $time);
        

        $code_status = "SELECT status FROM tbl_bill 
                  WHERE bill_id = '$id' AND date_order = '$time'";
        $res_status = $this->db->select($code_status);
        $result_status = $res_status->fetch_object()->{'status'};

        if ($result_status == 0) {
            $query = "UPDATE tbl_bill SET status = '1'
                      WHERE bill_id = '$id' AND date_order = '$time'";
            }
            // else{
            //     $query = "UPDATE tbl_order SET status = '2'
            //     WHERE id = '$id' AND dateOrder = '$time' AND price = '$price' ";
            // }
            $result = $this->db->update($query);
            return $result;

        // if($result){
        //     $msg = "<span style='color: green;'> Update order successfully !!!</span>";
        //     return $msg;; 
        // }else{
        //     $msg = "<span style='color: red;'>  Update order failded !!!</span>";
        //     return $msg;

        // }
    }

    public function delete_completed_orer($id,$time){
        $id = mysqli_real_escape_string($this->db->link, $id);
        $time = mysqli_real_escape_string($this->db->link, $time);
      

         $code_status_del = "SELECT status FROM tbl_bill 
                  WHERE bill_id = '$id' AND date_order = '$time'";
        $res_status_del = $this->db->select($code_status_del);
        $result_status_del = $res_status_del->fetch_object()->{'status'};
    //     $query = "DELETE FROM tbl_order 
    //               WHERE id = '$id' AND dateOrder = '$time' AND price = '$price'";

    //      $result = $this->db->delete($query);
    //      if($result){
    //          $msg = "<span style='color: green;'> Delete order successfully !!!</span>";
    //          return $msg;; 
    //      }else{
    //          $msg = "<span style='color: red;'> Can't delete this order !!!</span>";
    //          return $msg;        
    // }

    if ($result_status_del == 2) {
        $query = "UPDATE tbl_bill SET status = '3'
                  WHERE bill_id = '$id' AND date_order = '$time' ";
    }
    $result = $this->db->update($query);
    return $result;
    
}
    public function received($id,$time){
        $id = mysqli_real_escape_string($this->db->link, $id);
        $time = mysqli_real_escape_string($this->db->link, $time);
        

        $query = "UPDATE tbl_bill SET status = '2' 
                  WHERE bill_id = '$id' AND date_order = '$time' ";
        $result = $this->db->update($query);
        return $result;
       
    }

//     public function received($id,$time,$price){
//         $id = mysqli_real_escape_string($this->db->link, $id);
//         $time = mysqli_real_escape_string($this->db->link, $time);
//         $price = mysqli_real_escape_string($this->db->link, $price);

//          $code_received = "SELECT status FROM tbl_order 
//                   WHERE id = '$id' AND dateOrder = '$time' AND price = '$price'";
//         $res_received = $this->db->select($code_received);
//         $result_received = $res_received->fetch_object()->{'status'};

//         if ($result_received == 1) {
//             $query = "UPDATE tbl_order SET status = '2'
//                       WHERE id = '$id' AND dateOrder = '$time' AND price = '$price' ";
//             }
//             $result = $this->db->update($query);
//             return $result;

   
// }

    // public function delete_order_detail($id){
    //     $id = mysqli_real_escape_string($this->db->link, $id);
    //     // $time = mysqli_real_escape_string($this->db->link, $time);
    //     // $price = mysqli_real_escape_string($this->db->link, $price);

    //     $query = "DELETE FROM tbl_order 
    //               WHERE id = '$id' ";
    //      $result = $this->db->delete($query);
    //      return $result;
    // }

    public function get_compare_product($customerId){
        $query = "SELECT * FROM tbl_compare WHERE customerId = '$customerId' ORDER BY id desc";
        $result = $this->db-> select($query);
        return $result;
    }

    public function get_favor_product($customerId){
        $query = "SELECT * FROM tbl_favoriteproduct WHERE customerId = '$customerId' ORDER BY id desc";
        $result = $this->db-> select($query);
        return $result;
    }

    public function del_pre_product($productId){
        $query= "DELETE FROM tb_product, tb_favoriteproduct WHERE $productId.tb_product = productId.tb_favoriteproduct";
        $result = $this->db->delete($query);
        return $result;
    }

    // public function insert_delivery($customerid){
    //     $order = $_GET['orderid'];
    //     $address = $_GET['delivery_address'];

    //     if($address ==''){
    //         $alert= "<span class='error'>Fields can't be empty </span>";
    //         return $alert;
    //     }else{
    //          $query = "INSERT INTO tbl_deliveryaddress(customerId,address) 
    //                        VALUES('$customerid','$address')";

    //             $result = $this->db->insert($query);
    //     }

    // }

  
}
?>