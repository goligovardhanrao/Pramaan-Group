﻿<?php

// Replace this with your own email address
$siteOwnersEmail = 'pramaanlabel@gmail.com';


if($_POST) {

    $name = trim(stripslashes($_POST['contactName']));
    $email = trim(stripslashes($_POST['contactEmail']));
    $phone = trim(stripslashes($_POST['contactNumber']));
    if(isset($_POST['franchise']))
    {
        $city = trim(stripslashes($_POST['contactNumber']));
        $state =  trim(stripslashes($_POST['contactNumber']));
    }
    else
    {
        $contact_message = trim(stripslashes($_POST['contactMessage']));
    }

    // Check Name
    if (strlen($name) < 2) {
        $error['name'] = "Please enter your name.";
    }
    if(isset($_POST['franchise']))
    {
        if (strlen($city) < 2) {
            $error['city'] = "Please enter your city.";
        }
        if (strlen($state) < 2) {
            $error['state'] = "Please enter your state.";
        }
    }
    // Check Email
    if (!preg_match('/^[a-z0-9&\'\.\-_\+]+@[a-z0-9\-]+\.([a-z0-9\-]+\.)*+[a-z]{2}/is', $email)) {
        $error['email'] = "Please enter a valid email address.";
    }
    // Check Message
    if(!isset($_POST['franchise']))
    {
        if (strlen($contact_message) < 10) {
            $error['message'] = "Please enter your message. It should have at least 10 characters.";
        }
    }

    if (!preg_match('/^[6-9][0-9]{9}$/is', $phone)) {
        $error['phone'] = "Please enter a valid phone number.";
    }
    // Subject
   $subject = "Enquiry From Pramaan Lable contact form";


    // Set Message
    $message .= "Email from: " . $name . "<br />";
    $message .= "Email address: " . $email . "<br />";
    $message .= "Phone Number: " . $phone . "<br />";
    if(isset($_POST['franchise']))
    {
        $message .= "City: " . $city . "<br />";
        $message .= "State: " . $state . "<br />";
        if(isset($_POST['cbdetails']))
        {
            $message .= "Current Business: " . $_POST['cbdetails'] . "<br />";
        }
    }
    else
    {
        $message .= "Message: <br />";
        $message .= $contact_message;
    }
    $message .= "<br /> ----- <br /> This email was sent from your site's contact form. <br />";

    // Set From: header
    $from =  $name . " <" . $email . ">";

    // Email Headers
    $headers = "From: " . $from . "\r\n";
    $headers .= "Reply-To: ". $email . "\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "CC: pramaanlabel@gmail.com\r\n";
    $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";


    if (!$error) {

        ini_set("sendmail_from", $siteOwnersEmail); // for windows server
        $mail = mail($siteOwnersEmail, $subject, $message, $headers);
        mail($siteOwnersEmail, $subject, $message, $headers);
        if ($mail) { echo "OK"; }
        else { echo "Something went wrong. Please try again."; }
        
    } # end if - no validation error

    else {

        $response = (isset($error['name'])) ? $error['name'] . "<br /> \n" : null;
        $response .= (isset($error['email'])) ? $error['email'] . "<br /> \n" : null;
        $response .= (isset($error['phone'])) ? $error['phone'] . "<br />" : null;
        $response .= (isset($error['message'])) ? $error['message'] . "<br />" : null;
        $response .= (isset($error['city'])) ? $error['city'] . "<br />" : null;
        $response .= (isset($error['state'])) ? $error['state'] . "<br />" : null;
        
        echo $response;

    } # end if - there was a validation error

}

?>