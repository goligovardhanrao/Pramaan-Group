<?php
session_start();
if(isset($_POST))
{
	// Replace this with your own email address
	$siteOwnersEmail = 'marketing@pramaangroup.com';

    $name = trim(stripslashes($_POST['contactName']));
    $email = trim(stripslashes($_POST['contactEmail']));
    $phone = trim(stripslashes($_POST['contactNumber']));
    $reference = trim(stripslashes($_POST['contactselect']));
    $contact_message = trim(stripslashes($_POST['contactMessage']));

		 // Subject
    $subject = "Enquiry From Pramaan Marketing contact form";


    // Set Message
    $message .= "Email from: " . $name . "<br />";
    $message .= "Email address: " . $email . "<br />";
    $message .= "Phone Number: " . $phone . "<br />";
    $message .= "Reference: " . $reference . "<br />";
    $message .= "Message: <br />";
    $message .= $contact_message;
    $message .= "<br /> ----- <br /> This email was sent from your site's contact form. <br />";

    // Set From: header
    $from =  $name . " <" . $email . ">";

    // Email Headers
    $headers = "From: " . $from . "\r\n";
    $headers .= "Reply-To: ". $email . "\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

	
		if(mail($siteOwnersEmail ,$subject,$message,$headers))
		{ 
			$errmessage = base64_encode("Thank You For Your Intrest!!");
		}
		else
		{
			$errmessage = base64_encode("Oops!! Please Try Again Later!!");
		}
	
	$_SESSION['mailresponse'] = $errmessage;
	header("Location: ./index.php");
	
}

?>