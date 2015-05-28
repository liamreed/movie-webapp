<?php
    require 'database.php';
    $CustomerId = 0;
     
    if ( !empty($_GET['CustomerId'])) {
        $CustomerId = $_REQUEST['CustomerId'];
    }
     
    if ( !empty($_POST)) {
        // keep track post values
        $CustomerId = $_POST['CustomerId'];
         
        // delete data
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "DELETE FROM customer  WHERE CustomerId = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($CustomerId));
        Database::disconnect();
        header("Location: index3.php");
         
    }
?>
 
<!DOCTYPE html>
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
                        <h3>Delete a Customer</h3>
                    </div>
                     
                    <form class="form-horizontal" action="delete.php" method="post">
                      <input type="hidden" Name="CustomerId" value="<?php echo $CustomerId;?>"/>
                      <p class="alert alert-error">Are you sure to delete ?</p>
                      <div class="form-actions">
                          <button type="submit" class="btn btn-danger">Yes</button>
                          <a class="btn" href="index3.php">No</a>
                        </div>
                    </form>
                </div>
                 
    </div> <!-- /container -->
  </body>
</html>