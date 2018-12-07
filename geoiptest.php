<?php
$country = isset($_SERVER['GEOIP_COUNTRY_CODE'])? $_SERVER['GEOIP_COUNTRY_CODE'] : '--';
echo $country;
?>
