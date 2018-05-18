
<?php

session_start();

require_once 'sql_functions.php';
$email = $_GET['email'];
$pass = $_GET['pass'];
if(isset($email)&&isset($pass)){
    loggin($email,$pass);

}
//funkcia na prihlasenie
function loggin($email,$pass){

    $respond =  getLogginns($email,$pass);
    if($respond==Null){
        echo "nezaregistrovany";
    }else{

        $_SESSION['email'] = $respond['Email'];
        $_SESSION['aktivna'] = $respond['aktivna'];
        $_SESSION['administrator'] = $respond['administrator'];
        header( "Location: http://147.175.98.193/zav/index.php" );
    }

}


//funkcie na odhlasenie
$odhlas = $_GET['odhlas'];
if(isset($odhlas)){
    odhlas();
}
function odhlas(){
    unset($_SESSION['email']);
    unset($_SESSION['aktivna']);
    unset($_SESSION['administrator']);
    session_destroy();
}




?>