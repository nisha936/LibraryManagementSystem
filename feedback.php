<?php
include "navbar.php";
include "connection.php";
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Feedback Admin</title>
        <link rel="stylesheet" type="text/css" href="style.css">
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

       <style type="text/css">
          body
           {
            width: 1350px;
            background-color: black;
            /*background-image: url("images/13.jpg");*/
           }
           .feedback
           {
            width: 800px;
            height: 550px;
            background-color: black;
            opacity: .6;
            color: white;
            padding-top: 10px;
            margin: 0px auto;
           }
           .form-control
           {
            padding-right: 10px;
            height: 90px;
            width: 90%;
           }
           .scroll
           {
            width: 98%;
            height: 300px;
            overflow: auto;
           }
           .table
           {
            color: white;
           }
       </style>
       
    </head>
    <body style="width: 1350px;">
        <div class="feedback">
            <h4>If you have any suggestions or questions please comment below</h4><br>
            
            <form style="" action="" method="post">
                <input  class="form-control" type="text" name="comment" placeholder="Write something..."> <br> 
                <input class="btn-default" type="submit" name="submit" value="Comment" style="color: black; width: 100px; height: 35px;border-radius: 5px;">
                
            </form>
            <br>
        
        <div class="scroll">
            <?php
                if(isset($_POST['submit']))
                {
                    $sql="INSERT INTO `comments` VALUES('','ADMIN','$_POST[comment]')";
                   if(mysqli_query($db,$sql))
                    {
                       $sql="SELECT * FROM `comments` ORDER BY `comment` , `id` DESC";
                       $result=mysqli_query($db,$sql);

                       echo "<table class='table table-bordered'>";
                       while ($row=mysqli_fetch_assoc($result))
                        {
                           echo "<tr>";
                           echo "<td>";echo $row['username']; echo "</td>";
                            echo "<td>";echo $row['comment']; echo "</td>";
                           echo "</tr>";
                        }

                    }
                }

                else 
                {
                    $sql="SELECT * FROM `comments` ORDER BY `comment` , `id` DESC";
                       $result=mysqli_query($db,$sql);

                       echo "<table class='table-bordered'>";
                       while ($row=mysqli_fetch_assoc($result))
                        {
                           echo "<tr>";
                           echo "<td>";echo $row['username']; echo "</td>";
                            echo "<td>";echo $row['comment']; echo "</td>";
                           echo "</tr>";
                        }

                }
            ?>
        </div>

        </div>
        </body>
</html>
