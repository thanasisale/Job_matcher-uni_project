<?php/*
//including the database connection file
include 'head.php';
include 'auth.php';
include 'automach.php';
//fetching data in ascending order (first entry first)

$resultall = mysqli_query($mysqli, "SELECT * FROM usertab WHERE ID = $wid ORDER BY ID ASC"); // using mysqli_query
while($restall = mysqli_fetch_array($restall)){
  $email = $restall['email'];
}
?>


        <title>Result Page</title>

        <div class="home">

            <div class="title"><h3>Αποτελέσματα</h3></div>
            <table>
                <tr>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                </tr>
                <?php
                //Showing the db records
                $i = 0;
                while ($i <= $n) {
                  echo "<tr>";
                  echo "<td>".$wfname[$i]."</td>";
                  echo "<td>".$wlname[$i]."</td>";
                  echo "<td>".$email[$i]."</td>";
                  echo "<td><a href=\"profile.php?id=$wid[$i]\">View</a>";
                  $i = $i + 1;
                }

                ?>
            </table>
        </div>
        <?php include 'footer.php';*/?>
