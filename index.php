<!DOCTYPE html>
<html>
<?php
session_start();

require_once 'functions.php';
require_once 'mapa.php';
?>
<head>
    <title>My Training</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCEQxdkZce18xNO2ahJUZzsL3jCtSpbjdI&callback=initMap" type="text/javascript"></script>


</head>
<body>
<!-- PAGE HEADER -->
<div class="container">
    <span><b style="font-size: 36px;">.....My Training</b><img src="course.jpg" height="75px"></span>
</div>

<!-- PAGE NAVBAR -->
<nav class="navbar navbar-expand-sm bg-dark navbar-dark sticky-top">
    <ul class="navbar-nav">
        <li class="nav-item">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">LogIN</button>
        </li>

        <?php
        if(isset($_SESSION['email'])){

            echo "<li class=\"nav-item\">
    	<button type=\"button\" class=\"btn btn-primary\"onclick='odhlasit()' id = 'logoff'>LogOut</button>
    </li>";
        }
        ?>
        <li class="nav-item active">
            <a class="nav-link" href="index.php">Home</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="registration.php">Registration</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">About</a>
        </li>
        <li>
          <a class="nav-link" href="detaily.php">Detaily</a>
        </li>
    </ul>
    <?php
    if(isset($_SESSION['email'])){
        echo "<li class=\"nav-item\">
    	<button type=\"button\" class=\"btn btn-primary\" data-toggle=\"modal\" data-target=\"#pridajTrasuModal \" id = 'pridaj_trasu'>Pridaj trasu</button>
    </li>";
        echo "<li class=\"nav-item\">
    	<button type=\"button\" class=\"btn btn-primary\" data-toggle=\"modal\" data-target=\"#aktualityModal\" id = 'logoff'>Aktuality</button>
    </li>";

    }
    echo "<li class=\"nav-item\">
    	<button type=\"button\" class=\"btn btn-primary\" data-toggle=\"modal\" data-target=\"#trasyModal\" id = 'zobrazTrasy'>Trasy</button>
    </li>";

    ?>

</nav>

<!-- PAGE BODY - GOOGLE MAP -->
<div class="jumbotron text-center" id="map" style="height: 84vh; margin-bottom: 0;"></div>


<!-- LOGIN FORM MODAL Bootstrap -->
<div class="modal" id="myModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Log in</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="modal-body">
                <form action="functions.php" >
                    <div class="form-group">
                        <label for="email">Email address:</label>
                        <input type="email" class="form-control" id="email" name="email">
                    </div>
                    <div class="form-group">
                        <label for="pwd">Password:</label>
                        <input type="password" class="form-control" id="pwd" name="pass">
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>


<!-- Modal na pridanie trasy do DB
!-->
<div class="modal" id="pridajTrasuModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Pridaj trasu</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="modal-body">

                <form action="sql_functions.php" >
                    <div class="form-group">
                        <label for="start_lat">start_lat</label>
                        <input type="text" class="form-control" id="start_lat" name="start_lat">
                    </div>

                    <div class="form-group">
                        <label for="start_lng">start_lng</label>
                        <input type="text" class="form-control" id="start_lng" name="start_lng">
                    </div>

                    <div class="form-group">
                        <label for="end_lat">end_lat</label>
                        <input type="text" class="form-control" id="end_lat" name="end_lat">
                    </div>

                    <div class="form-group">
                        <label for="end_lng">end_lng</label>
                        <input type="text" class="form-control" id="end_lng" name="end_lng">
                    </div>

                    <div class="form-group">
                        <select id = "mode" name= "mode" class="form-control">
                            <option value= "private">Privátny mód</option>
                            <option value= "public">Verejný mód</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>

<!-- Modal na prezeranie aktualit !-->
<div class="modal fade" id="aktualityModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Aktuality</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="modal-body">

                <form action="news.php" >
                    <div class="container">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>Dátum</th>
                                <th>Aktualita</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $result = getAktuality();
                            while($row = $result->fetch_assoc()){
                                echo"<tr>";
                                echo "<td>".$row['datum']."</td>";
                                echo "<td>".$row['text']."</td>";
                                echo"</tr>";

                            }
                            ?>

                            </tbody>
                        </table>


                    </div>



                    <div class="form-group">
                        <label for="delete_newsletter_email">Odstráň Email </label>
                        <input type="text" class="form-control" id="delete_newsletter_email" name="delete_newsletter_email">
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>

                <?php
                if($_SESSION['administrator'] == 1){
                    echo "   <form action=\"news.php\" >
                             <div cl    ass=\"form-group\">
                                <label for=\"pridajAktualitu\">pridaj Aktualitu</label>
                                <input type=\"text\" class=\"form-control\" id=\"pridajAktualitu\" name=\"pridajAktualitu\">
                            </div>
                            <button type=\"submit\" class=\"btn btn-primary\">Submit</button>
                            </form>";

                }


                ?>



            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>

<!-- Modal na prezeranie Tras !-->
<div class="modal fade" id="trasyModal" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Trasy</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="modal-body">

                    <div class="container">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>Štart</th>
                                <th>Koniec</th>
                                <th>Mód</th>
                                <th>Definoval</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            if(isset($_SESSION['email'])) {
                                if ($_SESSION['administrator'] == 1) {
                                    $result = getCelkova_trasa(1);
                                    while ($row = $result->fetch_assoc()) {
                                        echo "<tr>";
                                        echo "<td>" . $row['Start_lan'] . " , " . $row['Start_lng'] . "</td>";
                                        echo "<td>" . $row['End_lan'] . " , " . $row['End_lng'] . "</td>";
                                        echo "<td>" . $row['mode'] . "</td>";
                                        echo "<td>" . $row['Definoval'] . "</td>";
                                        echo "</tr>";
                                    }
                                }else{
                                    $result = getCelkova_trasaPrivatna();
                                    while ($row = $result->fetch_assoc()) {
                                        echo "<tr>";
                                        echo "<td>" . $row['Start_lan'] . " , " . $row['Start_lng'] . "</td>";
                                        echo "<td>" . $row['End_lan'] . " , " . $row['End_lng'] . "</td>";
                                        echo "<td>" . $row['mode'] . "</td>";
                                        echo "<td>" . $row['Definoval'] . "</td>";
                                        echo "</tr>";
                                    }
                                }
                            }else{
                            $result = getCelkova_trasa(0);
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td>" . $row['Start_lan'] . " , " . $row['Start_lng'] . "</td>";
                                echo "<td>" . $row['End_lan'] . " , " . $row['End_lng'] . "</td>";
                                echo "<td>" . $row['mode'] . "</td>";
                                echo "<td>" . $row['Definoval'] . "</td>";
                                echo "</tr>";
                            }

                            }
                            ?>

                            </tbody>
                        </table>
                    </div>
                <?php
                if(isset($_SESSION['email'])){
                    if ($_SESSION['administrator'] == 1){
                        $result = getCelkova_trasa(1);
                        echo "<form action=\"functions.php\"><div class=\"form-group\"> <label for=\"zvolAktivnuTrasu\">Zmeň Aktívnu Trasu</label> </div><select id = \"zvolAktivnuTrasu\" onchange=\"this.form.submit()\" name= \"zvolAktivnuTrasu\" class=\"form-control\">";
                            $result = getCelkova_trasa(1);
                                while($row = $result->fetch_assoc()){
                                    echo "<option value= ".$row['id'].">".$row['Start_lan'] . " , " . $row['Start_lng']." do ".$row['End_lan'] . " , " . $row['End_lng']."</option>";
                                }
                                echo"</select></div></form>";
                    }else{
                        $result = getCelkova_trasaPrivatna();
                        echo "<form action=\"functions.php\"><div class=\"form-group\"> </div> <label for=\"zvolAktivnuTrasu\">Zmeň Aktívnu Trasu</label> <select id = \"zvolAktivnuTrasu\" onchange=\"this.form.submit()\" name= \"zvolAktivnuTrasu\" class=\"form-control\">";
                        $result = getCelkova_trasa(1);
                        while($row = $result->fetch_assoc()){
                            echo "<option value= ".$row['id'].">".$row['Start_lan'] . " , " . $row['Start_lng']." do ".$row['End_lan'] . " , " . $row['End_lng']."</option>";
                        }
                        echo"</select></div></form>";
                    }
                }
                ?>

            </div>
        </div>
    </div>
</div>




<!-- PAGE FOOTER - NEWSLETTER -->
<div class="jumbotron text-center" style="margin-bottom: 0;">
    <form class="form-inline" action="news.php" method="post">
        <b style="font-size: 36px; padding-right: 100px;">Newsletter</b>
        <label for="emailnews" style="padding-right: 10px;">Email address:</label>
        <input type="email" class="form-control" id="emailnews" name="emailnews" placeholder="Enter email">
        <button type="submit" class="btn btn-primary" name="btnews" style="margin-left: 10px;">Send</button>
    </form>
</div>
<script>

    //ajax odstranenie tlacidla a odhlasenie
    function odhlasit(){
        var a ="da";
        var xmlhttp = new XMLHttpRequest();

        var logoff = document.getElementById('logoff');
        logoff.parentNode.removeChild(logoff);
        logoff = document.getElementById('pridaj_trasu');
        logoff.parentNode.removeChild(logoff);

        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
            }
        };
        xmlhttp.open("GET", "functions.php?odhlas="+a, true);
        xmlhttp.send();
    }


</script>
</body>
</html>
