<!DOCTYPE html>
<?php
    require 'database.php';
 
    $CustomerId = null;
    if ( !empty($_GET['CustomerId'])) {
        $CustomerId = $_REQUEST['CustomerId'];
    }
     
    if ( null==$CustomerId ) {
        header("Location: index3.php");
    }
     
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
            $UserNameError = 'Please enter UserName';
            $valid = false;
        } 
         
        if (empty($Password)) {
            $PasswordError = 'Please enter Password Number';
            $valid = false;
        }
         
        // update data
        if ($valid) {
            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "UPDATE customer  set Name = ?, UserName = ?, Password =? WHERE CustomerId = ?";
            $q = $pdo->prepare($sql);
            $q->execute(array($Name,$UserName,$Password,$CustomerId));
            Database::disconnect();
            header("Location: index3.php");
        }
    } else {
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * FROM customer where CustomerId = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($CustomerId));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        $Name = $data['Name'];
        $UserName = $data['UserName'];
        $Password = $data['Password'];
        Database::disconnect();
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
                        <h3>Update a Customer</h3>
                    </div>
             
                    <form class="form-horizontal" action="update.php?CustomerId=<?php echo $CustomerId?>" method="post">
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
                        <label class="control-label">UserName Address</label>
                        <div class="controls">
                            <input Name="UserName" type="text" placeholder="UserName Address" value="<?php echo !empty($UserName)?$UserName:'';?>">
                            <?php if (!empty($UserNameError)): ?>
                                <span class="help-inline"><?php echo $UserNameError;?></span>
                            <?php endif;?>
                        </div>
                      </div>
                      <div class="control-group <?php echo !empty($PasswordError)?'error':'';?>">
                        <label class="control-label">Password Number</label>
                        <div class="controls">
                            <input Name="Password" type="text"  placeholder="Password Number" value="<?php echo !empty($Password)?$Password:'';?>">
                            <?php if (!empty($PasswordError)): ?>
                                <span class="help-inline"><?php echo $PasswordError;?></span>
                            <?php endif;?>
                        </div>
                      </div>
                      <div class="form-actions">
                          <button type="submit" class="btn btn-success">Update</button>
                          <a class="btn" href="index3.php">Back</a>
                        </div>
                    </form>
                </div>
                 
    </div> <!-- /container -->
  </body>
</html>