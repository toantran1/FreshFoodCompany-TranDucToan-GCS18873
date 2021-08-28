<?php
include 'inc/header.php';
// include 'inc/slider.php';
?>
<?php
$customerid = Session::get('customer_id');
if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit_contact'])){

	 $cus_contact= $cs->insert_cus_contact($customerid);
	 echo "<meta http-equiv='refresh' content='0'>";

}
?>
 <div class="main">
    <div class="content">
    	<div class="support">
  			<div class="support_desc">
  				<h3>Live Support</h3>
  				<p><span>24 hours | 7 days a week | 365 days a year &nbsp;&nbsp; Live Technical Support</span></p>
  				<p> Our products are always renewed every day, aiming to bring your family a delicious and nutritious meal. We aim to bring consumers the freshest and most delicious products. If you have any questions and would like assistance, please feel free to contact us by submitting a ticket! We will contact you directly. Thanks !</p>
  			</div>
  				
  			<div class="clear"></div>
  		</div>
			

    	<div class="section group">
				<div class="col span_2_of_3">
				<h2>Contact Us</h2>
					  <?php
				if(isset($cus_contact)){
					echo $cus_contact;
					
				}
				?>
				  <div class="contact-form">
				  
					  <form action="contact.html" method="POST" >
						  <div>
					  <?php
								$customerid = Session::get('customer_id');
								$show_cus_contact = $cs->show_cus_comment($customerid);
								if($show_cus_contact){
								$result_show_cus_contact = $show_cus_contact->fetch_assoc();
								}
					  ?>
					    	<!-- <div>
						    	<span><label>NAME</label></span>
						    	<span><input type="text" value=""></span>
						    </div> -->
							<div class="price">
						    	<p>Your Name</p></div>
								  <?php
								 	 $login_check = Session:: get('customer_login');
									if($login_check == false){
									?>
									<input type= "text" placeholder="Enter your name..." class="buyfield" name ="usercontact" required/>
									<?php
									}else{
										?>

									<input style='color: green;' type= "text" readonly="readonly" value="<?php echo $result_show_cus_contact['name']; ?>" class="buyfield" name ="usercontact"/>
									<?php
								}
	 								 ?>
						    	
						    </div>


						    <!-- <div>
						    	<span><label>E-MAIL</label></span>
						    	<span><input type="text" value=""></span>
						    </div> -->
							<div>
							<div class="price">
						    	<p>Your Email</p></div>
								  <?php
								 	 $login_check = Session:: get('customer_login');
									if($login_check == false){
									?>
									<input type= "text" placeholder="Enter your email..." class="buyfield" name ="useremail" required/>
									<?php
									}else{
										?>

									<input style='color: green;' type= "text" readonly="readonly" value="<?php echo $result_show_cus_contact['email']; ?>" class="buyfield" name ="useremail"/>
									<?php
								}
	 								 ?>
						    	
						    </div>

						    <!-- <div>
						     	<span><label>MOBILE.NO</label></span>
						    	<span><input type="text" value=""></span>
						    </div> -->
							<div>
							<div class="price">
						    	<p>Phone Number</p></div>
								  <?php
								 	 $login_check = Session:: get('customer_login');
									if($login_check == false){
									?>
									<input type= "text" placeholder="Enter your phone..." class="buyfield" name ="userphone" required/>
									<?php
									}else{
										?>

									<input style='color: green;' type= "text" readonly="readonly" value="<?php echo $result_show_cus_contact['phone']; ?>" class="buyfield" name ="userphone"/>
									<?php
								}
	 								 ?>
						    	
						    </div>


						    <!-- <div>
						    	<span><label>SUBJECT</label></span>
						    	<span><textarea> </textarea></span>
						    </div> -->
							
							<div>
							<div class="price">
						    	<p>Subject</p></div>
						    	<span><textarea  style="resize:none" class="form-control" placeholder="what do you want?..." name="subject" required></textarea></span>
						    </div>
						   <!-- <div>
						   		<span><input type="submit" value="SUBMIT"></span>
						  </div> -->

						  <div>
						   		<span><input type="submit" name ="submit_contact" class="buysubmit" value="Submit"></span></br>
						  </div>
					    </form>
				  </div>
  				</div>
				  
				<div class="col span_1_of_3">
      			<div class="company_address">
				     	<h2>Company Information :</h2>
						    	<p>We are happy to serve and bring fresh food to you. Please contact us: </p>
						   		<p>Address: 327/40 Han Hai Nguyen, P.2, Q.11, TP.HCM</p>
						   		<p>Country: Viet Nam</p>
				   		<p>Phone: 083.794.3763</p>
				   		<p>Hotline: 083.794.3763</p>
				 	 	<p>Email: <span>freshfood@gmail.com</span></p>
				   		<p>Follow on: <span><a href="https://www.facebook.com/Fresh-Food-Company-112053137750560" target="_blank">Facebook</a></span>, <span>Twitter</span></p>
						<p>Site map:</p>   
						<p><iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3919.693474700818!2d106.64809531411633!3d10.758090262475287!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31752e8d73b110d5%3A0x61363c1e345d9969!2zMzI3LCA0MCDEkMaw4budbmcgSMOgbiBI4bqjaSBOZ3V5w6puLCBQaMaw4budbmcgMTYsIFF14bqtbiAxMSwgVGjDoG5oIHBo4buRIEjhu5MgQ2jDrSBNaW5oLCBWaeG7h3QgTmFt!5e0!3m2!1svi!2s!4v1629525507103!5m2!1svi!2s" width="300" height="300" style="border:0;" allowfullscreen="" loading="lazy"></iframe></p>
				   </div>
				 </div>
				 <!-- <div class="col span_1_of_3">
      			<div class="company_address">
				     	<h2>Company Information :</h2>
						    	
				   </div>
				 </div> -->
			  </div>    	
    </div>
 </div>
 <?php
 include 'inc/footer.php';
 ?>