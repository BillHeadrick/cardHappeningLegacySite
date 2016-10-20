<?php

$date = getdate();
$month = $date['month'];
$day = $date['mday'];
$year = $date['year'];
$output = $day . " " . $month . " " . $year;
echo $output;
?>