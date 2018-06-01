<?php
 
/**
 * using mysqli_connect to establish connection with the db
 */
 
$databaseHost = 'db-private.apps-cp.openworks.gr';
$databaseName = 'thanasis';
$databaseUsername = 'thanasis';
$databasePassword = 'thanasis123';
 
$mysqli = mysqli_connect($databaseHost, $databaseUsername, $databasePassword, $databaseName); 
?>