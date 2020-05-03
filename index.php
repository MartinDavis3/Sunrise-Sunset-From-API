<?php
  if ( isset( $_GET['reset'] ) )
  {
    session_unset();
    session_destroy();
    session_start();
  }

include './includes/SunriseSunset.Class.php';

// this is code that sets error reporting to cover all errors
ini_set( 'display_errors', 1);
ini_set( 'display_startup_errors', 1);
error_reporting( E_ALL );

  $siteURL = 'https://api.sunrise-sunset.org/json';
  $continent = '';
  $city = '';
  $latitude = 0;
  $longitude = 0;
  $getTimeZoneFailed = FALSE;
  $timeOffset = 0;

  if ( isset( $_GET ) && !empty( $_GET ) )
  {
    $continent = $_GET['continent'];
    $city = $_GET['city'];
    // $searchURL = $siteURL.'?lat='.$latitude.'&lng='.$longitude.'&formatted=0';
    try {
      $dateTime = new DateTime(null, new DateTimeZone($continent.'/'.$city));
      $dateTimeUTC = new DateTime(null, new DateTimeZone('UTC'));
      $timeZone = $dateTime->getTimezone();
      $timeOffset = $timeZone->getOffset($dateTimeUTC);
    } catch (Exception $e) {
      //Should really test exception type here - but outside the scope of current project
      echo 'Continent / City pair not found. Please try again.';
      $getTimeZoneFailed = TRUE;
    }

    if ( !$getTimeZoneFailed )
    {
      //Get location returns an array with
      //latitude  and longitude in.
      $location = $timeZone->getLocation();
      $latitude = $location['latitude'];
      $longitude = $location['longitude'];
      $searchURL = $siteURL.'?lat='.$latitude.'&lng='.$longitude.'&formatted=0';

      $retrievedJSONString = file_get_contents( $searchURL );
      $retrievedObject = json_decode( $retrievedJSONString );
      $retrievedSunriseSunset = $retrievedObject->results;
      $newSunriseSunset = new SunriseSunset(
        $retrievedSunriseSunset->sunrise,
        $retrievedSunriseSunset->sunset,
        $retrievedSunriseSunset->solar_noon,
        $retrievedSunriseSunset->day_length,
        $retrievedSunriseSunset->civil_twilight_begin,
        $retrievedSunriseSunset->civil_twilight_end,
        $retrievedSunriseSunset->nautical_twilight_begin,
        $retrievedSunriseSunset->nautical_twilight_end,
        $retrievedSunriseSunset->astronomical_twilight_begin,
        $retrievedSunriseSunset->astronomical_twilight_end
      );

      // $sunriseDateTime = new DateTime($newSunriseSunset->sunrise);
    }

  }

?><!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sunrise and Sunset</title>
</head>
<body>
  <h1>Sunrise and Sunset</h1>
  <form action="./index.php" method="GET">
    <input type="submit" name="reset" value="Reset">
        <label for="continent">
          Continent:
          <input type="text" name="continent" id="continent">
        </label>
        <label>
        <label for="city">
          City:
          <input type="text" name="city" id="city">
        </label>
        </label>
          <input type="submit" name ="show-times" value="Show Times">
        </label>
      </form>
      <p><?php
        if( isset( $timeZone ) )
        {
          echo $searchURL;
          echo $timeZone->getName();
          echo $timeOffset;
          echo $newSunriseSunset->output();
          // echo date_format($newSunriseSunset->sunrise, 'H:i:s');
        }
      ?>
      <pre>
        <?php var_dump( $timeZone ); ?>
      </pre>

</body>
</html>
