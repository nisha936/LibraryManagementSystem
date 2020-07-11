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
     	body
     	{
     		background-color: black;
     		/*background-image: url(images/13.jpg);*/
     		
     	}
     	.wrapper
     	{
     		height: 550px;
     		width: 500px;
     		background-color: white;
     		opacity: .7;
     		color: black;
     		margin: 10px auto;
     		padding: 10px;
     	}
     	.form-control
     	{
     		height: 45px;
     		width: 75%;

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
			width: 400px;
			padding: 13px 10px;
			background-color: #3c3636c4;
			color: white;
			border-radius: 8px;
			order: -1;
		}
		.admin .chatbox
		{
			height: 42px;
			width: 400px;
			padding: 13px 10px;
			background-color: black;
			color: white;
			border-radius: 8px;
			
		}
     </style>
</head>
<body>
	<?php 
	if (isset($_POST['submit'])) 
	{
		mysqli_query($db,"INSERT INTO message VALUES ('', '$_SESSION[login_user]','$_POST[message]','no','student');");

		$result=mysqli_query($db,"SELECT * FROM message;");
	}
	else
	{
		$result=mysqli_query($db,"SELECT * FROM message;");
	}

	mysqli_query($db,"UPDATE message SET seen='yes' WHERE sender='admin' and username='$_SESSION[login_user]';");

	?>
	<div class="wrapper">
			<div style="height: 70px;width: 100%;background-color: grey; text-align: center;color: black;">
				<h3 style="margin-top: -5px;padding-top:20px;">ADMIN</h3>

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
                        echo "<img class='img_circle profile_img'
                        height=40 width=40 src='images/".$_SESSION['photo']."'>";
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
						 <img src="images/user1.jpg" style="height: 40px; width: 40px; border-radius: 50%">
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

			<div style="height: 100px; padding-top: 10px;">
					<form action="" method="post">
							<input type="text" name="message" class="form-control" required="" placeholder="Write Your message here.." style="float: left;">&nbsp
							
							<button class="btn btn-info btn-lg" type="submit" name="submit"><span class=" glyphicon glyphicon-send"></span>&nbspSend</button>
					</form>
			</div>	
			
	</div>
	
</body>
</html>