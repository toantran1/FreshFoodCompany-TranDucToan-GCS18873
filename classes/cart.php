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
                header('location:cart.php');
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
            header('location:cart.php'); 
        }else{
            $msg = "<span style='color: red;'> Product quantity update failed!!!</span>";
            return $msg;

        }
    }
    
    public function delete_product_cart($cartid){
        $cartid = mysqli_real_escape_string($this->db->link, $cartid);
        $query = "DELETE FROM tbl_cart WHERE cartId ='$cartid'";
        $result = $this->db->delete($query);
        if($result){
            header('location:cart.php');           
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

    public function check_order($customerid){
        $sId = session_id();
        $query = "SELECT * FROM tbl_order WHERE customerId ='$customerid'";
        $result = $this->db->select($query);
        return $result;
    }



    public function del_all_data_cart(){
        $sId = session_id();
        $query = "DELETE FROM tbl_cart WHERE sId ='$sId'";
        $result = $this->db->select($query);
        return $result;
    }

    public function insertOrder($customerid){
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

                $query_order = "INSERT INTO tbl_order(productId,productName,quantity,price,image,customerId) 
                VALUES('$productId','$productName','$quantity','$price','$image','$customerId')";
                $insert_order = $this->db->insert($query_order);

              
         
            }
        }
    }

    public function getTotalPrice($customerid){
        $sId = session_id();
        $query = "SELECT price FROM tbl_order WHERE customerId = '$customerid'";
        $get_price = $this->db-> select($query);
        return $get_price;
    }

    public function get_ordered_detail($customerid){
        
        $query = "SELECT * FROM tbl_order WHERE customerId = '$customerid'";
        $get_ordered_detail = $this->db-> select($query);
        return $get_ordered_detail;
    }

    public function getInboxCart(){
        $query = "SELECT * FROM tbl_order ORDER BY dateOrder";
        $get_inbox_cart = $this->db-> select($query);
        return $get_inbox_cart;
    }

    public function processed($id,$time,$price){
        $id = mysqli_real_escape_string($this->db->link, $id);
        $time = mysqli_real_escape_string($this->db->link, $time);
        $price = mysqli_real_escape_string($this->db->link, $price);

        $query = "UPDATE tbl_order SET status = '1'
                  WHERE id = '$id' AND dateOrder = '$time' AND price = '$price'";
        $result = $this->db->update($query);
        if($result){
            $msg = "<span style='color: green;'> Update order successfully !!!</span>";
            return $msg;; 
        }else{
            $msg = "<span style='color: red;'>  Update order failded !!!</span>";
            return $msg;

        }
    }

    public function delete_completed_orer($id,$time,$price){
        $id = mysqli_real_escape_string($this->db->link, $id);
        $time = mysqli_real_escape_string($this->db->link, $time);
        $price = mysqli_real_escape_string($this->db->link, $price);

        $query = "DELETE FROM tbl_order 
                  WHERE id = '$id' AND dateOrder = '$time' AND price = '$price'";
         $result = $this->db->delete($query);
         if($result){
             $msg = "<span style='color: green;'> Delete order successfully !!!</span>";
             return $msg;; 
         }else{
             $msg = "<span style='color: red;'> Can't delete this order !!!</span>";
             return $msg;        
    }
}
    public function received($id,$time,$price){
        $id = mysqli_real_escape_string($this->db->link, $id);
        $time = mysqli_real_escape_string($this->db->link, $time);
        $price = mysqli_real_escape_string($this->db->link, $price);

        $query = "UPDATE tbl_order SET status = '2' 
                  WHERE id = '$id' AND dateOrder = '$time' AND price = '$price'";
        $result = $this->db->update($query);
        return $result;
       
    }

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
}
?>