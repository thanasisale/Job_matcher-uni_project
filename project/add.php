<?php include 'head.php'; ?>
    <title>Register</title>

        <div class="add">

            <!--<div class="redirect"><a href="home.php">Home</a></div>-->

            <form action="add.php" method="post" name="form1">
                <div class="title"><h3>Add a new Entry Here!</h3></div>
                <table border="0">
                    <tr>
                        <td>Email</td>
                        <td><input type="text" name="email" required></td>
                    </tr>
                    <tr>
                        <td>Password</td>
                        <td><input type="password" name="pass" required></td>
                    </tr>
                    <tr>
                        <td>Type</td>
                        <td>
                            <input type="radio" name="type" value="company">Company
                            <input type="radio" name="type" value="worker">Worker
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td class="btn"><input type="submit" name="Submit" value="Submit"></td>
                    </tr>
                </table>
            </form>

        </div>


        <?php

        // establishing some kind of security for the db
        if(isset($_POST['Submit'])) {

            $email = stripslashes($_POST['email']);
            $email = mysqli_real_escape_string($mysqli,$email);

            $pass = stripslashes($_POST['pass']);
            $pass = mysqli_real_escape_string($mysqli,$pass);

            $type = $_POST["type"];



            // checking empty fields
            if(empty($email) || empty($pass)|| empty($type)) {

                if(empty($pass)) {
                    echo "<font color='red'>Password field is empty.</font><br/>";
                }

                if(empty($email)) {
                    echo "<font color='red'>Email field is empty.</font><br/>";
                }

                if(empty($type)) {
                    echo "<font color='red'>Type field is empty.</font><br/>";
                }

                //link to the previous page
                echo "<br/><a href='javascript:self.history.back();'>Go Back</a>";
            } else {
                // if all the fields are filled (not empty)
                //insert data to database

                $result = mysqli_query($mysqli, "INSERT INTO usertab(email,pass,type) VALUES('$email','$pass','$type')");

                //display success message
                if($result){
                    echo "<font color='green'>Data added successfully.";
                    echo "<br/><a href='profile.php'>View Result</a>";
                    echo "<script>
                    var element = document.querySelector('.add');
                        removeJunk(element);
                    </script>";
                }else{
                    echo "<div class='title' style='color:red;'><h3>Error!</h3></div>";
                }

            }
        }
        ?>
        <?php include 'footer.php';?>
