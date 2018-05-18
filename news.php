<?php
require_once 'sql_functions.php';


$em = $_POST['emailnews'];
if(isset($em)){
    intoNewsletterDB($em);
}
function intoNewsletterDB($email){
    insertNewsletterEmail($email);
    header( "Location: http://147.175.98.193/zav/index.php" );
}


$deleteEm = $_GET['delete_newsletter_email'];
if (isset($deleteEm)){
    deleteNewsletterDB($deleteEm);
}

function deleteNewsletterDB($email){
    deleteNewsletterEmail($email);
    header( "Location: http://147.175.98.193/zav/index.php" );
}

$act = $_GET['pridajAktualitu'];
if(isset($act)){
    insertAktualityintoDB($act);

}
function insertAktualityintoDB($act){
    insertAktuality($act);
    $reciveEmails = getNewsLetterEmail();
    while($row = $reciveEmails->fetch_assoc()){
        $to = $row['email'];
        $subject = "Aktualita";
        $txt = $act;
        mail($to,$subject,$txt);
    }


    header( "Location: http://147.175.98.193/zav/index.php" );

}

/*
$to = $em;
$subject = "My Training News";
$txt = "Hello world!";
// $headers = "From: mt@webte.com";
echo "email sent";
mail($to,$subject,$txt);
}*/

?>