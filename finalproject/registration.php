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
         
        <style type="text/css">
            section
            {
              margin-top: 0px;
              height: 550px;
              width: 1350px;
              background-color: black;
              background-image:url("images/x.jpg");
              background-repeat: no-repeat;  
            }    
            .box
            {
                height: 350px;
                width: 450px;
                background-color: black;
                margin: 0px auto;
                opacity: .7;
                color: white;
                padding: 20px;
                padding-top: 120px;
            }
            label
            {
                font-weight: 600;
                font-size: 25px;
            }   
        </style>
    </head>
    <body>
       
        <section>
            <div class="box">
                <form name="signup" action="" method="post">
                    <b> <p style="padding-left: 50px; font-size: 20px; font-weight: 700;">Sign Up as:</p></b>  <br>  


                    <input style="margin-left: 50px; width: 18px;" type="radio" name="user" id="admin" value="admin">
                    <label for="admin">Admin</label> 

                    <input style="margin-left: 50px; width: 18px;" type="radio" name="user" id="student" value="student" checked="">
                    <label for="student">Student</label>&nbsp &nbsp &nbsp
                           
                    <input class="btn-default" type="submit" name="submission" value="OK" style="color: black; width: 60px; height: 30px;border-radius: 5px;">

                </form>   
            </div>
            <?php
            if (isset($_POST['submission'])) 
            {
                if ($_POST['user']=='admin') 
                {
                    ?>

                   <script type="text/javascript">
                            window.location="admin/registration.php"
                        </script> 
                        <?php
                }
                else
                {
                    ?>
                    <script type="text/javascript">
                            window.location="student/registration.php"
                        </script>
                        <?php
                }
            }
            ?>
        </section>
        
    </body>
</html>
