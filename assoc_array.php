<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Associative Arrays - PHP</title>
  <style>
    .office-hours {
      max-width: 300px;
      margin: 20px;
    }

    .office-hours div {
      display: flex;
      justify-content: space-between;
      padding: 5px 0;
    }

    .day {
      font-weight: bold;
    }
  </style>
</head>
<body>
  <div class="office-hours">
    <p>Office Hours</p>
    <?php
      $officeHours = array(
        'Monday' => '9am - 4pm', 
        'Tuesday' => '9am - 4pm',
        'Wednesday' => '9am - 4pm',
        'Thursday' => '9am - 4pm',
        'Friday' => '9am - 4pm',
        'Saturday' => 'Closed',
        'Sunday' => 'Closed',
      );

      function displayOfficeHours($hours) {
        $output = "";
        foreach($hours as $day => $time) {
          $output .= "
            <div>
              <span class='day'>$day</span>
              <span>$time</span>
            </div>
          ";
        }
        return $output;
      }

      echo displayOfficeHours($officeHours)
    ?>
  </div>
</body>
</html>