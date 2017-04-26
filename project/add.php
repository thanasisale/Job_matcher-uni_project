
    <?php include 'head.php';
    //include("auth.php");
    ?>
    <title>Add Data</title>

        <div class="add">

            <!--<div class="redirect"><a href="home.php">Home</a></div>-->

            <form action="add.php" method="post" name="form1">
                <div class="title"><h3>Add a new Entry Here!</h3></div>
                <table border="0">
                    <tr> 
                        <td>First Name</td>
                        <td><input type="text" name="fname" required></td>
                    </tr>
                    <tr> 
                        <td>Last Name</td>
                        <td><input type="text" name="lname" required></td>
                    </tr>
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
                        <td class="btn"><input type="submit" name="Submit" value="Submit"></td>
                    </tr>
                </table>
            </form>
            
        </div>
	
	
        <?php
        //including the database connection file 

        if(isset($_POST['Submit'])) {    
            
            $fname = stripslashes($_POST['fname']);
            $fname = mysqli_real_escape_string($mysqli,$fname);
            
            $lname = stripslashes($_POST['lname']);
            $lname = mysqli_real_escape_string($mysqli,$lname);
            
            $email = stripslashes($_POST['email']);
            $email = mysqli_real_escape_string($mysqli,$email);
            
            $pass = stripslashes($_POST['pass']);
            $pass = mysqli_real_escape_string($mysqli,$pass);
            
            

            // checking empty fields
            if(empty($fname) || empty($lname) || empty($email) || empty($pass)) {                
                if(empty($fname)) {
                    echo "<font color='red'>Name field is empty.</font><br/>";
                }

                if(empty($lname)) {
                    echo "<font color='red'>Name field is empty.</font><br/>";
                }

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
                //insert data to database
                $result = mysqli_query($mysqli, "INSERT INTO userstab(fname,lname,email,pass) VALUES('$fname','$lname','$email','$pass')");

                //display success message
                if($result){
                    echo "<font color='green'>Data added successfully.";
                    echo "<br/><a href='home.php'>View Result</a>";
                }else{
                    echo "<div class='title' style='color:red;'><h3>Error!</h3></div>";
                }
                
            }
        }
        ?>
        <?php include 'footer.php';?>