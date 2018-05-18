<?php


//pripoji DB
function connectDB(){
    require 'config.php';
    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    mysqli_set_charset($conn,"utf8");
    return $conn;
}

//selectnem si loginy z DB
function getLogginns($email,$pass){
    $conn = connectDB();
    $sql = "SELECT Email, Heslo, administrator, aktivna FROM `uzivatel` WHERE Email = '$email' AND Heslo = '$pass'";
    //echo $sql;
    $result =  $conn->query($sql);
    $conn->close();
    $a =$result->fetch_assoc();
    return $a;
}


$start_lat = $_GET['start_lat'];
$start_lng = $_GET['start_lng'];
$end_lat = $_GET['end_lat'];
$end_lng = $_GET['end_lng'];
$mode = $_GET['mode'];
if(isset($start_lat)&&isset($start_lng)&&isset($mode)&&isset($end_lat)&&isset($end_lng)){
    addRoute($start_lat,$start_lng,$end_lat,$end_lng,$mode);
}

function addRoute($start_lat,$start_lng,$end_lat,$end_lng,$mode){
    $conn = connectDB();
    session_start();
    $define = $_SESSION['email'];
    $sql= "INSERT INTO `celkova_trasa` (`id`, `Start_lan`, `Start_lng`, `End_lan`, `End_lng`, `mode`, `Definoval`) 
                                VALUES (NULL, '$start_lat', '$start_lng', '$end_lat', '$end_lng', '$mode', '$define')";

    $conn->query($sql);
    $conn->close();
    header( "Location: http://147.175.98.193/zav/index.php" );

}
//vyhladaj vsetky verejne cesty
function getPublicRoute(){
    $conn = connectDB();
    $sql = "SELECT * FROM `celkova_trasa` WHERE `mode` = 'public'";
    //echo $sql;
    $result =  $conn->query($sql);
    $conn->close();

    return $result;
}
// vyhladaj privatne cesty
function getPrivateRoute($admin){
    $conn = connectDB();
    $def = $_SESSION['email'];
    if($admin==0) {$sql = "SELECT * FROM `celkova_trasa` WHERE `mode` = 'private' and 	Definoval = '$def'";}
    else    {$sql = "SELECT * FROM `celkova_trasa` WHERE `mode` = 'private'";}
    //echo $sql;
    $result =  $conn->query($sql);
    $conn->close();

    return $result;
}
function checkAktiveRoad(){
    $conn = connectDB();
    $def = $_SESSION['email'];
    $sql = "SELECT `aktivna` FROM `uzivatel` WHERE `Email` = '$def'";
    $result =  $conn->query($sql);
    $conn->close();
    $a = $result->fetch_assoc();
    return $a['aktivna'];
}

//vyhladaj aktivnu cestu
function getActiveRoute(){
    $conn = connectDB();
    $def = $_SESSION['email'];
    $sql = "select * from uzivatel LEFT join celkova_trasa on uzivatel.aktivna = celkova_trasa.id where uzivatel.Email = '$def'";
    $result =  $conn->query($sql);
    $conn->close();
    return $result;
}

//pridaj email na odoberanie aktualit
function insertNewsletterEmail($email){
    $conn = connectDB();
    $sql = "INSERT INTO `newsletter_email` (`id`, `email`) VALUES (NULL, '$email')";
    $conn->query($sql);
    $conn->close();
}
//zmaz email na odoberanie aktualit
function deleteNewsletterEmail($email){
    $conn = connectDB();
    $sql = "DELETE FROM newsletter_email WHERE email = 'pksdadjod@gmais.com'";
    $conn->query($sql);
    $conn->close();
}

//ziskaj aktuality
function getAktuality(){
    $conn = connectDB();
    $sql = "SELECT * FROM `aktuality` WHERE 1";
    $result =  $conn->query($sql);
    $conn->close();
    return $result;
}

//pridaj aktualitu
function insertAktuality($act){
    $conn = connectDB();
    $date = date("Y/m/d");
    $sql = "INSERT INTO `aktuality` (`id`, `datum`, `text`) VALUES (NULL, '$date', '$act')";

    $conn->query($sql);
    $conn->close();
}
function getNewsLetterEmail()
{
    $conn = connectDB();
    $sql = "SELECT `email` FROM `newsletter_email`";
    $result = $conn->query($sql);
    $conn->close();
    return $result;
}
//ziskaj vsetky trasy
function getCelkova_trasa($acess){
    $conn = connectDB();

    $sql=1;
    if($acess==1){
        $sql = "SELECT * FROM `celkova_trasa`";
    }elseif($acess==0){
        $sql = "SELECT * FROM `celkova_trasa` WHERE `mode`='public'";
    }
    $result = $conn->query($sql);
    $conn->close();
    return $result;
}
//ziskaj privatnu trasu uzivatela
function getCelkova_trasaPrivatna(){
    $conn = connectDB();
    $email = $_SESSION['email'];
    $sql = "SELECT * FROM `celkova_trasa` WHERE `mode` ='public' OR `Definoval` = '$email'";
    $result = $conn->query($sql);
    $conn->close();
    return $result;
}


function zmenAktivnuTrasu($akt){
    $conn = connectDB();
    $email = $_SESSION['email'];
    $sql = "UPDATE `uzivatel` SET `aktivna` = '$akt' WHERE `uzivatel`.`Email` = '$email'";
    $result = $conn->query($sql);
    $conn->close();

}


?>