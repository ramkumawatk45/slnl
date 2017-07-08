<?php include("common/menu.php"); ?>
 <section id="contact-info">
       
      
    </section>  <!--/gmap_area -->


   
    <section id="contact-page">
        <div class="container">
            <div class="center">        
                <h2>Send Your Resume </h2>
            </div> 
            <div class="row contact-wrap"> 
                <div class="status alert alert-success" style="display: none"></div>
                <form   class="contact-form" name="contact-form" method="post"  enctype="multipart/form-data">
                    <div class="col-sm-5 col-sm-offset-1">
                        <div class="form-group">
                            <label>Name *</label>
                            <input type="text" name="name" class="form-control" required="required">
                        </div>
                        <div class="form-group">
                            <label>Email Id *</label>
                            <input type="email" name="email" class="form-control" required="required">
                        </div>
                        
                          <div class="form-group">
                            <label>Apply for the Post of *</label>
                            <select class="form-control" required="required" name="post">
                                 <option>Select Post</option>
                                <option value="Manager">Manager</option>
                                <option value="Sales Manager">Sales Manager</option>
                                <option value="Field Officer">Field Officer</option>
                                <option value="Field Worker">Field Worker</option>
                                <option value="Other">Other</option>
                            </select>
                        </div>
					    <div class="form-group">
                            <label>Key Skills </label>
                            <input type="text" name="keySkills" class="form-control">
                        </div>
                                             
                    </div>
                    <div class="col-sm-5">
                        <div class="form-group">
                            <label>Mobile No.</label>
                            <input type="number" class="form-control" name="phoneNumber" required="required">
                        </div>
                        <div class="form-group">
                            <label>Resume *</label>
                            <input type="file" name="file" class="form-control" required="required" accept="image/*,application/pdf,application/msword">
                        </div>
                        <div class="form-group">
                            <label>Total Work Experience *</label>
                            <select class="form-control" required="required" name="experience">
                                 <option>Select Value</option>
                                <option value="No Work Experience">No Work Experience</option>
                                <option value="Less than 1 year">Less than 1 year</option>
                                <option value="Less than 2 years">Less than 2 years</option>
                                <option value="Less than 3 years">Less than 3 years</option>
                                <option value="Less than 4 years">Less than 4 years</option>
                                <option value="More than 5 years">Less than 5 years</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Current Designation </label>
                            <input type="text" name="designation" class="form-control">
                        </div>
                    </div>
                     <div class="col-sm-10 col-sm-offset-1">
                        <div class="form-group">
                            <label>Message *</label>
                            <textarea name="message" id="message" required="required" class="form-control" rows="4"></textarea>
                        </div> 
                        <div class="form-group">
                            <button type="submit" name="submit" class="btn btn-primary btn-lg">Submit Resume</button>
                        </div>
                    </div>    
                </form> 
         </div><!--/.row-->
        </div><!--/.container-->
    </section><!--/#contact-page-->

	<?php include("common/footer.php"); ?>
<?php

$msg = "";

 if(isset($_POST['submit']))

{

// Variable declaration

$name = $_POST['name'];

$email_from = $_POST['email'];

$experience = $_POST['experience'];

$post = $_POST['post'];

if($_POST['keySkills'])
{
    $keySkills = $_POST['keySkills'];
}    

$phoneNumber = $_POST['phoneNumber'];

if($_POST['designation'])
{
    $designation = $_POST['designation'];
}

$file=$_FILES["file"]["name"];

$mess =$_POST['message'];

// How mail will look like at receiver’s end

$message= "<html><head></head><body><table width='700' height='300' bgcolor='#EFEEE8' style='color:#000;border:none; text-align:justify; padding:20px;'>

<tr>

          <td>Name: $name<br> </td>

</tr>

<tr>

          <td>Email ID: $email_from </td>

</tr>

<tr>

          <td style='border:none'>Mobile No: $phoneNumber </td>

</tr>

    <tr>
    
              <td style='border:none'>Apply for the Post of : $designation </td>
    
    </tr>

<tr>

          <td style='border:none'>Total Work Experience  : $experience </td>

</tr>

    <tr>
    
              <td style='border:none'>Key Skills  : $keySkills </td>
    
    </tr>


<tr>

          <td style='border:none'>Current Designation : $designation </td>

</tr>

<tr>

          <td style='border:none'>Message: $mess <br> </td>

</tr>

<tr>

          <td style='border:none'>File:Find details of applicant below: <br> </td>

</tr>

</table>

</body></html>";

if ($file)

{

//Function deliration

function mail_attachment ($from , $to, $subject, $message, $attachment){

                $fileatt = $attachment; // Path to the file                 

                $fileatt_type = "application/octet-stream"; // File Type

                $start= strrpos($attachment, '/') == -1 ? strrpos($attachment, '//') : strrpos($attachment, '/')+1;

                $fileatt_name = substr($attachment, $start, strlen($attachment)); // Filename that will be used for the file as the attachment

                $from = $email_from; // Who the email is from

                 $subject = "New Attachment Message";

                $email_subject =  $subject; // The Subject of the email

                $email_txt = $message; // Message that the email has in it

                $email_to = $to; // Who the email is to

                $headers = "From: ".$_POST['email'];

                $file = fopen($fileatt,'rb');

                $data = fread($file,filesize($fileatt));

                fclose($file);

                $msg_txt="\n\n You have recieved a new attachment message from ".$from;

                $semi_rand = md5(time());

                $mime_boundary = "==Multipart_Boundary_x{$semi_rand}x";

                $headers .="\nMIME-Version: 1.0\n" .  "Content-Type: multipart/mixed;\n" .

            " boundary=\"{$mime_boundary}\"";

                $email_txt .= $msg_txt;

                $email_message .= "This is a multi-part message in MIME format.\n\n" .

                "--{$mime_boundary}\n" .

                "Content-Type:text/html; charset=\"iso-8859-1\"\n" .

               "Content-Transfer-Encoding: 7bit\n\n" .

                $email_txt . "\n\n";

                $data = chunk_split(base64_encode($data));

                $email_message .= "--{$mime_boundary}\n" .

                  "Content-Type: {$fileatt_type};\n" .

                  " name=\"{$fileatt_name}\"\n" .

                  //"Content-Disposition: attachment;\n" .

                  //" filename=\"{$fileatt_name}\"\n" .

                  "Content-Transfer-Encoding: base64\n\n" .

                 $data . "\n\n" .

                  "--{$mime_boundary}--\n";

 

                $ok = mail($email_to, $email_subject, $email_message,$headers);

 

                if($ok)

                {

                $msg = "File Sent Successfully.";
                ?> <script>alert('<?php echo $msg; ?>')</script> <?php
                unlink($attachment); // delete a file after attachment sent.

                }

                else

                {

                die("Sorry but the email could not be sent. Please go back and try again!");

                }

}

 

//Move uploaded file to temp folder of root directory of your site

move_uploaded_file($_FILES["file"]["tmp_name"],'temp/'.basename($_FILES['file']['name']));

// calling function

mail_attachment($from, "smkumawat45@gmail.com", "New Resume Submitted", $message, ("temp/".$_FILES["file"]["name"]));

}

$msg = "Your mail successfully sent.";//message
?> <script>alert('<?php echo $msg; ?>');</script> <?php

}

?>