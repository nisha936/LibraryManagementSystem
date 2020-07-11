<?php
include "navbar.php";
include "connection.php";
?>
<!DOCTYPE html>
<html>
<head>
	<title>Approve Request</title>
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
            .Approve
            {
              margin-left: 250px;
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
              
              <h3 style="text-align: center;">Approve Request</h3><br>  
              
              <form class="Approve" action="" method="post">
               
                <input class="form-control" type="text" name="approve_status" placeholder="Approve Status:Yes or No" required=""><br>
               
                <input class="form-control" type="text" name="issuedate" placeholder=" Issue Date YYYY-mm-dd" required=""><br>
               
                <input class="form-control" type="text" name="returndate" placeholder="Return Date YYYY-mm-dd" required=""><br>

                <input class="btn-default" type="submit" name="submit" value="Approve" style="color: black; width: 80px; height: 30px;border-radius: 5px;"><br>
              </form>
            </div>
          </div>
          <?php
          if (isset($_POST['submit']))
          {
            mysqli_query($db,"UPDATE `issue_book` SET `approve_status`='$_POST[approve_status]',`issuedate`='$_POST[issuedate]',`returndate` ='$_POST[returndate]' WHERE username ='$_SESSION[studentname]' AND bookid ='$_SESSION[bookid]';");

            mysqli_query($db,"UPDATE books SET quantity=quantity-1 WHERE bookid='$_SESSION[bookid]';");

            $result=mysqli_query($db,"SELECT quantity FROM books WHERE bookid='$_SESSION[bookid]' ;");

              while ($row=mysqli_fetch_assoc($result))
              {
                  if ($row['quantity']==0) {
                    mysqli_query($db,"UPDATE books SET status='not available' WHERE bookid='$_SESSION[bookid]';");
                  }
              }
              ?>
              <script type="text/javascript">
                alert("Updated Successfully.");
                window.location="bookrequest.php"
              </script>
              <?php
            }
          ?>
  </body>
</html>
