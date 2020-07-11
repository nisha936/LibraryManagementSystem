<?php
    include "connection.php";
    include "navbar.php";
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Admin Login</title>
        <link rel="stylesheet" type="text/css" href="style.css">
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>
    <body>
          
        <section>
            <div class="login_img">
                <br>
                <div class="box1">
                    <h1 style="text-align: center; font-size: 35px;font-family:Arial, Helvetica, sans-serif;">Library Management System</h1>
                    <h2 style="text-align: center; font-size: 25px;"> User Login Form</h2><br>
                    <div class="login">
                    <form name="Login" action="" method="post">
                        <input type="text" name="username" placeholder="Username" required="" class="form-control"><br>
                        <input type="password" name="password" placeholder="Password" required="" class="form-control"><br> 
                        <input class="btn-default" type="submit" name="submit" value="Login" style="color: black; width: 80px; height: 30px;border-radius: 5px;">
                       
                    </div>
                    
                    <p style="color: white; padding-left: 50px;">
                        <br>&nbsp &nbsp &nbsp &nbsp 
                        <a style="color: white;" href="update-password.php">Forget Password?</a>&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp
                        <a style="color: white;" href="registration.php">Sign Up</a>
                        
                    </p>
                </form>
                </div>
                
            </div>
        </section>

        <?php

            if(isset($_POST['submit']))
            {
                $count=0;
                $result=mysqli_query($db,"SELECT * FROM `admin` WHERE username='$_POST[username]' && password='$_POST[password]';");

                $row= mysqli_fetch_assoc($result);


                $count=mysqli_num_rows($result);

                if($count==0)
                {
                    ?>
                    <script type="text/javascript">
                        alert("The username and password doesn't match.");
                    </script>

                   <!--  <div class="alert alert-danger" style="width: 500px; margin-left: 300px; background-color: #de1313; color: white;">
                        <strong>The username and password doesn't match.</strong>
                    </div> -->

                    <?php
                }

                else
                {
                    // --------if username and password matches------
                   
                    $_SESSION['login_user']= $_POST['username'];
                    $_SESSION['photo']=$row['photo'];
                    $_SESSION['username']='';
                    ?>
                        <script type="text/javascript">
                            window.location="adminprofile.php"
                        </script>
                    <?php
                }
            }

        ?>

      
    </body>
</html>