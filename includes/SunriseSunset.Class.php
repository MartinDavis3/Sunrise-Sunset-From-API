<?php
class SunriseSunset {
  public $sunrise = "0001-01-01T00:00:00+00:00";
  public $sunset = "0001-01-01T00:00:00+00:00";
  public $solar_noon = "0001-01-01T00:00:00+00:00";
  public $day_length = 0;
  public $civil_twilight_begin = "0001-01-01T00:00:00+00:00";
  public $civil_twilight_end = "0001-01-01T00:00:00+00:00";
  public $nautical_twilight_begin = "0001-01-01T00:00:00+00:00";
  public $nautical_twilight_end = "0001-01-01T00:00:00+00:00";
  public $astronomical_twilight_begin = "0001-01-01T00:00:00+00:00";
  public $astronomical_twilight_end = "0001-01-01T00:00:00+00:00";

  function __construct(
    $sunrise = "0001-01-01T00:00:00+00:00",
    $sunset = "0001-01-01T00:00:00+00:00",
    $solar_noon = "0001-01-01T00:00:00+00:00",
    $day_length = 0,
    $civil_twilight_begin = "0001-01-01T00:00:00+00:00",
    $civil_twilight_end = "0001-01-01T00:00:00+00:00",
    $nautical_twilight_begin = "0001-01-01T00:00:00+00:00",
    $nautical_twilight_end = "0001-01-01T00:00:00+00:00",
    $astronomical_twilight_begin = "0001-01-01T00:00:00+00:00",
    $astronomical_twilight_end = "0001-01-01T00:00:00+00:00"
  )
  {
    $this->sunrise = new DateTime($sunrise);
    $this->sunset = new DateTime($sunset);
    $this->solar_noon = new DateTime($solar_noon);
    $this->day_length = $day_length;
    $this->civil_twilight_begin = new DateTime($civil_twilight_begin);
    $this->civil_twilight_end = new DateTime($civil_twilight_end);
    $this->nautical_twilight_begin = new DateTime($nautical_twilight_begin);
    $this->nautical_twilight_end = new DateTime($nautical_twilight_end);
    $this->astronomical_twilight_begin = new DateTime($astronomical_twilight_begin);
    $this->astronomical_twilight_end = new DateTime($astronomical_twilight_end);
  }

  public function output()
  {
    $output = '';
    ob_start();
    ?>
    <p><?php echo date_format($this->sunrise, 'H:i:s'); ?></p>
    <p><?php echo date_format($this->sunset, 'H:i:s'); ?></p>
    <p><?php echo date_format($this->solar_noon, 'H:i:s'); ?></p>
    <p><?php echo date_format($this->civil_twilight_begin, 'H:i:s'); ?></p>
    <p><?php echo date_format($this->civil_twilight_end, 'H:i:s'); ?></p>
    <p><?php echo date_format($this->nautical_twilight_begin, 'H:i:s'); ?></p>
    <p><?php echo date_format($this->nautical_twilight_end, 'H:i:s'); ?></p>
    <p><?php echo date_format($this->astronomical_twilight_begin, 'H:i:s'); ?></p>
    <p><?php echo date_format($this->astronomical_twilight_end, 'H:i:s'); ?></p>
    <?php
    $output = ob_get_clean();
    return $output;    
  }

}
















?>