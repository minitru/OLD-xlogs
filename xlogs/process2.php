<?php
 
//Retrieve form data.
//GET - user submitted data using AJAX
//POST - in case user does not support javascript, we'll use POST instead
$name = ($_GET['name']) ? $_GET['name'] : $_POST['name'];
$email = ($_GET['email']) ?$_GET['email'] : $_POST['email'];
$message = ($_GET['message']) ?$_GET['message'] : $_POST['message'];
 
//flag to indicate which method it uses. If POST set it to 1
if ($_POST) $post=1;
 
//Simple server side validation for POST data, of course,
//you should validate the email
// if (!$name) $errors[count($errors)] = 'Please enter your name.';
if (!$email) $errors[count($errors)] = 'Please enter your email.';
// if (!$message) $errors[count($errors)] = 'Please enter your message.';
 
//if the errors array is empty, send the mail
if (!$errors) {
    //recipient - change this to your name and email
    $to = $email;
    $from = "xlogs <sean@xlo.gs>";

    $authcode = rand(100000,999999);

    # WRITE THE EMAIL INTO A FILE NAMES WITH THE AUTHCODE
    # GET THIS OUT OF THE ROOT DIR
    `echo "$email" > /home/sean/xlogs/$authcode`;
     
    //subject and the html message
    //$subject = 'Complete your xlogs registration';
    $subject="xlogs: Please confirm your email address";
    $url="http://xlo.gs/signup.php?email=" . $email . "&auth=" . $authcode;
    $message = "Welcome " .  $email .  ", to finish registering for xlogs just click here: <A HREF=" . $url . ">" . $url . "</A>";
 
    //send the mail
    $rc = sendmail($to, $subject, $message, $from);
     
    //if POST was used, display the message straight away
    if ($_POST) {
        if ($rc) echo 'Thank you! We have received your message.';
        else echo 'Sorry, unexpected error. Please try again later';
         
    //else if GET was used, return the boolean value so that
    //ajax script can react accordingly
    //1 means success, 0 means failed
    } else {
        echo $rc;  
    }
 
//if the errors array has values
} else {
    //display the errors message
    for ($i=0; $i<count($errors); $i++) echo $errors[$i] . '<br/>';
    echo '<a href="form.php">Back</a>';
    exit;
}
 
 
//Simple mail function with HTML header
function sendmail($to, $subject, $message, $from) {
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";
    $headers .= 'From: ' . $from . "\r\n";
     
    $rc = mail($to,$subject,$message,$headers);
     
    if ($rc) return 1;
    else return 0;
}
?>
