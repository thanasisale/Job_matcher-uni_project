<?php

/**
 * using mysqli_connect to establish connection with the db
 */

$databaseHost = 'dbhost.gr';
$databaseName = 'name';
$databaseUsername = 'user';
$databasePassword = 'pass';

$mysqli = mysqli_connect($databaseHost, $databaseUsername, $databasePassword, $databaseName);
?>
