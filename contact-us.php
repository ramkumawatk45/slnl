<?php include("common/menu.php"); ?>
 <section id="contact-info">
        <div class="center">                
            <h2>How to Reach Us?</h2>
        </div>
        <div class="gmap-area">
            <div class="container">
                <div class="row">
                    <div class="col-sm-8 text-center">
                        <div class="gmap">
                            <iframe frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://www.google.com/maps/embed/v1/place?key=AIzaSyDXeTgPBYNW9sM1Xrx7jBr3zAgzNW1aTCM&q=Shrilife+Nidhi+Ltd+Mandha+Bhim+Singh" allowfullscreen></iframe>
                        </div>
                    </div>

                    <div class="col-sm-4 map-content">
                        <ul class="row">
                            <li class="col-sm-12">
                                <address>
                                    <h5>Head Office</h5>
                                    <p>Minda Road ,Near Animal Hospital,<br>
                                     Mandha Bhim Singh Th. Kisangarh Renwal Jaipur(Rajsthan)</p>
                                    <p>Phone:+917737371436,01424-258055 <br>
                                    Email Address:info@shrilifenidhi.com</p>
                                </address>
                            </li>


                            
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>  <!--/gmap_area -->


   
    <section id="contact-page">
        <div class="container">
            <div class="center">        
                <h2>Drop Your Message</h2>
            </div> 
            <div class="row contact-wrap"> 
                <div class="status alert alert-success" style="display: none"></div>
                <form   class="contact-form" name="contact-form" method="post">
                    <div class="col-sm-5 col-sm-offset-1">
                        <div class="form-group">
                            <label>Name *</label>
                            <input type="text" name="name" class="form-control" required="required">
                        </div>
                        <div class="form-group">
                            <label>Email *</label>
                            <input type="email" name="email" class="form-control" required="required">
                        </div>
                        <div class="form-group">
                            <label>Phone</label>
                            <input type="number" class="form-control" name="phoneNumber">
                        </div>
						<div class="form-group">
                            <label>Subject *</label>
                            <input type="text" name="subject" class="form-control" required="required">
                        </div>
                                             
                    </div>
                    <div class="col-sm-5">
                        
                        <div class="form-group">
                            <label>Message *</label>
                            <textarea name="message" id="message" required="required" class="form-control" rows="8"></textarea>
                        </div>  
						<div class="form-group">
						&nbsp;<br>&nbsp;
                        </div>						
                        <div class="form-group">
                            <button type="submit" name="submit" class="btn btn-primary btn-lg" required="required">Submit Message</button>
                        </div>
                    </div>
                </form> 
         </div><!--/.row-->
        </div><!--/.container-->
    </section><!--/#contact-page-->

	<?php include("common/footer.php"); ?>
	<?php 
if(isset($_POST['submit'])){
    $to = "info@shrilifenidhi.com"; // this is your Email address
    $from = $_POST['email']; // this is the sender's Email address
    $name = $_POST['name']; 
    $subject = $_POST['subject'];
    $subject2 = $_POST['subject'];
  
    $message =" Name : ".$name . "\n\n"." Mobile Number : ".$_POST['phoneNumber']. "\n\n"." Message :". $_POST['message'];
      $message2 ="Dear ".$name ." ,\n\n"."Thank you for submited your query \n\n We will contact you soon ";
    $headers = "From:" . $from;
    $headers2 = "From:" . $to;
    mail($to,$subject,$message,$headers);
    mail($from,$subject2,$message2 ,$headers2); // sends a copy of the message to the sender
    echo "Mail Sent. Thank you " . $name . ", we will contact you shortly.";
    //header('Location: thank_you.php');
    }
?>	