<?php
//including the header file
include 'head.php';
?>


        <title>Home Page</title>

        <div class=" container home">

          <div class="row">
            <div class="col-sm welcome">
              <h2>Welcome,</h2>
              <p>This web application helps you to find a job well suited for you, or a worker for your company.</p>
            </div>
          </div>

          <div class="row" style="text-align:center;">
            <div class="col-sm logincol">
              <p>If you already have an acount you can log in here, else...</p>
              <a href="login.php" class="btn btn-primary custombtn"> Log in </a>
            </div>
            <div class="col-sm subcol">
              <p>If you are a company, wich is trying to find a good worker or a worker, who searches a fine job you can register here.</p>
              <a href="add.php" class="btn btn-primary custombtn">Register</a>
            </div>
          </div>

        </div>

        <?php include 'footer.php';?>
