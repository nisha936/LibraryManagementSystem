<?php
include "navbar.php";
include "connection.php";
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Student Registration</title>
        <link rel="stylesheet" type="text/css" href="style.css">
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">


    </head>
    <body>
        <section>
            <div class="reg_img"><br>
             <div class="box2">
                    <h1 style="text-align: center; font-size: 35px;  font-family:Arial, Helvetica, sans-serif;">Library Management System</h1>
                    <h2 style="text-align: center; font-size: 25px;"> User Registration Form</h2><br>
                    
                    <div class="signup">
                    <form name="Registration" action="" method="post" onsubmit="return validate();">     
                            <input  type="text" name="firstname" placeholder="First Name" required="" class="form-control"><br>
                            <input  type="text" name="lastname" placeholder="Last Name" required="" class="form-control"><br>
                            <input  type="text" name="faculty" placeholder="Faculty" required="" class="form-control"><br>
                            <input  type="text" name="semester" placeholder="Semester" required="" class="form-control"><br>
                            <input  type="text" name="LCID" placeholder="LCID" required="" class="form-control"><br>
                            <input   type="text" name="username" placeholder="Username" required="" class="form-control"><br>
                            <input  type="password" name="password" placeholder="Password" required="" class="form-control"><br>
                            <input  type="email" name="email" placeholder="Email" required="" class="form-control"><br>
                             <input  type="number" name="contact" placeholder="Contact Number" required="" class="form-control"><br>


                            
                            <input class="btn-default" type="submit" name="submit" value="Sign Up" style="color: black; width: 80px; height: 30px;border-radius: 5px;">
                        </div>
                    </form>
                 </div>
             </div>
        </section>

        <?php

            if(isset($_POST['submit']))
            {
                $count=0;
                $sql="SELECT username FROM student";
                $result=mysqli_query($db,$sql);

                while($row=mysqli_fetch_assoc($result))
                {
                    if($row['username']==$_POST['username'])
                    {
                        $count=$count+1;
                    }
                }

                if($count==0)
                    {mysqli_query($db,"INSERT INTO `STUDENT` VALUES('$_POST[firstname]','$_POST[lastname]','$_POST[faculty]','$_POST[semester]','$_POST[LCID]','$_POST[username]','$_POST[password]','$_POST[email]','$_POST[contact]','user1.jpg');");  
        ?>
                <script type="text/javascript">
                    alert("Registration successful.");
                    window.location="../login.php";
                </script>
                <?php
            }

            else
                {
                 ?>
                    <script type="text/javascript">
                        alert("The username already exist.");
                        
                    </script>
        <?php   
                }
            }
       
        ?>
        
        </body>
</html>
