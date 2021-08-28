<?php
$filepath = realpath(dirname(__FILE__));
include_once ($filepath.'/../lib/database.php');
include_once ($filepath.'/../helpers/format.php');
?>

<?php
class customer{

    private $db;             //database 
    private $fm;             //format

    public function __construct(){
        $this-> db = new Database();
        $this-> fm = new Format();

    }

    public function insert_customers($data){
        $name = mysqli_real_escape_string($this->db->link, $data['name']);
        $city = mysqli_real_escape_string($this->db->link, $data['city']);
        $zipcode = mysqli_real_escape_string($this->db->link, $data['zipcode']);
        $email = mysqli_real_escape_string($this->db->link, $data['email']);
        $address = mysqli_real_escape_string($this->db->link, $data['address']);
        $country = mysqli_real_escape_string($this->db->link, $data['country']);
        $phone = mysqli_real_escape_string($this->db->link, $data['phone']);
        $password = mysqli_real_escape_string($this->db->link, md5($data['password']));
        

        if($name =="" || $city =="" || $zipcode =="" || $email =="" || $address =="" || $country =="" || $phone =="" || $password =="" || $password ==""){
            $alert = "<span class='error'>Fields can't be empty. Please try again!!!</span>";
            return $alert;
        }else{
            $check_email = "SELECT * FROM tbl_customer WHERE email='$email' LIMIT 1";
            $result_check = $this->db->select($check_email);
            if($result_check){
                $alert = "<span class='error'>Email Already Existed. Please try another email. Thanks !!!</span>";
                return $alert;
            }else{
                $query = "INSERT INTO tbl_customer(name,city,zipcode,email,address,country,phone,password) 
                           VALUES('$name','$city','$zipcode','$email','$address','$country','$phone','$password')";

                $result = $this->db->insert($query);
                if($result == true){
                    $alert = "<span class ='success'>Your account created successfull !!!</span>";
                    return $alert;
                }else{
                    $alert = "<span class ='error'>Your account created failded !!!</span>";
                    return $alert;
                }           
            }

        }

    }

    public function login_customers($data){
        $email = mysqli_real_escape_string($this->db->link, $data['email']);
        $password = mysqli_real_escape_string($this->db->link, md5($data['password']));
        

        if( empty($email) || empty($password)){
            $alert = "<span class='error'>Email or password can't be empty. Please try again!!!</span>";
            return $alert;
        }else{
            $check_login = "SELECT * FROM tbl_customer WHERE email='$email' AND password='$password' AND block= '0' ";
            $result_check = $this->db->select($check_login);

            if($result_check){
                $value = $result_check->fetch_assoc();
                Session::set('customer_login',true);
                Session::set('customer_id',$value['id']);
                Session::set('customer_name',$value['name']);
             
                $_SESSION['start']= time();
	            $_SESSION['expire'] = $_SESSION['start'] + (60 * 60);
                header('location:index.html');

            }else if($result_check == false){
                $alert = "<span class='error'>This Account Was Blocked !!!</span>";
                return $alert;

            }else{
                $alert = "<span class='error'>Email or Password doesn't exist. Please try again !!!</span>";
                return $alert;
            }
        }
    }

    public function show_customers($id){
        $query = "SELECT * FROM tbl_customer  WHERE tbl_customer.id='$id' ";
        $result = $this->db->select($query);
        return $result;
    }

    public function update_customers($data,$id){
        $name = mysqli_real_escape_string($this->db->link, $data['name']);
       
        $zipcode = mysqli_real_escape_string($this->db->link, $data['zipcode']);
        $email = mysqli_real_escape_string($this->db->link, $data['email']);
        $address = mysqli_real_escape_string($this->db->link, $data['address']);      
        $phone = mysqli_real_escape_string($this->db->link, $data['phone']);
        
       

        if($name =="" || $zipcode =="" || $email =="" || $address =="" ||  $phone =="" ){
            $alert = "<span class='error'>Fields can't be empty. Please try again!!!</span>";
            return $alert;
        }else{           
                $query = "UPDATE tbl_customer SET name='$name',zipcode='$zipcode',email='$email',address='$address',phone='$phone'  WHERE id ='$id'";
                $result = $this->db->update($query);
                
                if($result == true){
                    $alert = "<span class ='success'>UPDATE SUCCESSFULLY !!!</span>";
                    return $alert;
                }else{
                    $alert = "<span class ='error'>UPDATE FAILDED. PLEASE TRY AGAIN !!!</span>";
                    return $alert;
                }           
            }      
    }

    public function show_customer_account(){
        $query = "SELECT * FROM tbl_customer ORDER BY id ";
        $result_account = $this->db->select($query);
        return $result_account;
    }

    public function activate_account($id){
        $id = mysqli_real_escape_string($this->db->link, $id);

        $code_block = "SELECT block FROM tbl_customer WHERE id = $id ";
        $res_block = $this->db->select($code_block);
        $result_block= $res_block->fetch_object()->{'block'};

        if ($result_block == 0) {
            $query = "UPDATE tbl_customer SET block = '1'
                      WHERE id = '$id' ";
            } else{
            $query = "UPDATE tbl_customer SET block = '0'
                      WHERE id = '$id' ";
            }
            
            $result = $this->db->update($query);
            if($result){
                $msg = "<span style='color: green;'> Action successfull!!!</span>";
                return $msg;; 
            }else{
                $msg = "<span style='color: red;'>  Action failed failded !!!</span>";
                return $msg;
    
            }

        // $query = "UPDATE tbl_customer SET block = '1'
        //           WHERE id = '$id' ";
        // $result = $this->db->update($query);
        // if($result){
        //     $msg = "<span style='color: green;'> Action successfull!!!</span>";
        //     return $msg;; 
        // }else{
        //     $msg = "<span style='color: red;'>  Action failed failded !!!</span>";
        //     return $msg;

        // }
    }


    public function insert_comment(){
        $productId = $_POST['product_id_comment'];
        $userComment = $_POST['usercomment'];
        $comment = $_POST['comment'];
        
        if($userComment =='' || $comment==''){
            $alert= "<span class='error'>Fields can't be empty </span>";
            return $alert;
        }else{
             $query = "INSERT INTO tbl_comment(user_comment,comment_detail,productId) 
                           VALUES('$userComment','$comment','$productId')";

                $result = $this->db->insert($query);
                if($result == true){
                    $alert = "<span class ='success'>Comment successfull !!!</span>";
                    return $alert;
                }else{
                    $alert = "<span class ='error'>Comment failded !!!</span>";
                    return $alert;
                }           

        }

    }

    public function insert_cus_contact($customerid){
       
        $userContact = $_POST['usercontact'];
        $userEmail = $_POST['useremail'];
        $userPhone = $_POST['userphone'];
        $subject = $_POST['subject'];
        
        if($userContact =='' || $userEmail =='' || $userPhone =='' || $subject == ''){
            $alert= "<span class='error'>Fields can't be empty </span>";
            return $alert;
        }else{
             $query = "INSERT INTO tbl_contact(customerId,customerName,customer_email,phone, subject) 
                           VALUES('$customerid','$userContact','$userEmail','$userPhone','$subject')";

                $result = $this->db->insert($query);
                if($result == true){
                    $alert = "<span class ='success'>Send successfull !!!</span>";
                    return $alert;
                   
                }else{
                    $alert = "<span class ='error'>Send failded !!!</span>";
                    return $alert;
                }           

        }   
    }

    public function getUserContact(){
        $query = "SELECT * FROM tbl_contact WHERE contact_status != '2'  ORDER BY date_send desc";
        $get_contact = $this->db-> select($query);
        return $get_contact;
    }

    public function contact_user($id){
        $id = mysqli_real_escape_string($this->db->link, $id);

        $code_contact_status = "SELECT contact_status FROM tbl_contact
                  WHERE id_contact = '$id'";
        $res_contact_status = $this->db->select($code_contact_status);
        $result_contact_status = $res_contact_status->fetch_object()->{'contact_status'};

        if ($result_contact_status == 0) {
            $query = "UPDATE tbl_contact SET contact_status = '1'
                      WHERE id_contact = '$id'";
            }
            $result = $this->db->update($query);
            return $result;
    }

    public function delete_contact_user($id_del){
        $id_del = mysqli_real_escape_string($this->db->link, $id_del);

         $code_contact_status_del = "SELECT contact_status FROM tbl_contact 
                  WHERE id_contact = '$id_del' ";
        $res_contact_status_del = $this->db->select($code_contact_status_del);
        $result_contact_status_del = $res_contact_status_del->fetch_object()->{'contact_status'};

    if ($result_contact_status_del  == 1) {
        $query_del = "UPDATE tbl_contact SET contact_status = '2'
                  WHERE id_contact = '$id_del'";
    }
    $result = $this->db->update($query_del);
    return $result;
    }

    // public function insert_cus_comment($customerId){
    //     $productId = $_POST['product_id_comment'];
    //     $cus_comment = $_POST['customercomment'];
    //     $comment = $_POST['comment'];
        
    //     if( $comment==''){
    //         $alert= "<span class='error'>Fields can't be empty </span>";
    //         return $alert;
    //     }else{
    //          $query = "INSERT INTO tbl_comment(user_comment,comment_detail,productId) 
    //                        VALUES('$cus_comment','$comment','$productId')";

    //             $result = $this->db->insert($query);
    //             if($result == true){
    //                 $alert = "<span class ='success'>Comment successfull !!!</span>";
    //                 return $alert;
    //             }else{
    //                 $alert = "<span class ='error'>Comment failded !!!</span>";
    //                 return $alert;
    //             }           

    //     }

    // }

    public function show_comment($id){
        $query = "SELECT * FROM tbl_comment WHERE productId= '$id'  order by comment_id desc LIMIT 8";
			$result = $this->db->select($query);
			return $result;
    }

    public function show_cus_comment($customerid){
        //TEST===============================================
        $query = "SELECT * FROM tbl_customer WHERE id= '$customerid' ";
        $result = $this->db->select($query);
        return $result;
    }


    public function insert_new_address($address,$customerid) {
        $address =  $this->fm->validation($address);
        $address = mysqli_real_escape_string($this->db->link, $address);
        $customerid = mysqli_real_escape_string($this->db->link, $customerid);

        if(empty($address)){
            $alert= "<span class='error'>Fields can't be empty </span>";
            return $alert;
        }else{
             $query = "INSERT INTO tbl_deliveryaddress(customerId,address_delivery) 
                           VALUES('$customerid','$address')";

                $result = $this->db->insert($query);
                if($result == true){
                    $alert = "<span class ='success'>Add successfull !!!</span>";
                    return $alert;
                }else{
                    $alert = "<span class ='error'>Add failded !!!</span>";
                    return $alert;
                }           

        }      
    }

    public function show_delivery_address($id){
        $query = "SELECT * FROM tbl_deliveryaddress WHERE customerId='$id' ";
        $result = $this->db->select($query);
        return $result;
    }
   
    public function set_default($id, $idaddress){
      
        $id = mysqli_real_escape_string($this->db->link, $id);
      
        // var_dump($result_default_status);
        // exit;
        
        $query = "UPDATE tbl_deliveryaddress SET default_status = '0'
                WHERE customerId = '$id' AND id != '$idaddress' ";
                $this->db->update($query);
        if (  $idaddress) {
            
            $query = "UPDATE tbl_deliveryaddress SET default_status = '1'
                      WHERE customerId = '$id' AND id = '$idaddress' ";
                    
            }
         
            return $this->db->update($query);
    }

    public function show_delivery_address_order($id){
        $query = "SELECT * FROM tbl_deliveryaddress WHERE customerId='$id' AND default_status ='1' ORDER BY id desc";
        $result = $this->db->select($query);
        return $result;
    }

    public function delete_address_delivery($id,$del_address){
        $query =" DELETE FROM tbl_deliveryaddress WHERE id = '$del_address' and customerId = '$id'  ";
        $result = $this->db->delete($query);
        return $result;
    }
}
?>