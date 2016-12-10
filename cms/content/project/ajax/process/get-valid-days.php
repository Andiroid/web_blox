<?php

$year = $_POST['year'];
$month = $_POST['month'];

//echo $year;
//echo $month;

$number = cal_days_in_month(CAL_GREGORIAN, $month, $year);

echo $number;

?>