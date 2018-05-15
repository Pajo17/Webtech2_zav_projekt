<?php
if(isset($_POST['btnews'])){

	$em = $_POST['emailnews'];
	if($em == "") {die("Message failed");}

$to = $em;
$subject = "My Training News";
$txt = "Hello world!";
// $headers = "From: mt@webte.com";
echo "email sent";
mail($to,$subject,$txt);
}
?>