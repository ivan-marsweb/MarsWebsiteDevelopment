<?php 
///+----------------------------------------------------------------+
//| Exit if nothing is posted
//+----------------------------------------------------------------+
if ( !$_POST ) {
	die( "This file cannot be accessed directly!" );
}



//+----------------------------------------------------------------+
//| Regular expressions for validating the input fields
//+----------------------------------------------------------------+
$expEmail = '/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[_a-z0-9-]+(\.[_a-z0-9-]+)*(\.[a-z]{2,4})$/';
$expLettersOnly = '/^[A-Za-z ]+$/';



//+----------------------------------------------------------------+
//| Check the field length
//+----------------------------------------------------------------+
function validateLength($fieldValue, $minLength) {
	return ( strlen( trim($fieldValue) ) > $minLength );
}



//+----------------------------------------------------------------+
//| Get the posted field values & validate them
//+----------------------------------------------------------------+
$name = $_POST["name"];
$email = $_POST["email"];
$phone = $_POST["tel"];
$message = $_POST["message"];

$errorExists = false;

// Name
if ( !validateLength( $name, 2 ) ) {
	$errorExists = true;
}

if ( preg_match( $expLettersOnly, $name ) !== 1 ) {
	$errorExists = true;
}

// Email
if ( preg_match( $expEmail, $email ) !== 1 ) {
	$errorExists = true;
}



//+----------------------------------------------------------------+
//| Submit the form (if there is no errors)
//+----------------------------------------------------------------+
if ( $errorExists == true ) { //ture
	echo '<div class="alert alert-danger alert-dismissible wow fadeInUp" role="alert">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <strong>Something is wrong</strong><br> you must enter your name and email to send the message!
        </div>';
} else {
			mail(
						// Your email account where you will recive the message
						'icaivan11@gmail.com',
						// Subject
						'yourwebsite.com | Contact Form',
						// The message
						htmlspecialchars($message),
						// From: [email field in the theme]
						'From: ' . $email,
						// Phone
						'Phone: ' . $phone
			);
			echo '<div class="alert alert-success alert-dismissible wow fadeInUp" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              Your message has been sent.
            </div>';
}
?>