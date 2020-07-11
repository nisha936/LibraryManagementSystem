<?php
    include "navbar.php";
    include "connection.php";
?>
<!DOCTYPE html>
<html>
<head>
	<title>Change Password</title>
	<style type="text/css">
		body
		{
			/*width: 1200px;*/
			height: 600px;
			background-color: black;
			/*background-image: url("images/10.jpg");*/
			background-repeat: no-repeat;	
		}
		.update
		{
			width: 550px;
			height: 350px;
			background-color: white;
			margin: 70px auto;
			opacity: .7;
			color: black;
			padding: 25px; 
		}
		.form-control
		{
			width: 450px;
		}
	</style>
</head>
<body>
	<div class="update">
		<div style="text-align:center; ">
			<h1 style="text-align: center; font-size: 35px;font-family:Arial, Helvetica, sans-serif;">Change Password</h1><br>
		</div>
		<div style="padding-left: 30px;">
				<form action="" method="post">
				<input type="text" name="username" class="form-control" placeholder="Username" required=""><br>
				<input type="text" name="email" class="form-control" placeholder="Email" required=""><br>
				<input type="password" name="newpassword" class="form-control" placeholder="New Password" required=""><br>

				<input class="btn-default" type="submit" name="submit" value="Update" style="color: black; width: 80px; height: 30px;border-radius: 5px;">

			</form>
		</div>
	</div>
	<?php
		if(isset($_POST['submit']))
		{
			if(mysqli_query($db,"UPDATE student SET password='$_POST[newpassword]' WHERE username='$_POST[username]' AND email='$_POST[email]';"))
			{
				?>
				<script type="text/javascript">
					alert("Password updated successfully.");
				</script>
				<?php 
			}
		}
	?>
</body>
</html>
