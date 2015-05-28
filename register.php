<?php
include_once 'includes/register.inc.php';
include_once 'includes/functions.php';
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

<?php include_once 'includes/navigation.php'; ?>

  <div class="container">
    <h3>Register</h3>

        <?php
        if (!empty($error_msg)) {
            echo $error_msg;
        }?>

        <ul>
            <li>Usernames may contain only digits, upper and lower case letters and underscores</li>
            <li>Emails must have a valid email format</li>
            <li>Passwords must be at least 6 characters long</li>
            <li>Passwords must contain
                <ul>
                    <li>At least one uppercase letter (A..Z)</li>
                    <li>At least one lower case letter (a..z)</li>
                    <li>At least one number (0..9)</li>
                </ul>
            </li>
            <li>Your password and confirmation must match exactly</li>
        </ul>
        <form action="<?php echo esc_url($_SERVER['PHP_SELF']); ?>" method="post" name="registration_form">
        Name: <input type='text' name='name' id='name' /><br>
        Username: <input type='text' name='username' id='username' /><br>
        Email: <input type="text" name="email" id="email" /><br> 
        Password: <input type="password" name="password" id="password" /><br>
        Confirm password: <input type="password" name="confirmpwd" id="confirmpwd" /><br>
        <input type="button" value="Register"
          onclick="return regformhash(this.form, this.form.name, this.form.username, this.form.email, this.form.password, this.form.confirmpwd);" />
          </form>
          <p>Return to the <a href="login.php">Login</a>.</p>
        </div>
<script src="js/bootstrap.min.js"></script>
</body>
<?php include_once 'includes/footer.php'?>
