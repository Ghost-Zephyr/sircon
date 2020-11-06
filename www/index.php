<!DOCTYPE html>
<html>
<head>
  <title>Sircon jobb oppgave</title>
  <meta charset='utf-8'>
  <link rel='stylesheet' href='https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css'>
  <link rel='stylesheet' href='/style.css'>
  <script type='text/javascript' src='https://code.jquery.com/jquery-3.5.1.min.js'></script>
  <script src="https://cdn.jsdelivr.net/npm/js-cookie@rc/dist/js.cookie.min.js"></script>
</head>
<body>
<center>
<div id='content'>
  <h2 id='title'>Cool color app for apprenticeship at Sircon</h2>
  <canvas id='colors' width='1000' height='600'></canvas>
  <div id='status'></div>
<?php
if ($_COOKIE['jwt'] == null) {
  echo "<div id='buttons'>
  <a href='/user/login.php'><button class='btn btn-primary'>Login</button></a>
  <a href='/user/register.php'><button class='btn btn-primary'>Register</button></a>
</div>";
} else {
  require 'api/helpers/jwt.php';
  $jwt = jwtGet($_COOKIE['jwt']);
  echo "<p style='margin-top: 5vh'>Logged in as ".$jwt->nick.".</p>";
  echo '<button id="logout-btn" class="btn btn-primary">Logout</button>';
}
?>
</div>
</center>
<script type='text/javascript' src='/js/colors.js'></script>
</body>
</html>
