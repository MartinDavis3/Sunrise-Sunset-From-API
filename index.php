<?php
include './includes/SunriseSunset.Class.php';

$siteURL = 'https://api.sunrise-sunset.org/json';
$continent = '';
$city = '';
$latitude = 0;
$longitude = 0;
$getTimeZoneFailed = FALSE;
$dataReady = FALSE;

  if ( isset( $_GET['continent'] ) && !empty( $_GET['continent'] ) && isset( $_GET['city'] ) && !empty( $_GET['city'] ) )
  {
    $continent = $_GET['continent'];
    $city = $_GET['city'];
    $dataReady = TRUE;
    //The Continent / City pair entered may not exist in system database.
    //Therefore need a try / catch block.
    try {
      $dateTime = new DateTime(null, new DateTimeZone($continent.'/'.$city));
      // $dateTimeUTC = new DateTime(null, new DateTimeZone('UTC'));
      $timeZone = $dateTime->getTimezone();
    } catch (Exception $e) {
      //Should really test exception type here - but outside the scope of current project
      $getTimeZoneFailed = TRUE;
    }

    if ( !$getTimeZoneFailed )
    {
      //Get location returns an array with
      //latitude  and longitude in.
      $location = $timeZone->getLocation();
      $latitude = $location['latitude'];
      $longitude = $location['longitude'];
      //Use search lat, long search function of API.
      $searchURL = $siteURL.'?lat='.$latitude.'&lng='.$longitude.'&formatted=0';

      $retrievedJSONString = file_get_contents( $searchURL );
      $retrievedObject = json_decode( $retrievedJSONString );
      $retrievedSunriseSunset = $retrievedObject->results;
      //Create new object of SunriseSunset class from returned data
      //and time zone found from system for city.
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
        $retrievedSunriseSunset->astronomical_twilight_end,
        $timeZone
      );
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
    <p>Enter the continent and city,</p>
    <p>(Continents: Africa, America, Asia, Australia, Europe.)</p>
    <p>Use underscore instead of space.</p>
    <form action="./index.php" method="GET">
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
      if( $dataReady )
      {
        if( !$getTimeZoneFailed )
        {
          ?> <h2>Times for <?php echo $city ?></h2>
          <?php
          echo $newSunriseSunset->output();
        } else {
          echo 'Continent / City pair not found. Please try again.';
        }
      }
    ?>
  </body>
</html>
