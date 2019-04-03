<?php

error_reporting(-1);
ini_set('display_errors', 'On');



// provjera jesu li uneseni svi podatci
if(empty($_POST['ime'])  		||
   empty($_POST['mejl']) 		||
   empty($_POST['poruka']))	
   // || !filter_var($_POST['email'],FILTER_VALIDATE_EMAIL))
   {
	echo "Podaci nisu uneseni!";
	return false;
   }
	
$name = $_POST['name'];
$email_address = $_POST['email'];
$message = $_POST['message'];
	
// stvaranje i slanje maila	
$to = 'example@gmail.com'; // email na koji se salju svi mailovi
$email_subject = "Nova poruka od:  $name";
$email_body = "Ime i prezime: $name \n".
			  "Email: $email_address \n" . 
			  "Poruka: \n$message";
$headers = "From: " . $email_address . "\r\n";
$headers .= "Reply-To: " . $email_address . "\r\n";
$headers .= "Return-Path: " . $email_address . "\r\n";
$headers .= "CC: sombodyelse@example.com\r\n";
$headers .= "BCC: hidden@example.com\r\n";
mail($to,$email_subject,$email_body,$headers);
return true;			
?>