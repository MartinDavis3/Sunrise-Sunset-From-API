<?php

include './includes/SunriseSunset.Class.php';

// this is code that sets error reporting to cover all errors
ini_set( 'display_errors', 1);
ini_set( 'display_startup_errors', 1);
error_reporting( E_ALL );

  $siteURL = 'https://api.sunrise-sunset.org/json';
  $latitude = '';
  $longitude = '';

  if ( isset( $_GET ) && !empty( $_GET ) )
  {
    $latitude = $_GET['latitude'];
    $longitude = $_GET['longitude'];
    $searchURL = $siteURL.'?lat='.$latitude.'&lng='.$longitude.'&formatted=0';

    $date = new DateTime(null, new DateTimeZone('Europe/London'));
    $tz = $date->getTimezone();

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
        <label for="username">
          Latitude:
          <input type="text" name="latitude" id="latitude">
        </label>
        <label>
        <label for="password">
          Longitude:
          <input type="text" name="longitude" id="longitude">
        </label>
        </label>
          <input type="submit" value="Show Times">
        </label>
      </form>
      <p><?php
        if( isset( $searchURL ) )
        {
          echo $searchURL;
          echo $tz->getName();
          echo $newSunriseSunset->output();
        }
      ?>
      <pre>
        <?php var_dump( $newSunriseSunset ); ?>
      </pre>

</body>
</html>
