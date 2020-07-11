<?php
include "connection.php";
include "navbar.php";
?>
<!DOCTYPE html>
<html>
<head>
	<title>Message</title>
	 <meta charset="utf-8">
     <meta name="viewport" content="width=device-width, initial-scale=1">
     <style type="text/css">
     	.left_box
     	{
     		height: 600px;
     		width: 500px;
     		float: left;
     		background-color: black;
     		margin-top: 0px;

     	}
     	.left_box2
     	{
     		height: 600px;
     		width: 300px;
     		background-color: white;
     		border-radius: 20px;
     		float: right;
     		margin-right: 30px;
     		color: black;
     	}
     	.left_box input
     	{
     		width: 150px;
     		height: 50px;
     		background-color: white;
     		padding: 10px;
     		margin: 10px;
     		border-radius:10px;

     	}
     	.list
     	{
     		height:500px;
     		width: 300px;
     		background-color: white;
     		float: right;
     		color: black;
     		padding: 10px;
     		overflow-y: scroll;
     		overflow-x: hidden;

     	}
     	.right_box
     	{
     		height: 600px;
     		width: 1000px;
     		background-color: black;
     		margin-top: 0px;
     		padding: 10px;
     		margin-left: 350px;
     	}
     	.right_box2
     	{
     		height: 600px;
     		width: 660px;
     		background-color: white;
     		margin-top: -10px;
     		padding: 20px;
     		border-radius: 20px;
     		float: left;
     		color: black;
     	}
     	tr:hover
     	{
     		background-color: grey;
     		cursor: pointer;
     	}
     	.form-control
     	{
     		height: 45px;
     		width: 80%;

     	}
     	.btn-info 
     	{
			color: #fff;
			background-color: #595959;
		    border-color: black;
		}
		.msg
		{
			height: 400px;
			overflow-y: scroll;
			margin-top: 10px;
		}
		.chat
		{
			display: flex;
			flex-flow: row wrap;
		}
		.user .chatbox
		{
			height: 42px;
			width: 500px;
			padding: 13px 10px;
			background-color: #3c3636c4;
			color: white;
			border-radius: 8px;
			
		}
		.admin .chatbox
		{
			height: 42px;
			width: 500px;
			padding: 13px 10px;
			background-color: black;
			color: white;
			border-radius: 8px;
			order: -1;
			
		}

     </style>
</head>
<body style=" width:1350px; height: 650px;background-color: black;">
	<?php 
	$sql1= mysqli_query($db,"SELECT student.photo,message.username FROM student INNER JOIN message ON student.username= message.username GROUP BY username ORDER BY seen;");
	 ?>
	<!-- --------------------left box------------------------- -->
	<div class="left_box">
		<div class="left_box2">
			<div>
				<form method="post" action="" enctype="multipart/form-data">
					<input type="text" name="username" id="uname" style="color: black;">
					<button type="submit" name="submit" class="btn btn-default">Show
					</button>
				</form>
				
			</div>
			<div class="list">
				<?php
        echo "<table id='table' class='table' >";
        while ($result1=mysqli_fetch_assoc($sql1)) 
        {
        	$_SESSION['test_photo']=$result1['photo'];
          echo "<tr>";
            echo "<td width=65>"; echo "<img class='img-circle profile_img' height=60 width=60 src='images/".$result1['photo']."'>";  echo "</td>";


				echo "<td style='padding-top:30px;'>";echo $result1['username'];echo "</td>";
							echo "</tr>";
						}
					echo "</table>";
				?>
			</div>
		</div>
		
	</div>
	<!-- --------------------right box------------------------- -->
	<div class="right_box">
		<div class="right_box2">
			<br>
			<?php 
			// ----------------If submit is pressed------------------------
				if (isset($_POST['submit'])) 
				{
					$result= mysqli_query($db,"SELECT * FROM message WHERE username='$_POST[username]';");

						mysqli_query($db,"UPDATE message SET seen='yes' WHERE sender='student' AND username='$_POST[username]';");

					if ($_POST['username']!= '') 
					{
						$_SESSION['username']=$_POST['username'];
					}
					?>
					<div style="height:70px;width: 100%;text-align: center;color: black; ">
						<h3 style="margin-top: -5px; padding-top: 10px;"><?php echo $_SESSION['username']; ?></h3>
					</div>
<!-- -------------------SHOW MESSAGE------------------------------ -->
					<div class="msg">
				<?php
					while ($row=mysqli_fetch_assoc($result))
					{
						if($row['sender']=='student')
						{
				?>

<!-- ---------------Student--------------- -->
				<br><div class="chat user">
					<div style="float: left;padding-top: 5px;">&nbsp
						  <?php
                       echo "<img class='img-circle profile_img' height=40 width=40 src='images/".$_SESSION['test_photo']."'>";
                        ?>&nbsp
					</div>
					<div style="float: left;" class="chatbox">
						<?php

							echo $row['message'];
						?>
					</div>
				</div>
				
				<?php
			}
			else
			{
			?>
<!-- ---------------Admin----------------- -->
				<br><div class="chat admin">
					<div style="float: left;padding-top: 5px;">&nbsp

						 <?php
                        echo "<img class='img_circle profile_img'
                        height=40 width=40 src='images/".$_SESSION['photo']."'>";
                        ?>
						 &nbsp
					</div>
					<div style="float: left;" class="chatbox">
						<?php

							echo $row['message'];
						?>
					</div>
				</div>
				<?php
			}
		}

				?>
		</div>

					<div style="height: 50px; padding-top: 10px;">
					<form action="" method="post">
							<input type="text" name="message" class="form-control" required="" placeholder="Write Your message here.." style="float: left;">&nbsp &nbsp
							
							<button class="btn btn-info btn-lg" type="submit" name="submit2"><span class=" glyphicon glyphicon-send"></span>&nbspSend</button>
					</form>
			</div>	
					<?php
				}
				// -----------------------if submit not pressed---------------
				else
				{
					if(!isset($_SESSION['username']))
				      {
				        ?>
				          <img style="margin: 190px 176px; border-radius: 50%;" src="images/tenor.gif" alt="animated">
				        <?php
				      }
				      else
				      {
				      	if (isset($_POST['submit2'])) 
				      	{
				      		mysqli_query($db,"INSERT INTO message VALUES ('', '$_SESSION[username]','$_POST[message]','no','admin');");

				      		$result= mysqli_query($db,"SELECT * FROM message WHERE username='$_SESSION[username]';");
				      	}
				      	else
				      	{
				      		$result= mysqli_query($db,"SELECT * FROM message WHERE username='$_SESSION[username]';");
				      	}
				      	?>
				      	<div style="height: 70px; width: 100%; text-align: center;color: black;">
				      		<h3 style="margin-top: -5px; padding-top: 10px;"> <?php echo $_SESSION['username']; ?></h3>
				      		
				      	</div>

				      	<div class="msg">
				<?php
					while ($row=mysqli_fetch_assoc($result))
					{
						if($row['sender']=='student')
						{
				?>

<!-- ---------------Student--------------- -->
				<br><div class="chat user">
					<div style="float: left;padding-top: 5px;">&nbsp

						  <?php
                        echo "<img class='img-circle profile_img' height=40 width=40 src='images/".$_SESSION['test_photo']."'>";
                        ?>
						 &nbsp
					</div>
					<div style="float: left;" class="chatbox">
						<?php

							echo $row['message'];
						?>
					</div>
				</div>
				
				<?php
			}
			else
			{
			?>
<!-- ---------------Admin----------------- -->
				<br><div class="chat admin">
					<div style="float: left;padding-top: 5px;">&nbsp
						 <?php
                        echo "<img class='img_circle profile_img'
                        height=40 width=40 src='images/".$_SESSION['photo']."'>";
                        ?>
						 &nbsp
					</div>
					<div style="float: left;" class="chatbox">
						<?php

							echo $row['message'];
						?>
					</div>
				</div>
				<?php
			}
		}

				?>
		</div>
		<div style="height: 50px; padding-top: 10px;">
					<form action="" method="post">
							<input type="text" name="message" class="form-control" required="" placeholder="Write Your message here.." style="float: left;">&nbsp &nbsp
							
							<button class="btn btn-info btn-lg" type="submit" name="submit2"><span class=" glyphicon glyphicon-send"></span>&nbspSend</button>
					</form>
			</div>
				      	<?php
				      	
				      }

				}
		 	?>
		</div>
	</div>
	<script>
	  var table = document.getElementById('table'),eIndex;
	  for(var i=0; i< table.rows.length; i++)
	  {
	    table.rows[i].onclick =function()
	    {
	      rIndex = this.rowIndex;
	      document.getElementById("uname").value = this.cells[1].innerHTML;
	    }
	  }
	</script>
</body>
</html>