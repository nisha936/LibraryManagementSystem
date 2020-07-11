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
              background-color: black;
              color: white;
              font-family: "Lato", sans-serif;
              transition: background-color .5s;
                background-color: black;
            }
           .form-control 
           {
                display: block;
                width: 75%;
            }
            .search
            {
                padding-left: 850px;
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
          <!--   ----------------        SEARCH BAR----------------- -->
         <div class="container">
          <div class="search"> 
                <form class="navbar-form" method="post"
                name="form1">

                      
                            <input class="form-control"
                            type="text" name="search" placeholder="Search for books here" required="">
                             <button type="submit" name="submit" class="fa fa-search" style="border-radius:5px;">
                             </button>
                </form>
          </div>
<!-- ------------request book------------- -->
 <div class="search"> 
                <form class="navbar-form" method="post"
                name="form1">

                      
                            <input class="form-control"
                            type="text" name="bookid" placeholder="Enter Book ID" required="">
                             <button type="submit" name="submit1" class="btn-default" style="border-radius: 5px;">Request
                             </button>
                </form>
          </div>


       <h2>List Of Books</h2>
       <?php

            if(isset($_POST['submit']))
            {
                $q=mysqli_query($db,"SELECT * FROM books WHERE name like '%$_POST[search]%' ");


                if(mysqli_num_rows($q)==0)
                {
                    echo "No Books Found!";
                }
                else
                {
                        echo "<table class='table table-bordered table-hover'>";
                        echo "<tr style='background-color:#808080'>";
                    
                        echo "<th>"; echo "ID"; echo "</th>";
                        echo "<th>"; echo "Book Name"; echo "</th>";
                        echo "<th>"; echo "Author Name"; echo "</th>";
                        echo "<th>"; echo "Publication"; echo "</th>";
                        echo "<th>"; echo "Status"; echo "</th>";
                        echo "<th>"; echo "Quantity"; echo "</th>";
                        echo "<th>"; echo "Department"; echo "</th>";
                        echo "</tr>";

                    while($row=mysqli_fetch_assoc($q))
                    {
                        echo "<tr>";
                            echo "<td>"; echo $row['bookid']; echo "</td>";
                            echo "<td>"; echo $row['name']; echo "</td>";
                            echo "<td>"; echo $row['authors']; echo "</td>";
                            echo "<td>"; echo $row['publication']; echo "</td>";
                            echo "<td>"; echo $row['status']; echo "</td>";
                            echo "<td>"; echo $row['quantity']; echo "</td>";
                            echo "<td>"; echo $row['department']; echo "</td>";
                        echo "</tr>";
                    }

                     echo "</table>";

                }
            }
            // -----if button not pressed------
            else
            {

            
                $result=mysqli_query($db,"SELECT * FROM `books` ORDER BY `books`.`bookid` ASC;");
                echo "<table class='table table-bordered table-hover'>";
                echo "<tr style='background-color:#808080'>";
                    
                    echo "<th>"; echo "ID"; echo "</th>";
                    echo "<th>"; echo "Book Name"; echo "</th>";
                    echo "<th>"; echo "Author Name"; echo "</th>";
                    echo "<th>"; echo "Publication"; echo "</th>";
                    echo "<th>"; echo "Status"; echo "</th>";
                    echo "<th>"; echo "Quantity"; echo "</th>";
                    echo "<th>"; echo "Department"; echo "</th>";
                echo "</tr>";

                while($row=mysqli_fetch_assoc($result))
                {
                    echo "<tr>";
                        echo "<td>"; echo $row['bookid']; echo "</td>";
                        echo "<td>"; echo $row['name']; echo "</td>";
                        echo "<td>"; echo $row['authors']; echo "</td>";
                        echo "<td>"; echo $row['publication']; echo "</td>";
                        echo "<td>"; echo $row['status']; echo "</td>";
                        echo "<td>"; echo $row['quantity']; echo "</td>";
                        echo "<td>"; echo $row['department']; echo "</td>";

                    echo "</tr>";
                }

                echo "</table>";
            }

            if (isset($_POST['submit1']))
            {
                if (isset($_SESSION['login_user']))
                {
                  $sql1=mysqli_query($db, "SELECT * FROM books WHERE bookid='$_POST[bookid]';");
                  $row1=mysqli_fetch_assoc($sql1);
                  $count1=mysqli_num_rows($sql1);
                  if ($count1!=0) 
                  {
                    mysqli_query($db,"INSERT INTO issue_book VALUES ('$_SESSION[login_user]','$_POST[bookid]','','','');");
                    ?>
                    <script type="text/javascript">
                        window.location="bookrequest.php"
                    </script>
                    <?php
                  }
                  else
                  {
                    ?>
                     <script type="text/javascript">
                        alert("Book Unavailable!");
                    </script>
                    <?php
                  }

                }
                else
                {
                    ?>
                    <script type="text/javascript">
                        alert("You need to log in first to request any book!");
                    </script>
                    <?php
                }
            }

            ?>
            </div>
    </body>
</html>
