<?php
class SunriseSunset {
  public $sunrise = "";
  public $sunset = "";
  public $solar_noon = "";
  public $day_length = 0;
  public $civil_twilight_begin = "";
  public $civil_twilight_end = "";
  public $nautical_twilight_begin = "";
  public $nautical_twilight_end = "";
  public $astronomical_twilight_begin = "";
  public $astronomical_twilight_end = "";

  function __construct(
    $sunrise = "",
    $sunset = "",
    $solar_noon = "",
    $day_length = 0,
    $civil_twilight_begin = "",
    $civil_twilight_end = "",
    $nautical_twilight_begin = "",
    $nautical_twilight_end = "",
    $astronomical_twilight_begin = "",
    $astronomical_twilight_end = ""
  )
  {
    $this->sunrise = $sunrise;
    $this->sunset = $sunset;
    $this->solar_noon = $solar_noon;
    $this->day_length = $day_length;
    $this->civil_twilight_begin = $civil_twilight_begin;
    $this->civil_twilight_end = $civil_twilight_end;
    $this->nautical_twilight_begin = $nautical_twilight_begin;
    $this->nautical_twilight_end = $nautical_twilight_end;
    $this->astronomical_twilight_begin = $astronomical_twilight_begin;
    $this->astronomical_twilight_end = $astronomical_twilight_end;
  }

  public function output ()
  {
    $output = '';
    ob_start();
    ?>
    <p><?php $this->sunrise; ?></p>
    <p><?php $this->sunset; ?></p>
    <p><?php $this->solar_noon; ?></p>
    <p><?php $this->civil_twilight_begin; ?></p>
    <p><?php $this->civil_twilight_end; ?></p>
    <p><?php $this->nautical_twilight_begin; ?></p>
    <p><?php $this->nautical_twilight_end; ?></p>
    <p><?php $this->astronomical_twilight_begin; ?></p>
    <p><?php $this->astronomical_twilight_end; ?></p>
    <?php
    $output = ob_get_clean();
    return $output;    
  }

}
















?>