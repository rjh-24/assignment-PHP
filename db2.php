<?php
 $server = SERVER;
  $userid = USERID;
  $pw = PWD;
  $db = DB;

  $conn = new mysqli($server, $userid, $pw);

  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

  if (isset($_POST['genres']) && is_array($_POST['genres'])) {
    $selectedGenres = $_POST['genres'];

    $sanitizedGenres = array_map(function($genre) use ($conn) {
      return "'" . $conn->real_escape_string($genre) . "'";
    }, $selectedGenres);

    $genreList = implode(",", $sanitizedGenres);
  } else {
    echo "No genres selected.";
    $result = null; 
  }

  $conn->select_db($db);
  $sql = "SELECT distinct title, artist_name 
          FROM Song_Genre 
          INNER JOIN Song ON Song.id = song_id 
          INNER JOIN Artist ON Artist.id = Song.artist_id 
          INNER JOIN Genre ON Genre.id = genre_id 
          WHERE Genre.genre_name IN ($genreList)";
  $result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Selected Songs</title>
  <style>
    table {
      width: 100%;
      border-collapse: collapse;
    }

    th, td {
      border: 1px solid #ddd;
      padding: 8px;
      text-align: left;
    }

    th {
      background-color: #e7e5e4;
    }
  </style>
</head>
<body>
  <h2>Song List</h2>
  <table>
    <tr>
      <th>Title</th>
      <th>Artist</th>
    </tr>
    <?php
      if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
          echo "<tr><td>" . htmlspecialchars($row['title']) . "</td><td>" . htmlspecialchars($row['artist_name']) . "</td></tr>";
        }
      } else {
        echo "<tr><td colspan='2'>No songs found for the selected genres.</td></tr>";
      }
    ?>
  </table>
</body>
</html>

<?php
  $conn->close();
?>