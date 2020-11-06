<?php
require '../api/helpers/jwt.php';
if ($_COOKIE['jwt'] !== null) {
  header('Location: /');
  die();
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Color app register</title>
  <meta charset='utf-8'>
  <link rel='stylesheet' href='https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css'>
  <link rel='stylesheet' href='/style.css'>
  <script type='text/javascript' src='https://code.jquery.com/jquery-3.5.1.min.js'></script>
</head>
<body>
<div id='content'>
  <h3 id='title'>Register</h3>
  <form id='form'>
    <div class='form-row'>
      <div class='form-group col-md-6'>
        <input id='nick' type='username' class='form-control' placeholder='Username'>
      </div>
      <div class='form-group col-md-6'>
        <input id='pass' type='password' class='form-control' placeholder='Password'>
      </div>
    </div>
    <div class='form-group'>
      <div id='color-box' style='width:100%;height:3vh;border:3px solid lime'></div>
      <label for='color'>Hex color</label>
      <input id='color' type='text' class='form-control' placeholder='333'>
    </div>
    <br>
    <button id='register-btn' class='btn btn-primary'>Register</button>
  </form>
  <br>
  <div id='error'></div>
</div>
<script type='text/javascript' src='/js/register.js'></script>
</body>
</html>
