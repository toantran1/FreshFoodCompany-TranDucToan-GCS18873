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
        $cpassword = mysqli_real_escape_string($this->db->link, md5($data['cpassword']));

        $secret="6LekTlIcAAAAAK9klG4XghAc6UOy6f3x3O93xpwl";
        $captcha = $_POST['g-recaptcha-response'];
        $url= file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secret&response=$captcha");
        $responseData = json_decode($url);
        if(!$responseData->success){
            $alert = "<span class ='error'>You need to validate Captcha before submit form !!!</span>";
            return $alert;
        }else{
        if($password != $cpassword){
            $alert = "<span class ='error'>Confirm password not matched !!!</span>";
                return $alert;
        }

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


                //code verified
                $code = rand(999999, 111111);
                $status = "notverified";

                $query = "INSERT INTO tbl_customer(name,city,zipcode,email,address,country,phone,password, code, status) 
                           VALUES('$name','$city','$zipcode','$email','$address','$country','$phone','$password', '$code','$status')";

                $result = $this->db->insert($query);
                if($result == true){
                    $subject = "Email Verification Code";
                    $message = "Your verification code is $code";
                    $sender = "From: toan.job@gmail.com";
                    if(mail($email, $subject, $message, $sender)){                  //PHP function send mail
                        $info = "We've sent a verification code to your email - $email";
                        $_SESSION['info'] = $info;
                        $_SESSION['email'] = $email;
                        $_SESSION['password'] = $password;
                        header('location: user-otp.html');
                        exit();
                    // $alert = "<span class ='success'>Your account created successfull !!!</span>";
                    // return $alert;
                }else{
                    $alert = "<span class ='error'>Failed while sending Code!!!</span>";
                     return $alert;
                    // $alert = "<span class ='error'>Your account created failded !!!</span>";
                    // return $alert;
                }           
            }else{
                $alert = "<span class ='error'>Your account created failded !!!</span>";
                return $alert;
            }
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
            $check_block= "SELECT * FROM tbl_customer WHERE email='$email' AND password='$password' AND block= '1' ";
            $result_check_block = $this->db->select($check_block);
            if($result_check_block){           
                $alert = "<span class='error'>This Account Was Blocked !!!</span>";
                return $alert;
            }


            $check_login = "SELECT * FROM tbl_customer WHERE email='$email' AND password='$password' AND block= '0'";
            $result_check = $this->db->select($check_login);
            

            if($result_check){
                $value = $result_check->fetch_assoc();
              

                if($value['status']=='verified'){
                    Session::set('customer_login',true);
                    Session::set('customer_id',$value['id']);
                    Session::set('customer_name',$value['name']);
                    
                
                    
                    $_SESSION['start']= time();
                    $_SESSION['expire'] = $_SESSION['start'] + (60 * 60);
                    
                    header('location:index.html');
                }elseif($value['status']=='notverified'){
                    $info = "It's look like you haven't still verify your email - $email";
                    $_SESSION['info'] = $info;  
                   
                    
                    $_SESSION['email'] = $email;                
                    header('location: user-otp.html');
                    
                   
                }
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

    //FORGOT PASSWORD HERE
    //if user click continue button in forgotpassword form
    public function check_email(){
        $email = $_POST['email'];
        $checkEmail ="SELECT * FROM tbl_customer WHERE email='$email'";
        $res_checkEmail = $this->db->select($checkEmail);

        if($res_checkEmail){
            $code = rand(999999, 111111);
            $insert_code = "UPDATE tbl_customer SET code = $code WHERE email='$email'";
            $res_insert = $this->db->update($insert_code);

            if($res_insert){
                $subject = "Password Reset Code";
                $message = "Your password reset code is $code";
                $sender = "From: toan.job@gmail.com";
                
                if(mail($email,$subject,$message,$sender)){
                    
                    $info = "We've sent a password reset otp to your email- $email";
                    $_SESSION['info'] = $info;
                    $_SESSION['email'] = $email;
                    header('location: reset-code.html');
                    exit();
                }else{
                    $alert = "<span class ='error'>Fail while sending code !!!</span>";
                    return $alert;
                }
            }else{
                $alert = "<span class ='error'>Something went wrong !!!</span>";
                return $alert;
            }
        }else{
            $alert = "<span class ='error'>This email address does not exist !!!</span>";
                    return $alert;
        }
    }

       //if user click Submit in reset-code form
       public function check_reset_otp_code($data){
        $_SESSION['info'] = "";
        $otp_code = $_POST['otp'];

        $checkCode = "SELECT * FROM tbl_customer WHERE code = '$otp_code'";
        $code_res = $this->db->select($checkCode);
        if($code_res){
            $fetch_data = $code_res->fetch_assoc();
            $email = $fetch_data['email'];
            $_SESSION['email'] = $email;
          
            $info = "Please create a new password that you don't use on any other site.";
            $_SESSION['info'] = $info;
            header('location: new-password.html');
            exit();
        }else{
            $alert = "<span class ='error'>You've entered incorrect code!</span>";
            return $alert;
        }
      }

    //if user click change-password button
    public function change_password(){
        $_SESSION['info'] = "";
        $password = md5($_POST['new_password']);
        $cpassword = md5($_POST['confirm_password']);

        if($password != $cpassword){
            $alert = "<span class ='error'>Confirm password not matched !!!</span>";
                return $alert;
        }else{
           
           
            $email = $_SESSION['email'];
           
            // $encpass= password_hash($password, PASSWORD_BCRYPT);
            $update_pass=  "UPDATE tbl_customer SET code = '0', password = '$password' WHERE email = '$email'";

            $res_update_pass = $this->db->update($update_pass);
          
            if($res_update_pass){
                $info = "Your password changed. Now you can login with your new password.";
                $_SESSION['info'] = $info;
                header('Location: password-change.html');
            }else{
                $alert = "<span class ='error'>Failed to change your password !!!</span>";
                return $alert;
            }
        }    
    }

      //if user click verification code submit button
      public function check_code($data){
        $_SESSION['info'] = "";        
        $otp_code = mysqli_real_escape_string($this->db->link, $data['otp']);
      
        $checkCode = "SELECT * FROM tbl_customer WHERE code = '$otp_code'";

        $code_res = $this->db->select($checkCode);

        if($code_res > 0){
            $fetch_data = $code_res->fetch_assoc();
            $fetch_code = $fetch_data['code'];
            $email = $fetch_data['email'];
            $code = 0;
          
            $update_otp = "UPDATE tbl_customer SET code = $code, status = 'verified' WHERE code = $fetch_code";
            $update_res =$this->db->update($update_otp);

            if($update_res){              
                $_SESSION['email'] = $email;
                header('location: login.html');
                exit();
            }else{
                $alert = "<span class ='error'>Failed while updating code!</span>";
                return $alert;
            }
        }else{
            $alert = "<span class ='error'>You've entered incorrect code!</span>";
                return $alert;
        }
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
        

        $secret_key="6LekTlIcAAAAAK9klG4XghAc6UOy6f3x3O93xpwl";
        $captcha_contact = $_POST['g-recaptcha-response'];
        $rsp= file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secret_key&response=$captcha_contact");
        $responseData_contact = json_decode($rsp);
        if(!$responseData_contact->success){
            $alert = "<span class ='error'>You need to validate Captcha before submit form !!!</span>";
            return $alert;
        }else{
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
        $query = "SELECT * FROM tbl_comment WHERE productId= '$id'  order by comment_id desc ";
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

    public function show_delivery_address_order($id,$bill_id){
        $query = "SELECT * FROM tbl_bill WHERE customerId='$id' AND code_bill= '$bill_id' ";
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