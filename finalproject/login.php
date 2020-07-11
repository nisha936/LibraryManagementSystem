<?php
    include "navbar.php";
    include "connection.php";
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Student Login</title>
        <link rel="stylesheet" type="text/css" href="style.css">
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <style type="text/css">
            .login_img
            {
                
                margin-top: 0px;
                background-image:url("images/3.jpg");
                background-size: cover;
                height: 615px;

            }
            .box1
            {
                height: 480px;
                width: 600px;
                background-color: black;
                margin: 25px auto;
                opacity: .7;
                color:white;
                padding: 30px; 
            }
            label
            {
                font-size: 20px;
                font-weight: 600;
            }
        </style>
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
                        <b><p style="padding-left: 10px;font-size: 20px;font-weight: 700;font-family:Arial, Helvetica, sans-serif;">Login as:</p></b>

                        <input style="margin-left: 10px; width: 15px;" type="radio" name="user" id="admin" value="admin">
                        <label for="admin">Admin</label>

                        <input style="margin-left: 10px; width: 15px;" type="radio" name="user" id="student" value="student" checked="">
                        <label for="student">Student</label>

                        
                        <input type="text" name="username" placeholder="Username" required="" class="form-control"><br>
                        <input type="password" name="password" placeholder="Password" required="" class="form-control"><br> 
                        <input class="btn-default" type="submit" name="submit" value="Login" style="color: black; width: 80px; height: 30px;border-radius: 5px;">
                       
                    
                    
                    <p style="color: white; padding-left: 50px;">
                        <br>&nbsp &nbsp &nbsp &nbsp 
                        <a style="color: white; text-decoration: none;" href="update-password.php">Forget Password?</a>&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp
                        <a style="color: white;text-decoration: none;" href="registration.php">Sign Up</a>
                        
                    </p>
                    </div>
                </form>
                </div>
                
            </div>
        </section>

        <?php

            if(isset($_POST['submit']))
            {
                if ($_POST['user']=='admin') 
                {
                  $count=0;
                $result=mysqli_query($db,"SELECT * FROM `admin` WHERE username='$_POST[username]' && password='$_POST[password]' AND status='Yes';");

                $row= mysqli_fetch_assoc($result);


                $count=mysqli_num_rows($result);

                if($count==0)
                {
                    ?>
                    <script type="text/javascript">
                        alert("You are not approved as an Admin yet!");
                    </script>

                    <?php
                }

                else
                {
                    // --------if username and password matches------
                   
                    $_SESSION['login_user']= $_POST['username'];
                    $_SESSION['photo']=$row['photo'];
                    ?>
                        <script type="text/javascript">
                            window.location="admin/adminprofile.php"
                        </script>
                    <?php
                }   
                }
                else
                {
                    $count=0;
                    $result=mysqli_query($db,"SELECT * FROM `student` WHERE username='$_POST[username]' && password='$_POST[password]';");

                    $row= mysqli_fetch_assoc($result);

                    $count=mysqli_num_rows($result);

                    if($count==0)
                    {
                        ?>
                        <script type="text/javascript">
                            alert("The username or password doesn't match.");
                        </script>

                        

                        <?php
                    }

                    else
                    {
                        $_SESSION['login_user']= $_POST['username'];
                        $_SESSION['photo']=$row['photo'];
                        ?>


                        ?>
                            <script type="text/javascript">
                                window.location="student/studentprofile.php"
                            </script>
                        <?php
                    }
                }
            }

        ?>

      
    </body>
</html>