<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <script src="js/bootstrap.min.js"></script>
    <?php 
        $filmID = htmlspecialchars($_GET['id']);
    ?>
</head>
 
<body>
    <div class="container">
            <div class="row">
                <?php 
                  echo '<h3>Movie ID = ' .$filmID. '</h3>';
                ?>
            </div>
            <div class="row">
                <p>
                    <a href="create.php" class="btn btn-success">Create</a>
                </p>
                <table class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th>Film Name</th>
                          <th>IMDB Rating</th>
                          <th>Description</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php
                       include 'database.php';
                       $pdo = Database::connect();
                       $sql = "SELECT * FROM film WHERE FilmId ='".$filmID."'";
                       foreach ($pdo->query($sql) as $row) {
                                echo '<tr>';
                                echo '<td>'. $row['FilmName'] . '</td>';
                                echo '<td>'. $row['Rating'] . '</td>';
                                echo '<td>'. $row['Description'] . '</td>';
                                echo '<td><a class="btn" href="read.php?CustomerId='.$row['CustomerId'].'">Read</a></td>';
                                echo '</tr>';
                       }
                       Database::disconnect();
                      ?>
                      </tbody>
                </table>
        </div>
    </div> <!-- /container -->
  </body>
</html>