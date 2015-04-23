<!DOCTYPE html>
<?php
     
    require 'database.php';
 
    if ( !empty($_POST)) {
        // keep track validation errors
        $NameError = null;
        $UserNameError = null;
        $PasswordError = null;
         
        // keep track post values
        $Name = $_POST['Name'];
        $UserName = $_POST['UserName'];
        $Password = $_POST['Password'];
         
        // validate input
        $valid = true;
        if (empty($Name)) {
            $NameError = 'Please enter Name';
            $valid = false;
        }
         
        if (empty($UserName)) {
            $UserNameError = 'Please enter User Name';
            $valid = false;
        } 
         
        if (empty($Password)) {
            $PasswordError = 'Please enter Password';
            $valid = false;
        }
         
        // insert data
        if ($valid) {
            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "INSERT INTO customer (Name,UserName,Password) values(?, ?, ?)";
            $q = $pdo->prepare($sql);
            $q->execute(array($Name,$UserName,$Password));
            Database::disconnect();
            header("Location: index3.php");
        }
    }
?>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link   href="css/bootstrap.min.css" rel="stylesheet">
    <script src="js/bootstrap.min.js"></script>
</head>
 
<body>
    <div class="container">
     
                <div class="span10 offset1">
                    <div class="row">
                        <h3>Create a Customer</h3>
                    </div>
             
                    <form class="form-horizontal" action="create.php" method="post">
                      <div class="control-group <?php echo !empty($NameError)?'error':'';?>">
                        <label class="control-label">Name</label>
                        <div class="controls">
                            <input Name="Name" type="text"  placeholder="Name" value="<?php echo !empty($Name)?$Name:'';?>">
                            <?php if (!empty($NameError)): ?>
                                <span class="help-inline"><?php echo $NameError;?></span>
                            <?php endif; ?>
                        </div>
                      </div>
                      <div class="control-group <?php echo !empty($UserNameError)?'error':'';?>">
                        <label class="control-label">User Name</label>
                        <div class="controls">
                            <input Name="UserName" type="text" placeholder="User Name" value="<?php echo !empty($UserName)?$UserName:'';?>">
                            <?php if (!empty($UserNameError)): ?>
                                <span class="help-inline"><?php echo $UserNameError;?></span>
                            <?php endif;?>
                        </div>
                      </div>
                      <div class="control-group <?php echo !empty($PasswordError)?'error':'';?>">
                        <label class="control-label">Password</label>
                        <div class="controls">
                            <input Name="Password" type="text"  placeholder="Password" value="<?php echo !empty($Password)?$Password:'';?>">
                            <?php if (!empty($PasswordError)): ?>
                                <span class="help-inline"><?php echo $PasswordError;?></span>
                            <?php endif;?>
                        </div>
                      </div>
                      <div class="form-actions">
                          <button type="submit" class="btn btn-success">Create</button>
                          <a class="btn" href="index3.php">Back</a>
                        </div>
                    </form>
                </div>
                 
    </div> <!-- /container -->
  </body>
</html>