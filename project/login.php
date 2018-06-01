<?php
include 'head.php';
?>

<title>Log in</title>

<div class="login">
  <!--<div class="redirect"><a href="home.php">Home</a></div>-->

  <form action="login.php" method="post" name="form1">
    <div class="title"><h3>Log In Here </h3></div>
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
                        <td></td>
                        <td class="btn"><input type="submit" name="Submit" value="Log In"></td>
                    </tr>
                </table>
            </form>

        </div>


        <?php
        //including the database connection file

        if(isset($_POST['Submit'])) {

            $email = stripslashes($_POST['email']);
            $email = mysqli_real_escape_string($mysqli,$email);

            $pass = stripslashes($_POST['pass']);
            $pass = mysqli_real_escape_string($mysqli,$pass);


            // checking empty fields
            if(empty($email) || empty($pass)) {

                if(empty($pass)) {
                    echo "<font color='red'>Password field is empty.</font><br/>";
                }

                if(empty($email)) {
                    echo "<font color='red'>Email field is empty.</font><br/>";
                }

                //link to the previous page
                echo "<br/><a href='javascript:self.history.back();'>Go Back</a>";
            } else {
                // if all the fields are filled (not empty)
                //checking the credentials and establishing a session
                $result = mysqli_query($mysqli, "SELECT * FROM usertab WHERE email='$email'and pass='$pass'") or die(mysql_error());

                $rows = mysqli_num_rows($result);
                if($rows == 1) {

                    $_SESSION['email'] = $email;
                    echo("<script>location.href = '"."profile.php';</script>");
                    // header ("Location: home.php");

                }else {

                    echo "<p style='color:red;text-align:center;'>Username/Password is incorrect.";
                    echo "<br/><a href='login.php'>Try Again Later</a>";

                }



            }
        }
        ?>
        <?php include 'footer.php';?>
