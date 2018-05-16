
<?php
/**
 * Created by PhpStorm.
 * User: Uzivatel
 * Date: 16. 5. 2018
 * Time: 12:30
 */
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


/*
function showRoute(){
    echo"    <script>
                var directionsDisplay;
                var directionsService = new google.maps.DirectionsService();
                directionsDisplay = new google.maps.DirectionsRenderer();
                directionsDisplay.setMap(map);
";
    $resoult = getPublicRoute();
    while($row = $resoult->fetch_assoc()){
        echo "
                   var start = new google.maps.LatLng(".$row['Start_lan'].", ".$row['Start_lng'].");
                    var end = new google.maps.LatLng(".$row['End_lan'].", ".$row['End_lng'].");
                    calcRoute(directionsDisplay,directionsService,start,end);
                    </script>
        ";

    }




}
*/

?>