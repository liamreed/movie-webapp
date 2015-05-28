<?php 
include_once 'database.php';
$pdo = Database::connect();
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
include_once 'includes/functions.php';
sec_session_start ();

  if (login_check ( $pdo ) == true) {
    
    $logged = 'in';
    header('Location: dashboard.php');
  } else {
    $logged = 'out';
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <link href="css/vendor/bootstrap.min.css" rel="stylesheet">
  <link href="css/flat-ui-pro.min.css" rel="stylesheet">
  <link href="css/custom.min.css" rel="stylesheet">
  <script src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
  <script src="js/jquery-func.js"></script>
  <script src="js/sha512.js"></script>
  <script src="js/forms.js"></script>
</head>
<body>

<?php

  include_once 'includes/navigation.php';

  ?>

  <div class="container">
    <h4>Login</h4>
    <div class="row">
      <div class="col-lg-12">
        <form id="loginForm" method="post" name="login_form"
      action="process_login.php" >
      <table id="inputTable">
        <tr>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td><label for="email">Email:<br>
          </label> <input name="email" type="text" id="email"></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td><label for="password">Password:<br>
          </label> <input name="password" type="text" id="password"></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
        </tr>

        <tr>
          <td><input type="button" value="Login"
            onclick="formhash(this.form, this.form.password);" /></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
        </tr>

      </table>
    </form>
      </div>
      <?php
if (login_check ( $pdo ) == true) {
  echo '<p>Currently logged ' . $logged . ' as ' . htmlentities ( $_SESSION ['username'] ) . '.</p>';
  
  echo '<p>Do you want to change user? <a href="logout.php">Log out</a>.</p>';
} else {
  echo '<p>Currently logged ' . $logged . '.</p>';
  echo "<p>If you don't have a login, please <a href='register.php'>register</a></p>";
}
?>    
    </div>
  </div>
<script src="js/bootstrap.min.js"></script>
</body>
<footer>
</footer>
