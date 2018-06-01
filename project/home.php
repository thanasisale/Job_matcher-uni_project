<?php
//including the database connection file
include 'head.php';
include 'auth.php';
//include 'automach.php';
//fetching data in descending order (lastest entry first)

$result = mysqli_query($mysqli, "SELECT * FROM usertab ORDER BY id DESC"); // using mysqli_query
?>

        <title>Homepage</title>

        <div class="home">

            <div class="title"><h3>Αποτελέσματα</h3></div>
            <table>
                <tr>
                    <th>Email</th>
                    <th>Password</th>
                    <th>Type</th>
                    <?php //<th>Update</th> ?>
                </tr>
                <?php
                //Showing the db records
                while($res = mysqli_fetch_array($result)) {
                    echo "<tr>";
                    echo "<td>".$res['email']."</td>";
                    echo "<td>".'<input type="password" value='.$res["pass"].' disabled>'."</td>";
                    echo "<td>".$res['type']."</td>";
                    //echo "<td><a href=\"edit.php?id=$res[id]\">Edit</a> | <a href=\"delete.php?id=$res[id]\" onClick=\"return confirm('Are you sure you want to delete this?')\">Delete</a></td>";
                }
                ?>
            </table>
        </div>
        <?php include 'footer.php';?>
