<?php
$filepath = realpath(dirname(__FILE__));
include_once ($filepath.'/../lib/database.php');
include_once ($filepath.'/../helpers/format.php');
?>

<?php
class brand{

    private $db;             //database 
    private $fm;             //format

    public function __construct(){
        $this-> db = new Database();
        $this-> fm = new Format();

    }

    public function insert_brand($brandName){
        $brandName = $this->fm->validation($brandName);
    
        $brandName = mysqli_real_escape_string($this->db->link, $brandName);
       

        if(empty($brandName)){
            $alert = "<span class='error'>Brand can't be empty. Please try again!!!</span>";
            return $alert;
        }else{
            $query = "INSERT INTO tbl_brand(brandName) VALUES('$brandName')";
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

    public function show_brand(){
        $query = "SELECT * FROM tbl_brand order by brandId desc";
        $result = $this->db->select($query);
        return $result;
    }

    public function update_brand($brandName,$id) {
        $brandName = $this->fm->validation($brandName);
    
        $brandName = mysqli_real_escape_string($this->db->link, $brandName);
        $id = mysqli_real_escape_string($this->db->link, $id);

        if(empty($brandName)){
            $alert = "<span class='error'>Brand can't be empty. Please try again!!!</span>";
            return $alert;
        }else{
            $query = "UPDATE tbl_brand SET brandName = '$brandName' WHERE brandId = '$id'";
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

    public function delete_brand($id){
        $query = "DELETE FROM tbl_brand WHERE brandId ='$id'";
        $result = $this->db->delete($query);
        if($result == true){
            $alert = "<span class ='success'>DELETED SUCCESSFULLY !!!</span>";
            return $alert;
        }else{
            $alert = "<span class ='error'>DELETED FAILED !!!</span>";
            return $alert;
        }
    }

    public function getbrandbyId($id){
        $query = "SELECT * FROM tbl_brand where brandId = '$id' ";
        $result = $this->db->select($query);
        return $result;
    }
}
?>