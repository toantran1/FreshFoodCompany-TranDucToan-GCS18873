<?php
$filepath = realpath(dirname(__FILE__));
include_once ($filepath.'/../lib/database.php');
include_once ($filepath.'/../helpers/format.php');
?>

<?php
class paypal{

    private $db;             //database 
    private $fm;             //format

    public function __construct(){
        $this-> db = new Database();
        $this-> fm = new Format();

    }

    // public function stmt($name,$email,$orderID,$FullAddress){
    //     $query = "INSERT INTO tbl_paypalpayment(name, email, orderID, address)
    //                VALUES('$name','$email','$orderID','$FullAddress') ";
    //                $res = $this->db->insert($query);
    //                return $res;

    // }

    // public function insertOrderpaypal($customerid,$orderID,$name,$email, $addressDelivery){
    //     $cusID =$customerid;
    //     $order_id= $orderID;
    //     $cusName = $name;
    //     $address_delivery =$addressDelivery;
    //     $query = "INSERT INTO tbl_paypalbill(customerId, customerName, email, orderID, addressDelivery)
    //                 VALUES('$cusID','$cusName','$email','$order_id','$address_delivery')";
    //                 $res = $this->db->insert($query);
    //                 return $res;
    // }
}