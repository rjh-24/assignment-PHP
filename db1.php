<?php
  $server = SERVER;
  $userid = USERID;
  $pw = PWD;
  $db = DB;

  $conn = new mysqli($server, $userid, $pw);

  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

  $conn->select_db($db);

  $sql = "SELECT * FROM Genre";
  $result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Select Genres</title>
</head>
<body>
  <form action="db2.php" method="POST">
    <h2>Select Genres:</h2>
    <?php
      if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
          echo '<input type="checkbox" name="genres[]" value="' . htmlspecialchars($row['genre_name']) . '"> ' . htmlspecialchars($row['genre_name']) . '<br>';
        }
      } else {
        echo "no results";
      }
    ?>
    <br>
    <input type="submit" value="Submit">
  </form>
</body>
</html>

<?php
  $conn->close();
?>