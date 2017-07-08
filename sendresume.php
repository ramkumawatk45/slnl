<?php

$msg = "";

 if(isset($_POST['submit']))

{

// Variable declaration

$name = $_POST['name'];

$email_from = $_POST['email'];

$file=$_FILES["file"]["name"];

$mess =$_POST['message'];

// How mail will look like at receiver’s end

$message= "<html><head></head><body><table width='700' height='200' bgcolor='#EFEEE8' style='color:#000;border:none; text-align:justify; padding:20px;'>

<tr>

          <td style='border:none'>Name: $name<br> </td>

</tr>

<tr>

          <td style='border:none'>Email ID: $email_from </td>

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

mail_attachment($from, "ramkumawatk45@gmail.com", "New Resume Submitted", $message, ("temp/".$_FILES["file"]["name"]));

}

$msg = "Your mail successfully sent.";//message

}

?>