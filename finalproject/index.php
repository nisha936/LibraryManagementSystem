  <?php
    session_start();
  ?> 
    <!DOCTYPE html>
    <html>
        <head>
            <title>Library Management System</title>
            
   <link rel="stylesheet" type="text/css" href="style.css">
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
         <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
       <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


           <style type="text/css">
            body {
                display: block;
                margin: 0px;
                }
               nav
               {
                float: right;
                word-spacing: 30px;
                padding: 20px;
                position: relative;
                bottom: 34px;
                padding-right: 80px;
               }
               nav li
               {
                display: inline-block;
                line-height: 80px;
               }
               nav li a: hover
               {
                color: white;
                text-decoration: none;
               }
               .container-fluid {
                  padding-right: 15px;
                  padding-left: 15px;
                  margin-right: auto;
                  margin-left: auto;
                }
           </style>
        </head>
        <body>
            <div class="wrapper">
                <header>

            <div class="container-fluid">
                    <div class="logo">
                        <img src="images/abc.png" style="margin-top: -5px;">
                        <h3 style="color: white; margin-top: -5px;" href="index.php">LIBRARY MANAGEMENT SYSTEM</h3>
                    </div>
                    <?php
                        if(isset($_SESSION['login_user'])){ 
                          ?>
                           <nav>
                              <ul>
                                  <li><a href="index.php" style="text-decoration: none;">HOME</a></li>
                                  <li><a href="books.php" style="text-decoration: none;">BOOKS</a></li>
                                  <li><a href="logout.php"><i class="fa fa-sign-out">LOGOUT</i></a></li>
                              </ul>
                            </nav> 
                    <?php
                          }
                        else {
                            ?>
                             <nav>
                        
                            <ul>
                                
                                <li><a href="index.php" style="text-decoration: none;">HOME</a></li>
                                <li><a href="books.php" style="text-decoration: none;">BOOKS</a></li>
                                <li><a href="login.php"><i class="fa fa-sign-in">LOGIN</i></a></li>
                                <li><a href="registration.php"><i class="fa fa-user">SIGNUP</i></a></li>
                                                           
                            </ul>
                   
                    </nav>
                    <?php
                        }
                    ?>
</div>
                </header>
                <section style="width: 1370px;">
                     <div class="sec_img">
                        
                   </div>
                </section>
            </div>
            <?php
            include "footer.php";
            ?>
        </body>
    </html>

