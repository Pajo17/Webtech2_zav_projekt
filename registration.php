<!DOCTYPE html>
<html>
<head>
	<title>My Training</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
  	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
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
      <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">LogIN</button>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="http://147.175.98.211/webteSZ/">Home</a>
    </li>
    <li class="nav-item active">
      <a class="nav-link" href="http://147.175.98.211/webteSZ/registration.php">Registration</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="#">About</a>
    </li>
  </ul>
</nav>

<div class="container">
  <form action="/reg.php">
  <div class="form-group" style="margin-top: 30px;">
    <label for="name">Name:</label>
    <input type="text" class="form-control" id="name">
  </div>
  <div class="form-group">
    <label for="surname">Surname:</label>
    <input type="text" class="form-control" id="surname">
  </div>
  <div class="form-group">
    <label for="email">Email address:</label>
    <input type="email" class="form-control" id="email">
  </div>
  <div class="form-group">
    <label for="pwd">Password:</label>
    <input type="password" class="form-control" id="pwd">
  </div>
  <div class="form-group">
    <label for="rpwd">Retype password:</label>
    <input type="password" class="form-control" id="rpwd">
  </div>
  <button type="submit" class="btn btn-primary" style="margin-bottom: 30px;">Submit</button>
</form>
</div>

<div class="jumbotron text-center" style="margin-bottom: 0;">
  <form class="form-inline" action="news.php" method="post">
    <b style="font-size: 36px; padding-right: 100px;">Newsletter</b>
      <label for="emailnews" style="padding-right: 10px;">Email address:</label>
      <input type="email" class="form-control" id="emailnews" name="emailnews" placeholder="Enter email">
      <button type="submit" class="btn btn-primary" name="btnews" style="margin-left: 10px;">Send</button>
  </form>
</div>
</body>
</html>