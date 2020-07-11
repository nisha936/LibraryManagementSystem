<?php
include "connection.php";
include "navbar.php";
?>
<!DOCTYPE html>
<html>
<head>
	<title>Book Request</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">

       <style type="text/css">
            body
            {
                width: 1350px;
                background-color: black;
                color: white;
                font-family: "Lato", sans-serif;
              transition: background-color .5s;
               /* background-image: url("images/s.jpg");
                background-repeat: no-repeat;*/
            }
             .container
            {
              height: 600px;
              background-color: white;
              color: black;
              opacity: .7;
              padding-top: 10px;
              margin: 0px auto;
            }
           .form-control 
           {
                display: block;
                width: 75%;
                height: 40px;
                background-color:black; 
                color: white;
            }
            .search
            {
                padding-left: 900px;
            }

            .img_circle {
                border-radius:50%; 
                margin-left:20px;
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
           


       </style>
</head>
<body>
	<!-- ------side nav------- -->
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

            <div class="myprofile"><a href="books.php">Books</a></div>
            <div class="myprofile"><a href="bookrequest.php">Book Request</a></div>
            <div class="myprofile"><a href="issueinformation.php">Issue Information</a></div>
            <div class="myprofile"><a href=expired.php>Expired List</a></div>
            </div>

            <div id="main">
              
              <span style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776;</span>
            

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

            <div class="container">
              <div class="search">
                <form method="post" action="" name="form1">
                  <input type="text" name="username" class="form-control" placeholder="Username" required=""><br>
                  <input type="text" name="bookid" class="form-control" placeholder="Book ID" required="">
                  <br>
                  <input class="btn-default" type="submit" name="submit" value="Submit" style="color: black; width: 80px; height: 30px;border-radius: 5px;"><br>

                </form>
                
              </div>
              <h3 style="text-align: center;"><b>Book Request</b></h3>
            <?php

              if(isset($_SESSION['login_user']))
              {
                $sql="SELECT student.username,LCID,books.bookid,name,authors,publication,status FROM student INNER join issue_book ON student.username=issue_book.username INNER JOIN books ON issue_book.bookid=books.bookid WHERE issue_book.approve_status = '' ";
                $result=mysqli_query($db,$sql);

                   if(mysqli_num_rows($result)==0)
                    {
                      echo "<h2><b>No Book Request!</b></h2>";
                    }
                  else
                  {
                    echo "<table class='table table-bordered'>";
                    echo "<tr style='background-color:#808080'>";
                    
                    echo "<th>"; echo "Student Username"; echo "</th>";
                    echo "<th>"; echo "LCID"; echo "</th>";
                    echo "<th>"; echo "Book ID"; echo "</th>";
                    echo "<th>"; echo "Book Name"; echo "</th>";
                    echo "<th>"; echo "Authors Name"; echo "</th>";
                    echo "<th>"; echo "Publication"; echo "</th>";
                    echo "<th>"; echo "Status"; echo "</th>";
                    echo "</tr>";

                    while($row=mysqli_fetch_assoc($result))
                    {
                      echo "<tr>";
                      echo "<td>"; echo $row['username']; echo "</td>";
                      echo "<td>"; echo $row['LCID']; echo "</td>";
                      echo "<td>"; echo $row['bookid']; echo "</td>";
                      echo "<td>"; echo $row['name']; echo "</td>";
                      echo "<td>"; echo $row['authors']; echo "</td>";
                      echo "<td>"; echo $row['publication']; echo "</td>";
                      echo "<td>"; echo $row['status']; echo "</td>";

                      echo "</tr>";
                    }

                     echo "</table>";
                    }
              }
              else
              {
                ?>
                <br>
                <h4 style="text-align: center; color:red;">You need to log in first!</h4>
                <?php
              }

              if (isset($_POST['submit'])) 
              {
                 $_SESSION['studentname']=$_POST['username'];
                 $_SESSION['bookid']=$_POST['bookid'];
                
                ?>
                  <script type="text/javascript">
                    window.location="approverequest.php"
                  </script>

                 <?php
              }
                ?>
        </div>
    </body>
</html>