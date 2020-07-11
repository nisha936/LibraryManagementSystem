<?php
include "navbar.php";
include "connection.php";
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Student Information</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <style type="text/css">
           .form-control 
           {
                display: block;
                width: 75%;
            }
            .search
            {
                padding-left: 885px;
            }
            .img_circle {
                border-radius:50%; 
                margin-left:20px;
            }
            body {
              font-family: "Lato", sans-serif;
              transition: background-color .5s;
              width: 1350px;
                background-color: black;
                color: white;
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
            .container
            {
              height: 600px;
              background-color: white;
              color: black;
              opacity: .7;
              padding-top: 10px;
              margin: 0px auto;
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
          <!--   ----------------        SEARCH BAR----------------- -->
          <div class="container">

          <div class="search"> 
                <form class="navbar-form" method="post"
                name="form1">

                      
                            <input class="form-control"
                            type="text" name="search" placeholder="Student's username " required="">
                             <button type="submit" name="submit" class="fa fa-search">
                             </button>
                </form>
          </div>

       <h2>Students Details</h2>
       <?php

            if(isset($_POST['submit']))
            {
                $q=mysqli_query($db,"SELECT firstname,lastname,faculty,semester,LCID,username,email,contact FROM `student` WHERE username like '%$_POST[search]%' ");

                if(mysqli_num_rows($q)==0)
                {
                    echo "No Student Found!";
                }
                else
                {
                        echo "<table class='table table-bordered table-hover'>";
                        echo "<tr style='background-color:#808080'>";
                    
                        echo "<th>"; echo "First Name"; echo "</th>";
                        echo "<th>"; echo "Last Name"; echo "</th>";
                        echo "<th>"; echo "Faculty"; echo "</th>";
                        echo "<th>"; echo "Semester"; echo "</th>";
                        echo "<th>"; echo "LCID"; echo "</th>";
                        echo "<th>"; echo "Username"; echo "</th>";
                        echo "<th>"; echo "Email"; echo "</th>";
                        echo "<th>"; echo "Contact Number"; echo "</th>";
                        echo "</tr>";

                    while($row=mysqli_fetch_assoc($q))
                    {
                        echo "<tr>";
                            
                            echo "<td>"; echo $row['firstname']; echo "</td>";
                            echo "<td>"; echo $row['lastname']; echo "</td>";
                            echo "<td>"; echo $row['faculty']; echo "</td>";
                            echo "<td>"; echo $row['semester']; echo "</td>";
                            echo "<td>"; echo $row['LCID']; echo "</td>";
                            echo "<td>"; echo $row['username']; echo "</td>";
                            echo "<td>"; echo $row['email']; echo "</td>";
                            echo "<td>"; echo $row['contact']; echo "</td>";

                        echo "</tr>";
                    }

                     echo "</table>";

                }
            }
            // -----if button not pressed------
            else
            {

            
                $result=mysqli_query($db,"SELECT firstname,lastname,faculty,semester,LCID,username,email,contact FROM `student` ORDER BY `student`.`firstname` ASC;");
                echo "<table class='table table-bordered table-hover'>";
                echo "<tr style='background-color:#808080'>";
                    
                  echo "<th>"; echo "First Name"; echo "</th>";
                   echo "<th>"; echo "Last Name"; echo "</th>";
                   echo "<th>"; echo "Faculty"; echo "</th>";
                   echo "<th>"; echo "Semester"; echo "</th>";
                   echo "<th>"; echo "LCID"; echo "</th>";
                   echo "<th>"; echo "Username"; echo "</th>";
                   echo "<th>"; echo "Email"; echo "</th>";
                   echo "<th>"; echo "Contact Number"; echo "</th>";
                  
                echo "</tr>";

                while($row=mysqli_fetch_assoc($result))
                {
                    echo "<tr>";
                        echo "<td>"; echo $row['firstname']; echo "</td>";
                            echo "<td>"; echo $row['lastname']; echo "</td>";
                            echo "<td>"; echo $row['faculty']; echo "</td>";
                            echo "<td>"; echo $row['semester']; echo "</td>";
                            echo "<td>"; echo $row['LCID']; echo "</td>";
                            echo "<td>"; echo $row['username']; echo "</td>";
                            echo "<td>"; echo $row['email']; echo "</td>";
                            echo "<td>"; echo $row['contact']; echo "</td>";


                    echo "</tr>";
                }

                echo "</table>";
            }
              ;  ?>
            </div>
    </body>
</html>
