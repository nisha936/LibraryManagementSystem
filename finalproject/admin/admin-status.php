<?php
include "connection.php";
include "navbar.php";
?>

<!DOCTYPE html>
<html>
<head>
	<title>Approve Request</title>
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
          	<h3 style="float: left;">Search for one request at a time to approve or reject it.</h3>
          <div class="search"> 
                <form class="navbar-form" method="post"
                name="form1">

                      
                            <input class="form-control"
                            type="text" name="search" placeholder="username " required="">
                             <button type="submit" name="submit" class="fa fa-search">
                             </button>
                </form>
          </div>

       <h2>Approve Requests for Admin</h2>
       <?php

            if(isset($_POST['submit']))
            {
                $q=mysqli_query($db,"SELECT firstname ,lastname,username ,email ,contact FROM `admin` WHERE username like '%$_POST[search]%' AND `status`='' ");

                if(mysqli_num_rows($q)==0)
                {
                    echo "No approval request with that username found!";
                }
                else
                {
                        echo "<table class='table table-bordered table-hover'>";
                        echo "<tr style='background-color:#808080'>";
                    
                        echo "<th>"; echo "First Name"; echo "</th>";
                        echo "<th>"; echo "Last Name"; echo "</th>";
                        echo "<th>"; echo "Username"; echo "</th>";
                        echo "<th>"; echo "Email"; echo "</th>";
                        echo "<th>"; echo "Contact Number"; echo "</th>";
                        echo "</tr>";

                    while($row=mysqli_fetch_assoc($q))
                    {
                    	$_SESSION['test_name']=$row['username'];

                        echo "<tr>";
                            
                            echo "<td>"; echo $row['firstname']; echo "</td>";
                            echo "<td>"; echo $row['lastname']; echo "</td>";
                            echo "<td>"; echo $row['username']; echo "</td>";
                            echo "<td>"; echo $row['email']; echo "</td>";
                            echo "<td>"; echo $row['contact']; echo "</td>";

                        echo "</tr>";
                    }

                     echo "</table>";
                     ?>
                     <form action="" method="post">
	                     <button type="submit" name="acceptSubmit" style="background-color: black;color: white; font-weight: 700;" class="btn btn-default"><span style="color: green;" 
	                    class="glyphicon glyphicon-ok-sign"></span>&nbsp&nbspAccept</button>

	                     <button type="submit" name="rejectSubmit" style="background-color: black;color: white;font-weight: 700;" class="btn btn-default"><span style="color: red;" 
	                    class="glyphicon glyphicon-remove-sign"></span>&nbsp&nbspReject</button>
                    </form>
                     <?php
                    
                      }
            }
            // -----if button not pressed------
            else
            {

            
                $result=mysqli_query($db,"SELECT firstname ,lastname ,username ,email ,contact FROM `admin` WHERE `status`='' ORDER BY `admin`.`firstname` ASC;");
                echo "<table class='table table-bordered table-hover'>";
                echo "<tr style='background-color:#808080'>";
                    
                  echo "<th>"; echo "First Name"; echo "</th>";
                   echo "<th>"; echo "Last Name"; echo "</th>";
                   echo "<th>"; echo "Username"; echo "</th>";
                   echo "<th>"; echo "Email"; echo "</th>";
                   echo "<th>"; echo "Contact Number"; echo "</th>";
                  
                echo "</tr>";

                while($row=mysqli_fetch_assoc($result))
                {
                    echo "<tr>";
                        echo "<td>"; echo $row['firstname']; echo "</td>";
                            echo "<td>"; echo $row['lastname']; echo "</td>";
                            echo "<td>"; echo $row['username']; echo "</td>";
                            echo "<td>"; echo $row['email']; echo "</td>";
                            echo "<td>"; echo $row['contact']; echo "</td>";


                    echo "</tr>";
                }

                echo "</table>";
            }
             if (isset($_POST['acceptSubmit'])) 
                     {
                     	mysqli_query($db,"UPDATE admin SET status='Yes' WHERE username='$_SESSION[test_name]';");
                     	unset($_SESSION['test_name']);
                     }
                     if (isset($_POST['rejectSubmit'])) 
                     {
                     	mysqli_query($db,"DELETE FROM admin WHERE username='$_SESSION[test_name]' and status='';");
                     	unset($_SESSION['test_name']);
                     }
               ?>
            </div>
    </body>
</html>
