<?php
  session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Profile</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
  	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
  	<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCEQxdkZce18xNO2ahJUZzsL3jCtSpbjdI&callback=initMap" type="text/javascript"></script>
  	<script type="text/javascript"></script>
  	<script src="mapa.js"></script>
</head>
<body>
<!-- PAGE HEADER -->
<div class="container">
  <span><b style="font-size: 36px;">.....My Training</b><img src="course.png" height="75px"></span>
</div>

  <!-- PAGE NAVBAR -->
  <nav class="navbar navbar-expand-sm bg-dark navbar-dark sticky-top">
  <ul class="navbar-nav">

    <li class="nav-item">
      <a class="nav-link" href="index.php">Home</a>
    </li>
    <li class="nav-item active">
      <a class="nav-link" href="detaily.php">Detaily</a>
    </li>

  </ul>
</nav>

  <?php include("osma.php"); ?>

</div>

</body>
</html>
