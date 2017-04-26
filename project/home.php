

<?php
//including the database connection file
include 'head.php';
include("auth.php");

//fetching data in descending order (lastest entry first)
//$result = mysql_query("SELECT * FROM users ORDER BY id DESC"); // mysql_query is deprecated
$result = mysqli_query($mysqli, "SELECT * FROM userstab ORDER BY id DESC"); // using mysqli_query instead
?>
 
        <title>Homepage</title>

        <div class="home">
            
            <!--<div class="redirect"><a class="redirect" href="add.php">Add New Data</a></div>-->
            
            <div class="title"><h3>Δεδομένα Χρηστών</h3></div>
            <table>
                <tr>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Password</th>
                    <th>Update</th>
                </tr>
                <?php 
                //while($res = mysql_fetch_array($result)) { // mysql_fetch_array is deprecated, we need to use mysqli_fetch_array 
                while($res = mysqli_fetch_array($result)) {         
                    echo "<tr>";
                    echo "<td>".$res['fname']."</td>";
                    echo "<td>".$res['lname']."</td>";
                    echo "<td>".$res['email']."</td>";
                    echo "<td>".'<input type="password" value='.$res["pass"].' disabled>'."</td>";
                    echo "<td><a href=\"edit.php?id=$res[id]\">Edit</a> | <a href=\"delete.php?id=$res[id]\" onClick=\"return confirm('Are you sure you want to delete this?')\">Delete</a></td>";        
                }
                ?>
            </table>
        </div>
        <?php include 'footer.php';?>