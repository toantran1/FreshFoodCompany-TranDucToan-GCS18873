<?php
$filepath = realpath(dirname(__FILE__));
include_once ($filepath.'/../lib/database.php');
include_once ($filepath.'/../helpers/format.php');
?>

<?php
class product{

    private $db;             //database 
    private $fm;             //format

    public function __construct(){
        $this-> db = new Database();
        $this-> fm = new Format();

    }

    public function insert_product($data,$files){
        
    
        $productName = mysqli_real_escape_string($this->db->link, $data['productName']);
        $brand = mysqli_real_escape_string($this->db->link, $data['brand']);
        $category = mysqli_real_escape_string($this->db->link, $data['category']);
        $product_desc = mysqli_real_escape_string($this->db->link, $data['product_desc']);
        $price = mysqli_real_escape_string($this->db->link, $data['price']);
        $type = mysqli_real_escape_string($this->db->link, $data['type']);

        //Kiem tra hinh anh va lay hinh anh cho vao folder upload

        $permited = array('jpg', 'jpeg', 'png', 'gif');
        $file_name = $_FILES['image']['name'];
        $file_size = $_FILES['image']['size'];
        $file_temp = $_FILES['image']['tmp_name'];

        $div = explode('.', $file_name);
        $file_ext = strtolower(end($div));
        $unique_image = substr(md5(time()),0,10).'.'.$file_ext;
        $uploaded_image = "uploads/".$unique_image; 
     

        if($productName =="" || $brand =="" || $category =="" || $product_desc =="" || $price =="" || $type =="" || $file_name ==""){
            $alert = "<span class='error'>Fields can't be empty. Please try again!!!</span>";
            return $alert;
        }else{
            move_uploaded_file($file_temp,$uploaded_image);
            $query = "INSERT INTO tbl_product(productName,brandId,catId,product_desc,price,type,image) VALUES('$productName','$brand','$category','$product_desc','$price','$type','$unique_image')";
            $result = $this->db->insert($query);
            if($result == true){
                $alert = "<span class ='success'>ADD SUCCESSFULLY !!!</span>";
                return $alert;
            }else{
                $alert = "<span class ='error'>ADD Failed !!!</span>";
                return $alert;
            }           
        }
    }

    public function show_product(){
        $query = "SELECT tbl_product.*, tbl_category.catName, tbl_brand.brandName
        FROM tbl_product INNER JOIN tbl_category ON tbl_product.catId = tbl_category.catId
        INNER JOIN tbl_brand on tbl_product.brandId = tbl_brand.brandId
                 order by tbl_product.productId desc";
        $result = $this->db->select($query);
        return $result;
    }

    public function update_product($data,$files,$id) {

        $productName = mysqli_real_escape_string($this->db->link, $data['productName']);
        $brand = mysqli_real_escape_string($this->db->link, $data['brand']);
        $category = mysqli_real_escape_string($this->db->link, $data['category']);
        $product_desc = mysqli_real_escape_string($this->db->link, $data['product_desc']);
        $price = mysqli_real_escape_string($this->db->link, $data['price']);
        $type = mysqli_real_escape_string($this->db->link, $data['type']);

        //Kiem tra hinh anh va lay hinh anh cho vao folder upload

        $permited = array('jpg', 'jpeg', 'png', 'gif');
        $file_name = $_FILES['image']['name'];
        $file_size = $_FILES['image']['size'];
        $file_temp = $_FILES['image']['tmp_name'];

        $div = explode('.', $file_name);
        $file_ext = strtolower(end($div));
        $unique_image = substr(md5(time()),0,10).'.'.$file_ext;
        $uploaded_image = "uploads/".$unique_image; 

        if($productName =="" || $brand =="" || $category =="" || $product_desc =="" || $price =="" || $type =="" ){
            $alert = "<span class='error'>Fields can't be empty. Please try again!!!</span>";
            return $alert;
        }else{
            if(!empty($file_name)){
                //If user chose image
               if($file_size > 51200){
                    $alert = "<span class ='error'>Image size should be less than 50MB !!!!</span>";
                    return $alert;
               }elseif(in_array($file_ext, $permited)===false){
            
                     $alert = "<span class='error'>You can upload only:-".implode(', ',$permited)."</span>";
                     return $alert;
                }
            move_uploaded_file($file_temp,$uploaded_image);
            $query = "UPDATE tbl_product SET
             productName = '$productName', 
             brandId = '$brand', 
             catId = '$category', 
             type = '$type', 
             price = '$price', 
             image = '$unique_image', 
             product_desc = '$product_desc' 

             WHERE productId = '$id'";
              
            }else{
            //If user don't chose image
            move_uploaded_file($file_temp,$uploaded_image);

            $query = "UPDATE tbl_product SET
             productName = '$productName', 
             brandId = '$brand', 
             catId = '$category', 
             type = '$type', 
             price = '$price', 
             product_desc = '$product_desc'

             WHERE productId = '$id'";

        }     
            
            $result = $this->db->insert($query);
            if($result == true){
                $alert = "<span class ='success'>UPDATE SUCCESSFULLY !!!</span>";
                return $alert;
            }else{
                $alert = "<span class ='error'>UPDATE FAILED !!!</span>";
                return $alert;
            }          
        }
    }

    public function delete_product($id){
        $query = "DELETE FROM tbl_product WHERE productId ='$id'";
        $result = $this->db->delete($query);
        if($result == true){
            $alert = "<span class ='success'>DELETED SUCCESSFULLY !!!</span>";
            return $alert;
        }else{
            $alert = "<span class ='error'>DELETED FAILED !!!</span>";
            return $alert;
        }
    }

    public function getproductbyId($id){
        $query = "SELECT * FROM tbl_product where productId = '$id' ";
        $result = $this->db->select($query);
        return $result;
    }
    //END BACKEND-----------------

    // START FRONTEND
    public function getproduct_featured(){
        $query = "SELECT * FROM tbl_product where type = '0' ";
        $result = $this->db->select($query);
        return $result;
    }

    public function getproduct_new(){
        $query = "SELECT * FROM tbl_product order by productId desc LIMIT 4 ";
        $result = $this->db->select($query);
        return $result;
    }

    public function get_details($id){
        $query = "SELECT tbl_product.*, tbl_category.catName, tbl_brand.brandName
        FROM tbl_product INNER JOIN tbl_category ON tbl_product.catId = tbl_category.catId
        INNER JOIN tbl_brand on tbl_product.brandId = tbl_brand.brandId WHERE tbl_product.productId ='$id'
                 ";
        $result = $this->db->select($query);
        return $result;

    }
    public function getLastestFarmerMarkets(){
        $query = "SELECT * FROM tbl_product WHERE brandId ='2' order by productId desc LIMIT 1 ";
        $result = $this->db->select($query);
        return $result;
    }
    public function getLastestThreeF(){
        $query = "SELECT * FROM tbl_product WHERE brandId ='3' order by productId desc LIMIT 1 ";
        $result = $this->db->select($query);
        return $result;
    }
    public function getLastestFreshFood(){
        $query = "SELECT * FROM tbl_product WHERE brandId ='4' order by productId desc LIMIT 1 ";
        $result = $this->db->select($query);
        return $result;
    }
    public function getLastestHealthyFood(){
        $query = "SELECT * FROM tbl_product WHERE brandId ='5' order by productId desc LIMIT 1 ";
        $result = $this->db->select($query);
        return $result;
    }

    public function insert_compare($productId,$customerId){
        $productId = mysqli_real_escape_string($this->db->link, $productId);
        $customerId = mysqli_real_escape_string($this->db->link, $customerId);
       

        $query = "SELECT * FROM tbl_product WHERE productId ='$productId'";
        $result = $this->db->select($query)->fetch_assoc();
        
        $check_compare_product = "SELECT * FROM tbl_compare WHERE productId ='$productId' AND customerId = '$customerId'"; 
        $result_check_compare_product = $this->db->select($check_compare_product);
        if($result_check_compare_product){
                $msg = "<span class ='error'>This Product Already Added!</span>";
                return $msg;

        }else{

        $image = $result['image']; 
        $price = $result['price']; 
        $productName = $result['productName']; 


            $query_insert = "INSERT INTO tbl_compare(productId,image,price,customerId, productName) 
                                VALUES('$productId','$image','$price','$customerId','$productName')";
            $insert_compare = $this->db->insert($query_insert);

            if($insert_compare){
                $alert = "<span class ='success'>Added successfull !!!</span>";
                return $alert;
            }else{
                $alert = "<span class ='error'>ADD Failed !!!</span>";
                return $alert;
            }
        }       
    }        
    
}
?>