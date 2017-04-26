
    <?php include 'head.php';?>

    <?php
    // including the database connection file

    if(isset($_POST['update']))
    {    
        $id = $_POST['id'];

        $fname = stripslashes($_POST['fname']);
        $fname = mysqli_real_escape_string($mysqli,$fname);
            
        $lname = stripslashes($_POST['lname']);
        $lname = mysqli_real_escape_string($mysqli,$lname);
            
        $email = stripslashes($_POST['email']);
        $email = mysqli_real_escape_string($mysqli,$email);
            
        $pass = stripslashes($_POST['pass']);
        $pass = mysqli_real_escape_string($mysqli,$pass);

        // checking empty fields
        if(empty($fname) || empty($lname) || empty($pass) || empty($email)) {            
            if(empty($fname)) {
                echo "<font color='red'>Name field is empty.</font><br/>";
            }

            if(empty($lname)) {
                echo "<font color='red'>Last name field is empty.</font><br/>";
            }

            if(empty($pass)) {
                echo "<font color='red'>Password field is empty.</font><br/>";
            }

            if(empty($email)) {
                echo "<font color='red'>Email field is empty.</font><br/>";
            }        
        } else {    
            //updating the table
            $result = mysqli_query($mysqli, "UPDATE userstab SET fname='$fname',lname='$lname',email='$email',pass='$pass' WHERE id=$id");

            //redirectig to the display page. In our case, it is home.php
            header("Location: home.php");
        }
    }
    ?>
    <?php
    //getting id from url
    $id = $_GET['id'];

    //selecting data associated with this particular id
    $result = mysqli_query($mysqli, "SELECT * FROM userstab WHERE id=$id");

    while($res = mysqli_fetch_array($result))
    {
        $fname = $res['fname'];
        $lname = $res['lname'];
        $pass = $res['pass'];
        $email = $res['email'];
    }
    ?>

    <title>Edit Data</title>

        <div class="edit">
           
            <!--<div class="redirect"><a href="home.php">Home</a></div>-->
            <div class="title"><h3>Here You can edit the users!</h3></div>

            <form name="form1" method="post" action="edit.php">
                <table border="0">
                    <tr> 
                        <td>First Name</td>
                        <td><input type="text" name="fname" value="<?php echo $fname;?>"></td>
                    </tr>
                    <tr> 
                        <td>Last Name</td>
                        <td><input type="text" name="lname" value="<?php echo $lname;?>"></td>
                    </tr>
                    <tr> 
                        <td>Email</td>
                        <td><input type="text" name="email" value="<?php echo $email;?>"></td>
                    </tr>
                    <tr> 
                        <td>Password</td>
                        <td><input type="password" name="pass" value="<?php echo $pass;?>"></td>
                    </tr>
                    <tr>
                        <td><input type="hidden" name="id" value=<?php echo $_GET['id'];?>></td>
                        <td class="btn"><input type="submit" name="update" value="Update"></td>
                    </tr>
                </table>
            </form>
        </div>
    <?php include 'footer.php';?>