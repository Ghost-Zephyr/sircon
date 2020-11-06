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
  <title>Color app login</title>
  <meta charset='utf-8'>
  <link rel='stylesheet' href='https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css'>
  <link rel='stylesheet' href='/style.css'>
  <script type='text/javascript' src='https://code.jquery.com/jquery-3.5.1.min.js'></script>
</head>
<body>
<div id='content'>
  <h3 id='title'>Login</h3>
  <form id='form'>
    <div class='row'>
      <div class='col-sm-6'>
        <input id='nick' type='username' class='form-control' placeholder='Username'>
      </div>
      <div class='col-sm-6'>
        <input id='pass' type='password' class='form-control' placeholder='Password'>
      </div>
    </div>
    <br>
    <button id='login-btn' type='submit' class='btn btn-primary'>Login</button>
  </form>
  <br>
  <div id='error'></div>
</div>
<script type='text/javascript' src='/js/login.js'></script>
</body>
</html>
