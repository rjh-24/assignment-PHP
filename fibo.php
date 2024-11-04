<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Fibonacci Sequence - PHP</title>
</head>
<body>
  <?php
    if (isset($_GET['n'])) {
      $n = $_GET['n'];
      $fibSequence = [];

      if ($n > 0) {
        $fibSequence[] = 0;
      }

      if ($n > 1) {
        $fibSequence[] = 1;
      }

      for ($i = 2; $i < $n; $i++) {
        $fibSequence[] = $fibSequence[$i - 1] + $fibSequence[$i - 2];
      }

      $response = [
        'length' => $n,
        'fibSequence' => $fibSequence
      ];

      echo json_encode($response);
    } else {
      echo "Please provide a value for 'n' in the query string.";
    }
  ?>
</body>
</html>