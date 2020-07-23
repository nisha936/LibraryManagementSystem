<?php
include "navbar.php";
include "connection.php";
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
               /* background-image: url("images/s.jpg");
                background-repeat: no-repeat;*/
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
            body {
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
              padding-left: 16px;
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
            .container
            {
              height: 800px;
              width: 85%;
              background-color: white;
              color: black;
              opacity: .7;
              padding-top: 10px;
              margin: 0px auto;
              margin-top: -44px;
            }
            .scroll
            {
              width: 100%;
              height: 500px;
              overflow:auto;
            }
            th,td
            {
             width: 11%; 
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
             
              <?php
              if (isset($_SESSION['login_user']))
              {
                ?>
                <div style="float: left;padding: 15px">
                   <form method="post" action="">
                    
                    <button  name="submit2" type="submit" class="btn-default" style="border-radius: 5px;background-color: green;color: white;">Returned</button> &nbsp &nbsp &nbsp
                    
                    <button name="submit3" type="submit" class="btn-default" style="border-radius: 5px; background-color: red;color: white;">Expired</button>
                    </form>
                </div>

                <div class="search">
                
                  <form method="post" action="" name="form1">
                    <input type="text" name="username" class="form-control" placeholder="Username" required=""><br>
                    <input type="text" name="bookid" class="form-control" placeholder="Book ID" required="">
                    <br>
                    <input class="btn-default" type="submit" name="submit" value="Submit" style="color: black; width: 80px; height: 30px;border-radius: 5px;"><br>

                  </form>
                
                </div>
                <?php

                if (isset($_POST['submit'])) 
                {
                  $result=mysqli_query($db,"SELECT * FROM `issue_book` WHERE username='$_POST[username]' AND bookid='$_POST[bookid]' ;");
                  while ($row=mysqli_fetch_assoc($result)) 
                  {
                    $d=strtotime($row['returndate']);
                    $c=strtotime(date("Y-m-d"));
                    $diff= $c-$d;

                     if ($diff>=0) 
                     {
                       $day=floor($diff/(60*60*24)); 
                       $fine=$day*10;
                     }
                  }

                  $x=date("Y-m-d");
                  $d=mysqli_query($db,"INSERT INTO `fine` VALUES ('$_POST[username]','$_POST[bookid]','$x','$day','$fine','not paid'); ");


                   $variable1='<p style="background-color:green; color:black;">Returned.</p>';

                   mysqli_query($db,"UPDATE issue_book SET approve_status='$variable1' WHERE username='$_POST[username]' AND bookid='$_POST[bookid]'");

                   mysqli_query($db,"UPDATE books SET quantity=quantity+1 WHERE bookid='$_POST[bookid]';");
                }
              }
              ?>
             <!--  <h2 style="text-align: center;">Return Date Expired List</h2> --><br>
              <?php
                $count=0;

                if (isset($_SESSION['login_user'])) 
                {
                  $return='<p style="background-color:green; color:black;">Returned.</p>';
                  $expire='<p style="background-color:red; color:black;">Expired.</p>';

                  if (isset($_POST['submit2'])) 
                  {
                    $sql= "SELECT student.username,LCID,books.bookid,name,authors,publication,approve_status,issuedate,returndate FROM student INNER JOIN issue_book ON student.username=issue_book.username INNER JOIN books ON issue_book.bookid=books.bookid WHERE issue_book.approve_status='$return' ORDER BY `issue_book`.`returndate` DESC";

                    $result=mysqli_query($db,$sql);
                  }
                  elseif (isset($_POST['submit3'])) 
                  {
                    $sql= "SELECT student.username,LCID,books.bookid,name,authors,publication,approve_status,issuedate,returndate FROM student INNER JOIN issue_book ON student.username=issue_book.username INNER JOIN books ON issue_book.bookid=books.bookid WHERE issue_book.approve_status='$expire' ORDER BY `issue_book`.`returndate` DESC";

                    $result=mysqli_query($db,$sql);
                  }
                   else
                   {
                    $sql= "SELECT student.username,LCID,books.bookid,name,authors,publication,approve_status,issuedate,returndate FROM student INNER JOIN issue_book ON student.username=issue_book.username INNER JOIN books ON issue_book.bookid=books.bookid WHERE issue_book.approve_status !='' AND issue_book.approve_status !='Yes' ORDER BY `issue_book`.`returndate` DESC";

                    $result=mysqli_query($db,$sql);

                   }
                   

                   echo "<table class='table table-bordered' style='width:99.5%'>";

                    echo "<tr style='background-color:#808080'>";
                    
                    echo "<th>"; echo "Username"; echo "</th>";
                    echo "<th>"; echo "LCID"; echo "</th>";
                    echo "<th>"; echo "Book ID"; echo "</th>";
                    echo "<th>"; echo "Book Name"; echo "</th>";
                    echo "<th>"; echo "Authors Name"; echo "</th>";
                    echo "<th>"; echo "Publication"; echo "</th>";
                    echo "<th>"; echo "Approve Status"; echo "</th>";
                    echo "<th>"; echo "Issue Date"; echo "</th>";
                    echo "<th>"; echo "Return Date"; echo "</th>";
                    
                    echo "</tr>";

                    echo "</table>";

                    echo "<div class='scroll'>";
                    
                    echo "<table class='table table-bordered'>";


                    while($row=mysqli_fetch_assoc($result))
                    {
                      echo "<tr>";
                      echo "<td>"; echo $row['username']; echo "</td>";
                      echo "<td>"; echo $row['LCID']; echo "</td>";
                      echo "<td>"; echo $row['bookid']; echo "</td>";
                      echo "<td>"; echo $row['name']; echo "</td>";
                      echo "<td>"; echo $row['authors']; echo "</td>";
                      echo "<td>"; echo $row['publication']; echo "</td>";
                      echo "<td>"; echo $row['approve_status']; echo "</td>";
                      echo "<td>"; echo $row['issuedate']; echo "</td>";
                      echo "<td>"; echo $row['returndate']; echo "</td>";

                      echo "</tr>";
                    }
                    echo "</table>";

                    echo "</div>";

                     
                }
                else
                {
                  ?>
                  <h3 style="text-align: center;">You need to log in first!</h3>
                  <?php
                }

              ?>
            </div>
      </div>
  </body>
</html>
