
<?php include_once("config.php");?>
<?php
//including the database connection file 
 
//getting id of the data from url
$id = $_GET['id'];
 
//deleting the row from table
$result = mysqli_query($mysqli, "DELETE FROM userstab WHERE id=$id");
 
//redirecting to the display page (home.php in our case)
header("Location:home.php");
?> 