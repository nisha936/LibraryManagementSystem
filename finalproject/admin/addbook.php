<?php
include "navbar.php";
include "connection.php";
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Books</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
       
       <style type="text/css">
            body
            {
                width: 1350px;
            }
           

           .form-control 
           {
                display: block;
                width: 100%;
                color: black;
            }
            .search
            {
                padding-left: 1000px;
            }
            .img_circle {
                border-radius:50%; 
                margin-left:20px;
            }
            body {
              background-color: black;
              font-family: "Lato", sans-serif;
              transition: background-color .5s;
            }

            .sidenav {
              height: 100%;
              margin-top:80px; 
              width: 0;
              position: fixed;
              z-index: 1;
              top: 0;
              left: 0;  
              background-color:#464444;
              overflow-x: hidden;
              transition: 0.5s;
              padding-top: 60px;
            }

            .sidenav a {
              padding: 8px 8px 8px 32px;
              text-decoration: none;
              font-size: 25px;
              color: #818181;
              display: block;
              transition: 0.3s;
            }

            .sidenav a:hover {
              color: #f1f1f1;
            }

            .sidenav .closebtn {
              position: absolute;
              top: 0;
              right: 25px;
              font-size: 36px;
              margin-left: 50px;
            }

            #main {
              transition: margin-left .5s;
              padding: 16px;
            }

            @media screen and (max-height: 450px) {
              .sidenav {padding-top: 15px;}
              .sidenav a {font-size: 18px;}
            }
            .myprofile:hover
            {
                color: white;
                width: 250px;
                height: 50px;
                background-color:black;
            }
            .addbook
            {
              width: 400px;
              margin: 0 auto;

            }

       </style>
    </head>
    <body >
        <!-- ---------side nav------------ -->
                    <div id="mySidenav" class="sidenav">
              <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>

                    <div style="color: white; margin-left:40px;font-size: 20px;  ">
                        <?php
                        if(isset($_SESSION['login_user']))
                        {
                            echo "<img class='img_circle profile_img '
                            height=120 width=130 src='images/".$_SESSION['photo']."'>";
                            echo "<br>";
                            echo "Welcome ".$_SESSION['login_user'];
                        }
                        ?>
                    </div>

            <div class="myprofile"><a href="addbook.php">Add Books</a></div>
            <div class="myprofile"><a href="deletebook.php">Delete Books</a></div>
            <div class="myprofile"><a href="bookrequest.php">Book Request</a></div>
            <div class="myprofile"><a href="issueinformation.php">Issue Information</a></div>
            <div class="myprofile"><a href=expired.php>Expired List</a></div>
            </div>

            <div id="main">
              
              <span style="font-size:30px;cursor:pointer;color:white;" onclick="openNav()">&#9776;</span>
            <div class="container">
              <h2 style="color:white; text-align: center;"><b>Add New Books</b></h2><br>
              <form class="addbook" action="" method="post">
                <input type="text" name="bookid" class="form-control" placeholder="Book Id" required=""><br>
                <input type="text" name="name" class="form-control" placeholder="Book's Name" required=""><br>
                <input type="text" name="authors" class="form-control" placeholder="Author's Name" required=""><br>
                <input type="text" name="publication" class="form-control" placeholder="Publication" required=""><br>
                <input type="text" name="status" class="form-control" placeholder="Status" required=""><br>
                <input type="text" name="quantity" class="form-control" placeholder="Quantity" required=""><br>
                <input type="text" name="department" class="form-control" placeholder="Department" required=""><br>
                <input class="btn-default" type="submit" name="submit" value="ADD" style="color: black; width: 80px; height: 30px; border-radius: 5px;">
              </form>
            </div>
            <?php
            if (isset($_POST['submit'])) 
            {
              if (isset($_SESSION['login_user']))
              {
                mysqli_query($db,"INSERT INTO books VALUES('$_POST[bookid]','$_POST[name]','$_POST[authors]','$_POST[publication]','$_POST[status]','$_POST[quantity]','$_POST[department]');");
                ?>
                <script type="text/javascript">
                  alert("Book Added Successfully.");
                </script>
                <?php
              }
              else
              {
                ?>
                <script type="text/javascript">
                  alert("You need to log in first!");
                </script>
                <?php
              }
            }
            ?>
            </div>
            <script>
            function openNav() {
              document.getElementById("mySidenav").style.width = "250px";
              document.getElementById("main").style.marginLeft = "250px";
              document.body.style.backgroundColor = "rgba(0,0,0,0.4)";
            }

            function closeNav() {
              document.getElementById("mySidenav").style.width = "0";
              document.getElementById("main").style.marginLeft= "0";
              document.body.style.backgroundColor = "white";
            }
            </script>
  
</body>
</html>