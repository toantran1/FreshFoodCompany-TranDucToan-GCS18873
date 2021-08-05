<?php
$filepath = realpath(dirname(__FILE__));
include_once ($filepath.'/../lib/database.php');
include_once ($filepath.'/../helpers/format.php');
?>

<?php
class category{

    private $db;             //database 
    private $fm;             //format

    public function __construct(){
        $this-> db = new Database();
        $this-> fm = new Format();

    }

    public function insert_category($catName){
        $catName = $this->fm->validation($catName);
    
        $catName = mysqli_real_escape_string($this->db->link, $catName);
       

        if(empty($catName)){
            $alert = "<span class='error'>Category can't be empty. Please try again!!!</span>";
            return $alert;
        }else{
            $query = "INSERT INTO tbl_category(catName) VALUES('$catName')";
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

    public function show_category(){
        $query = "SELECT * FROM tbl_category order by catId desc";
        $result = $this->db->select($query);
        return $result;
    }

    public function update_category($catName,$id) {
        $catName = $this->fm->validation($catName);
    
        $catName = mysqli_real_escape_string($this->db->link, $catName);
        $id = mysqli_real_escape_string($this->db->link, $id);

        if(empty($catName)){
            $alert = "<span class='error'>Category can't be empty. Please try again!!!</span>";
            return $alert;
        }else{
            $query = "UPDATE tbl_category SET catName = '$catName' WHERE catId = '$id'";
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

    public function delete_category($id){
        $query = "DELETE FROM tbl_category WHERE catId ='$id'";
        $result = $this->db->delete($query);
        if($result == true){
            $alert = "<span class ='success'>DELETED SUCCESSFULLY !!!</span>";
            return $alert;
        }else{
            $alert = "<span class ='error'>DELETED FAILED !!!</span>";
            return $alert;
        }
    }

    public function getcatbyId($id){
        $query = "SELECT * FROM tbl_category where catId = '$id' ";
        $result = $this->db->select($query);
        return $result;
    }

    public function show_category_frontend(){
        $query = "SELECT * FROM tbl_category order by catId desc";
        $result = $this->db->select($query);
        return $result;
    }

    public function get_product_by_cat($id){
        $query = "SELECT * FROM tbl_product WHERE catId = '$id' order by catId desc LIMIT 8";
        $result = $this->db->select($query);
        return $result;

    }

    public function get_name_by_cat($id){
        $query = "SELECT tbl_product.*, tbl_category.catName, tbl_category.catId FROM tbl_product, tbl_category
                  WHERE tbl_product.catId = tbl_category.catId AND tbl_product.catId ='$id' LIMIT 1";
        $result = $this->db->select($query);
        return $result;
    }
}
?>