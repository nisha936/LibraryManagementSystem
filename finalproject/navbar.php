 <?php
    session_start();
    include "connection.php";
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>

	 <link rel="stylesheet" type="text/css" href="style.css">
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
         <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
       <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


        <style type="text/css">
            .img_circle {
                border-radius:50%; 
            }
        </style>
</head>
<body>
    <header>
	<nav class="navbar navbar-inverse">
            <div class="container-fluid">
                
                <div class="navbar-header">
                
                    <a class="navbar-brand active" style="color: white; " href="index.php">LIBRARY MANAGEMENT SYSTEM</a>
                </div>
                <ul class="nav navbar-nav" style="float: right;">
                    <li><a href="index.php" style="text-decoration: none;">HOME</a></li>
                    <li><a href="books.php" style="text-decoration: none;">BOOKS</a></li>
                    
                    <?php
                    if(isset($_SESSION['login_user']))
                        {?>
                        <li><a href="fine.php" style="text-decoration: none; float: left;">FINE</a></li>
                </ul>
                <?php 
                    } 
                if(isset($_SESSION['login_user']))
                {?>
                    
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="studentprofile.php">
                            <div style="color: black">
                        <?php
                        echo "<img class='img_circle profile_img'
                        height=30 width=30 src='images/".$_SESSION['photo']."'>";
                        echo "  ".$_SESSION['login_user'];
                        ?>
                    </div>
                    </a></li>
                     <li><a href="logout.php"><i class="fa fa-sign-out">LOGOUT</i></a></li>
                     </ul>
                     <?php
                }
                else
                {?>
                     <ul class="nav navbar-nav navbar-right">
                    <li><a href="login.php"><i class="fa fa-sign-in">LOGIN</i></a></li>
                   
                    <li><a href="registration.php"><i class="fa fa-user">SIGN UP</i></a></li>
                    </ul>

                     <?php
                }
                ?>
               
            </div>
        </nav>
        <?php
            if (isset($_SESSION['login_user'])) 
            {
                $day=0;

                $expire='<p style="background-color:red; color:black;">Expired.</p>';
                $result=mysqli_query($db,"SELECT returndate FROM issue_book WHERE username='$_SESSION[login_user]' AND approve_status='$expire' ;");
                while ($row=mysqli_fetch_assoc($result)) 
                {
                    $d=strtotime($row['returndate']);
                    $c=strtotime(date("Y-m-d"));

                    $diff=$c-$d;
                    // echo $diff/(60*60*24); //Days
                    
                    if($diff>=0)
                    {
                      $day= $day+floor($diff/(60*60*24)); 
                    } 
                
                }
              $_SESSION['fine']=$day*10;
            }
        ?>
        </header>
</body>
</html>