<?php
include 'inc/header.php';
//include 'inc/slider.php';
?>

<?php
$login_check = Session::get('customer_login');
if ($login_check == false) {
    header('Location:login.html');
}
?>
<?php
// if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit_order'])) {
//     $customerid = Session::get('customer_id');
//     $insertBill = $ct->insert_bill($customerid);

   

    // $delCart = $ct->del_all_data_cart();

// }
?>
<!-- <script src="https://www.paypalobjects.com/api/checkout.js"></script> -->


<style>
    .box_left {
        width: 50%;
        border: 1px solid #666;
        float: left;
        padding: 10px;

    }

    .box_right {
        width: 44%;
        border: 1px solid #666;
        float: right;
        padding: 10px;

    }
    .box_in{
        width: 95%;
        border: 2px solid #666;
        float: right;
        padding: 10px;
        border-radius: 25px;
    }

    input.a_order {
        background: green;
        padding: 10px 70px;
        color: white;
        font-size: 25px;
        border-radius: 24px;
        margin-bottom: 15px;
        cursor: pointer;

    }

    input.a_order:hover {
        opacity: .8;
    }

    .buyfields {
        padding: 8px;
        display: block;
        width: 98%;
        background: #fcfcfc;
        border: none;
        outline: none;
        color: #464646;
        font-size: 0.9rem;
        font-family: Arial, Helvetica, sans-serif;
        box-shadow: inset 0px 0px 3px #999;
        -webkit-box-shadow: inset 0px 0px 3px #999;
        -moz-box-shadow: inset 0px 0px 3px #999;
        -o-box-shadow: inset 0px 0px 3px #999;
        -webkit-appearance: none;

    }
</style>
<form action="" method="POST">
    <div class="main">
        <div class="content">
            <div class="section group">
                <div class="heading">
                    <h3>Online Payment</h3>
                </div>

                <div class="clear"></div>
                <div class="box_left">
                    <?php
                    if (isset($insertOrder)) {
                        echo $insertOrder;
                    }
                    ?>
                    <div class="cartpage">

                        <?php
                        if (isset($update_quantity_cart)) {
                            echo $update_quantity_cart;
                        }
                        ?>
                        <?php
                        if (isset($delCart)) {
                            echo $delCart;
                        }
                        ?>
                        <table class="tblone">
                            <tr>
                                <th width="5%">ID</th>
                                <th width="15%">Product Name</th>
                                <th width="15%">Price (VND)</th>
                                <th width="25%">Quantity</th>
                                <th width="20%">Total Price (VND)</th>

                            </tr>
                            <?php
                            $get_product_cart = $ct->get_product_cart();
                            if ($get_product_cart) {
                                $subtotal = 0;
                                $qty = 0;
                                $i = 0;
                                while ($result = $get_product_cart->fetch_assoc()) {
                                    $i++;
                            ?>


                                    <tr>
                                        <td><?php echo $i ?></td>
                                        <td><?php echo $result['productName'] ?></td>
                                        <td><?php echo $fm->format_currency($result['price']) ?></td>
                                        <td>


                                            <?php echo $result['quantity'] ?>


                                        </td>
                                        <td>
                                            <?php
                                            $total = $result['price'] * $result['quantity'];
                                            echo $fm->format_currency($total);
                                            ?>

                                    </tr>

                            <?php
                                    $subtotal += $total;
                                    $qty = $qty + $result['quantity'];
                                }
                            }
                            ?>

                        </table>
                        <?php
                        $check_cart = $ct->check_cart();
                        if ($check_cart) {
                        ?>
                            <table style="float:right;text-align:left; margin:6px" width="50%">
                                <tr>
                                    <th>Sub Total : </th>
                                    <td><?php

                                        echo $fm->format_currency($subtotal) . ' VND';
                                        Session::set('sum', $subtotal);
                                        Session::set('qty', $qty);                    //So luong
                                        ?></td>
                                </tr>
                                <tr>
                                    <th>VAT : </th>
                                    <?php
                                    $VAT = 0.1 * $subtotal;
                                    ?>
                                    <td>10% (<?php echo $fm->format_currency($VAT)  ?>)</td>
                                </tr>
                                <tr>
                                    <th>Grand Total :</th>
                                    <td><?php
                                        $VAT = 0.1 * $subtotal;
                                        $gtotal = $subtotal + $VAT;
                                        echo $fm->format_currency($gtotal) . ' VND';
                                        ?></td>
                                </tr>

                            </table>


                        <?php
                        } else {
                            echo 'Your Cart is empty. Please Shopping now, thanks you!!!';
                        }
                        ?>
                    </div>
                </div>

                <div class="box_right">
                    <?php
                    if (isset($insertBill)) {
                        echo $insertBill;
                    }
                    ?>
                    <div class="box_in">
                        <div class="img" style="float:left;width:15%; padding-top: 20px;">
                             <img src="images/notification-flat.png" alt="" width ="50px">
                        </div>
                        <div class="content" style="float:right; width:85%;">
                             <h4 style="color: red;font-weight:bold">Currently, online payment can only deliver to the address you update in your profile. We apologize for this inconvenience. Thank you!</h4>
                        </div>
                    
                    </div>
                    
                    <table class="tblone">
                        <?php
                        $id = Session::get('customer_id');
                        $get_customers = $cs->show_customers($id);
                        if ($get_customers) {
                            while ($result = $get_customers->fetch_assoc()) {


                        ?>
                                <tr>
                                    <td style="font-weight:bold;">Name </td>
                                    <td>:</td>
                                    <td><input style='color: green;' type="text" readonly="readonly" value="<?php echo $result['name'] ?>" class="buyfields" name="name" /></td>
                                </tr>
                                <tr>
                                    <td style="font-weight:bold;">Phone number </td>
                                    <td>:</td>
                                    <td><input style='color: green;' type="text" readonly="readonly" value="<?php echo $result['phone'] ?>" class="buyfields" name="phone" /></td>
                                </tr>

                                <tr>
                                    <td style="font-weight:bold;">Zip-code </td>
                                    <td>:</td>
                                    <td><input style='color: green;' type="text" readonly="readonly" value="<?php echo $result['zipcode'] ?>" class="buyfields" name="zipcode" /></td>
                                </tr>
                                <tr>
                                    <td style="font-weight:bold;">Email </td>
                                    <td>:</td>
                                    <td><input style='color: green;' type="text" readonly="readonly" value="<?php echo $result['email'] ?>" class="buyfields" name="email" /></td>
                                </tr>

                                <tr>
                                    <td style="font-weight:bold;">Address </td>
                                    <td>:</td>
                                    <td><input style='color: green;' type="text" readonly="readonly" value="<?php echo $result['address'] ?>" class="buyfields" name="address" /></td>
                                </tr>

                        <?php
                            }
                        }
                        ?>
<!-- 
                        <tr>
                            <td>
                                <h4 style="color:green; font-weight:bold">Note Delivery Address </h4>
                            </td>
                            <td>:</td>
                            <td><input type="text" placeholder="Delivery Address..." class="buyfields" name="delivery_address" required></td>
                        </tr> -->


                        <tr>
                            <td colspan="3"><a href="editprofile.html">Update Profile</a> </td>
                        </tr>
                    </table>



                </div>

            </div>


        </div>

        <!-- <center>
        <?php
        $vnd_to_usd = $gtotal / 23083;
        ?>
        <div id="paypal-button"></div>
        <input type="hidden" id="vnd_to_usd" value= "<?php echo round($vnd_to_usd, 2) ?>">

    <script>
        var usd = document.getElementById("vnd_to_usd").value; 
        paypal.Button.render({
        
        // Configure environment
        env: 'sandbox',
        client: {
        sandbox: 'AVXxiUcVNdBOTz69WN9VQpCJI_xLpIzkaEffgAyCCdaJys-kHpM49xs5L6wN3nqPdqnzBUu6rVuJCT_E',
        production: 'demo_production_client_id'
        },
        // Customize button (optional)
        locale: 'en_US',
        style: {
        size: 'large',
        color: 'gold',
        shape: 'pill',
        },

        // Enable Pay Now checkout flow (optional)
        commit: true,

        // Set up a payment
        
        payment: function(data, actions) {     
        return actions.payment.create({
            transactions: [{
            amount: {
                total: `${usd}`,
                currency: 'USD'
            }
            }]
        });
        },
        // Execute the payment
        onAuthorize: function(data, actions) {
        return actions.payment.execute().then(function() {
            // Show a confirmation message to the buyer
            window.alert('Thank you for purchase!');
            location.replace("http://localhost:81/website_mvc/paypalsuccess.html");         //TESTING !!!!!!!!!!!!!!!!!!!!!!!!!!!!!! window.alert('Thank you!')
        });
        }
    }, '#paypal-button');
    </script>
    </center> -->
        <script src="https://www.paypal.com/sdk/js?client-id=AVXxiUcVNdBOTz69WN9VQpCJI_xLpIzkaEffgAyCCdaJys-kHpM49xs5L6wN3nqPdqnzBUu6rVuJCT_E&currency=USD">
            // Required. Replace YOUR_CLIENT_ID with your sandbox client ID.
        </script>
   <?php
            $vnd_to_usd = $gtotal / 23083;
            $id = Session::get('customer_id');
            $get_customers = $cs->show_customers($id);
            if ($get_customers) {
               $resultshow = $get_customers->fetch_assoc();
            
            ?>
        <center>
         
            <div id="paypal-button-container"></div>

            <input type="hidden" id="vnd_to_usd" value="<?php echo round($vnd_to_usd, 2) ?>">

        </center>

        <script>
            var usd = document.getElementById("vnd_to_usd").value;
            paypal.Buttons({
                createOrder: function(data, actions) {
                    // This function sets up the details of the transaction, including the amount and line item details.
                    return actions.order.create({
                        purchase_units: [{
                            amount: {
                                value: `${usd}`
                            }
                        }]
                    });
                },
                onApprove: function(data, actions) {
                    // This function captures the funds from the transaction.
                    return actions.order.capture().then(function() {
                        // window.location = "lib/transaction-completed.php?orderID=" + data.orderID;
                       
                        location.replace("http://localhost:81/website_mvc/paypalsuccessfull.html?Cusname=<?php echo $resultshow['name']?>&address_Delivery=<?php echo $resultshow['address']?>&email=<?php echo $resultshow['email']?>&orderID="+ data.orderID);
                    });
                }
            }).render('#paypal-button-container');
            //This function displays Smart Payment Buttons on your web page.
        </script>
<?php
            }
?>
    </div>
</form>
<?php
include 'inc/footer.php';
?>