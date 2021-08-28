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

         //Check image and take images for folder uploads

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

    public function insert_slider($data,$files){
        $sliderName = mysqli_real_escape_string($this->db->link, $data['sliderName']);
        $type = mysqli_real_escape_string($this->db->link, $data['type']);
        $link_slider = mysqli_real_escape_string($this->db->link, $data['link_slider']);
      

        //Check image and take images for folder uploads

        $permited = array('jpg', 'jpeg', 'png', 'gif');
        $file_name = $_FILES['image']['name'];
        $file_size = $_FILES['image']['size'];
        $file_temp = $_FILES['image']['tmp_name'];

        $div = explode('.', $file_name);
        $file_ext = strtolower(end($div));
        $unique_image = substr(md5(time()),0,10).'.'.$file_ext;
        $uploaded_image = "uploads/".$unique_image; 

        if($sliderName =="" || $type =="" || $link_slider == "" ){
            $alert = "<span class='error'>Fields can't be empty. Please try again!!!</span>";
            return $alert;
        }else{
            if(!empty($file_name)){
                //If user chose image
               if($file_size > 5120000){
                    $alert = "<span class ='error'>Image size should be less than 500MB !!!!</span>";
                    return $alert;
               }elseif(in_array($file_ext, $permited)===false){
            
                     $alert = "<span class='error'>You can upload only:-".implode(', ',$permited)."</span>";
                     return $alert;
                }
            move_uploaded_file($file_temp,$uploaded_image);
            $query = "INSERT INTO tbl_slider(sliderName,slider_image,type,link_slider) VALUES('$sliderName','$unique_image','$type','$link_slider')";
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

    }

    public function show_slider(){
        $query ="SELECT * FROM tbl_slider WHERE type = '1' order by id desc";
        $result = $this->db->select($query);
        return $result;
    }

    public function show_slider_admin(){
        $query ="SELECT * FROM tbl_slider order by id desc";
        $result = $this->db->select($query);
        return $result;
    }

    public function delete_slider($del_id){
        $query =" DELETE FROM tbl_slider WHERE id = '$del_id'  ";
        $result = $this->db->delete($query);
        return $result;
    }

    public function show_hide_slider($slider_id){
        $slider_id = mysqli_real_escape_string($this->db->link, $slider_id);
        $code_type ="SELECT type FROM tbl_slider WHERE id = '$slider_id'";
        $res_type =  $this->db->select($code_type);
        $result_type= $res_type->fetch_object()->{'type'};

        if ($result_type == 0) {
            // Show slider
            $query = "UPDATE tbl_slider SET type = '1'
                      WHERE id = '$slider_id' ";
                      
            } else{
            //Hide hide  
            $query = "UPDATE tbl_slider SET type = '0'
                      WHERE id = '$slider_id' ";
                    
            }
            return $this->db->update($query);
    }

    public function show_product(){
        $query = "SELECT tbl_product.*, tbl_category.catName, tbl_brand.brandName
        FROM tbl_product INNER JOIN tbl_category ON tbl_product.catId = tbl_category.catId 
        INNER JOIN tbl_brand on tbl_product.brandId = tbl_brand.brandId
        
                 order by tbl_product.productId desc" ;
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
               if($file_size > 512000){
                    $alert = "<span class ='error'>Image size should be less than 500MB !!!!</span>";
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

    public function show_hide_product($id){
        $id = mysqli_real_escape_string($this->db->link, $id);
        $code_status ="SELECT status FROM tbl_product WHERE productId = $id";
        $res_status =  $this->db->select($code_status);
        $result_status= $res_status->fetch_object()->{'status'};
       
        // $query = "UPDATE tbl_product SET status='1' WHERE productId ='$id' ";
        // $this->del_favor_product($id,NULL);
        // $result = $this->db->update($query);
       
        if ($result_status == 0) {
            // Show product
            $query = "UPDATE tbl_product SET status = '1'
                      WHERE productId = '$id' ";                     
                        //Delete favorite product
                        $this->del_favor_product($id,NULL);
                        $this->delete_product_cart_hide($id,NULL);
                      
            } else{
            //Hide product  
            $query = "UPDATE tbl_product SET status = '0'
                      WHERE productId = '$id' ";
                    
            }
            
            return $this->db->update($query);


        // if($result == true){
        //     $alert = "<span class ='success'>DELETED SUCCESSFULLY !!!</span>";
        //     return $alert;
        // }else{
        //     $alert = "<span class ='error'>DELETED FAILED !!!</span>";
        //     return $alert;
        // }
    }

    public function delete_product_cart_hide($productid,$customerid = NULL ){
     
        if($customerid == NULL){
            $query = "DELETE FROM tbl_cart WHERE productId ='$productid'";
           }else{
            $query = "DELETE FROM tbl_cart WHERE cartId ='$productid' AND  customerId='$customerid'";
           }
            
          
           return  $this->db->delete($query);

    }
    public function del_favor_product($productid,$customerid = NULL){
       if($customerid == NULL){
        $query = "DELETE FROM tbl_favoriteproduct WHERE productId ='$productid'";
       }else{
        $query = "DELETE FROM tbl_favoriteproduct WHERE productId ='$productid' AND  customerId='$customerid'";
       }
        
      
       return  $this->db->delete($query);
         
      
    }

    public function getproductbyId($id){
        $query = "SELECT * FROM tbl_product where productId = '$id' ";
        $result = $this->db->select($query);
        return $result;
    }
    //END BACKEND-----------------

    // START FRONTEND
    public function getproduct_featured(){
        $pr_featured_each_page = 4;
        if(!isset($_GET['featurepage'])){
            $page = 1; 
        }else{
            $page = $_GET['featurepage'];
        }
        $each_feature_page = ($page - 1)* $pr_featured_each_page;
        $query = "SELECT * FROM tbl_product where type = '0'  AND status = '0' order by productId desc LIMIT $each_feature_page,$pr_featured_each_page";
        $result = $this->db->select($query);
        return $result;
    }

    public function get_all_product_featured(){
        $query = "SELECT * FROM tbl_product where type = '0'  AND status = '0'";
        $result = $this->db->select($query);
        return $result;
    }

    public function getproduct_new(){
        $product_each_page = 8;
        if(!isset($_GET['page'])){
            $page = 1; 
        }else{
            $page = $_GET['page'];
        }
        $each_page = ($page - 1)* $product_each_page;
        $query = "SELECT * FROM tbl_product WHERE tbl_product.status = '0' order by productId desc LIMIT $each_page,$product_each_page";
        $result = $this->db->select($query);
        return $result;
    }

    public function get_all_product(){
        $query = "SELECT * FROM tbl_product WHERE tbl_product.status = '0'  ";
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
        $query = "SELECT * FROM tbl_product WHERE brandId ='2' AND status = '0' order by productId desc LIMIT 1 ";
        $result = $this->db->select($query);
        return $result;
    }
    public function getLastestThreeF(){
        $query = "SELECT * FROM tbl_product WHERE brandId ='3'  AND status = '0' order by productId desc LIMIT 1 ";
        $result = $this->db->select($query);
        return $result;
    }
    public function getLastestFreshFood(){
        $query = "SELECT * FROM tbl_product WHERE brandId ='4' AND status = '0' order by productId desc LIMIT 1 ";
        $result = $this->db->select($query);
        return $result;
    }
    public function getLastestHealthyFood(){
        $query = "SELECT * FROM tbl_product WHERE brandId ='5'  AND status = '0' order by productId desc LIMIT 1 ";
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

    public function insert_favorite($productId,$customerId){
        $productId = mysqli_real_escape_string($this->db->link, $productId);
        $customerId = mysqli_real_escape_string($this->db->link, $customerId);
       

        $query = "SELECT * FROM tbl_product WHERE productId ='$productId'";
        $result = $this->db->select($query)->fetch_assoc();
        
        $check_favor_product = "SELECT * FROM tbl_favoriteproduct WHERE productId ='$productId' AND customerId = '$customerId'"; 
        $result_check_favor_product = $this->db->select($check_favor_product);
        if($result_check_favor_product){
                $msg = "<span class ='error'>This Product Already Added to Favorite!</span>";
                return $msg;

        }else{

        $image = $result['image']; 
        $price = $result['price']; 
        $productName = $result['productName']; 


            $query_insert = "INSERT INTO tbl_favoriteproduct(productId,image,price,customerId, productName) 
                                VALUES('$productId','$image','$price','$customerId','$productName')";
            $insert_favor = $this->db->insert($query_insert);

            if($insert_favor){
                $alert = "<span class ='success'>Added Favorite Product Successfull !!!</span>";
                return $alert;
            }else{
                $alert = "<span class ='error'>ADD Failed !!!</span>";
                return $alert;
            }
        }    
    }

    public function getvegetable(){
        $vegetable_each_page = 8;
        if(!isset($_GET['vegepage'])){
            $page = 1; 
        }else{
            $page = $_GET['vegepage'];
        }
        $pr_vege_each_page = ($page - 1)* $vegetable_each_page;
        $query = "SELECT * FROM tbl_product WHERE catId ='7'  AND status = '0' LIMIT $pr_vege_each_page,$vegetable_each_page";
        $result = $this->db->select($query);
        return $result;
    }
    
    
    public function getfruit(){
        $fruit_each_page = 8;
        if(!isset($_GET['fruitpage'])){
            $page = 1; 
        }else{
            $page = $_GET['fruitpage'];
        }
        $pr_fruit_each_page = ($page - 1)* $fruit_each_page;
        $query = "SELECT * FROM tbl_product WHERE catId ='8'  AND status = '0' LIMIT $pr_fruit_each_page,$fruit_each_page ";
        $result = $this->db->select($query);
        return $result;
    }

    public function getmeat(){
        $meat_each_page = 8;
        if(!isset($_GET['meatpage'])){
            $page = 1; 
        }else{
            $page = $_GET['meatpage'];
        }
        $pr_meat_each_page = ($page - 1)* $meat_each_page;
        $query = "SELECT * FROM tbl_product WHERE catId ='6'  AND status = '0' LIMIT $pr_meat_each_page,$meat_each_page";
        $result = $this->db->select($query);
        return $result;
    }
    
    public function getchicken(){
        $chicken_each_page = 8;
        if(!isset($_GET['chickenpage'])){
            $page = 1; 
        }else{
            $page = $_GET['chickenpage'];
        }
        $pr_chicken_each_page = ($page - 1)* $chicken_each_page;
        $query = "SELECT * FROM tbl_product WHERE catId ='3'  AND status = '0' LIMIT $pr_chicken_each_page,$chicken_each_page";
        $result = $this->db->select($query);
        return $result;
    }

    public function getfish(){
        $fish_each_page = 8;
        if(!isset($_GET['fishpage'])){
            $page = 1; 
        }else{
            $page = $_GET['fishpage'];
        }
        $pr_fish_each_page = ($page - 1)* $fish_each_page;
        $query = "SELECT * FROM tbl_product WHERE catId ='2'  AND status = '0' LIMIT $pr_fish_each_page, $fish_each_page";
        $result = $this->db->select($query);
        return $result;
    }

    public function product_vegetable(){
        $query = "SELECT * FROM tbl_product WHERE catId ='7'  AND status = '0' ";
        $result = $this->db->select($query);
        return $result;
    }

    public function product_fruit(){
        $query = "SELECT * FROM tbl_product WHERE catId ='8'  AND status = '0' ";
        $result = $this->db->select($query);
        return $result;
    }

    public function product_meat(){
        $query = "SELECT * FROM tbl_product WHERE catId ='6'  AND status = '0' ";
        $result = $this->db->select($query);
        return $result;
    }

    public function product_chicken(){
        $query = "SELECT * FROM tbl_product WHERE catId ='3'  AND status = '0' ";
        $result = $this->db->select($query);
        return $result;
    }

    public function product_fish(){
        $query = "SELECT * FROM tbl_product WHERE catId ='2'  AND status = '0' ";
        $result = $this->db->select($query);
        return $result;
    }

    public function search_product($search){
        $query ="SELECT * FROM tbl_product WHERE LOWER(productName) like '%$search%' OR LOWER(product_desc) like '%$search%' OR price like '%$search%'";
        $min_length = 3;
        $result_search = $this->db->select($query);
        if(strlen($search) >= $min_length){
            return $result_search;
        }

    }
 
    
 
  
    
}
?>