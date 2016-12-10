<?php

require_once($_SERVER['DOCUMENT_ROOT'] . "/inc/general.php");

$sql = "SELECT count(*) as total from p_core WHERE p_draft='1'";
$query = mysqli_query($conn, $sql);
$row = mysqli_fetch_row($query);
$total_rows = $row[0];

echo $total_rows;
?>