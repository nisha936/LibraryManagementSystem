<?php
	include "navbar.php";
    include "connection.php";
?>
<!DOCTYPE html>
<html>
<head>
	<title>Profile</title>
	<style type="text/css">
		.profile
		{
			width: 400px;
			margin: 0 auto;
			color: white;
			-webkit-text-fill-color: white; 
		}
		.img-circle
		{
			border-radius: 50%;
			height: 120px;
			width: 130px;
		}
	</style>
</head>
<body style="background-color: black">
	<div class="container">
		<form action="" method="post">
			<br>
			<input class="btn-default" type="submit" name="submit1" value="Edit" style="float: right; color: black; width: 80px; height: 40px; border-radius: 5px;">
		</form>
		<div class="profile">
			<?php

				if (isset($_POST['submit1'])) 
				{
					?>
					<script type="text/javascript">
						window.location="editprofile.php"
					</script>
					<?php
				}

				$q=mysqli_query($db,"SELECT * FROM admin WHERE username='$_SESSION[login_user]' ;");	
			?>
			<h2 style="text-align: center;">My Profile</h2>
			<?php
				$row=mysqli_fetch_assoc($q); 

				echo "	<div style='text-align: center'>
							<img class='img-circle profile-img' src='images/".$_SESSION['photo']."'>
						</div>";
			?>
			<div style="text-align: center;"><b>Welcome</b>
				<h4>
					<?php
					echo $_SESSION['login_user'];
					?>
				</h4>
			</div>
			<?php
				echo "<b>"; 
				echo "<table class='table'>";
					echo "<tr>";
						echo "<td>";
							echo "<b>First Name:</b>";
						echo "</td>";

						echo "<td>";
							echo $row['firstname'];
						echo "</td>";
					echo "</tr>";

					echo "<tr>";
						echo "<td>";
							echo "<b>Last Name:</b>";
						echo "</td>";

						echo "<td>";
							echo $row['lastname'];
						echo "</td>";
					echo "</tr>";	

					echo "<tr>";
						echo "<td>";
							echo "<b>Username:</b>";
						echo "</td>";

						echo "<td>";
							echo $row['username'];
						echo "</td>";
					echo "</tr>";

					echo "<tr>";
						echo "<td>";
							echo "<b>Password:</b>";
						echo "</td>";

						echo "<td>";
							echo $row['password'];
						echo "</td>";
					echo "</tr>";

					echo "<tr>";
						echo "<td>";
							echo "<b>Email:</b>";
						echo "</td>";

						echo "<td>";
							echo $row['email'];
						echo "</td>";
					echo "</tr>";

					echo "<tr>";
						echo "<td>";
							echo "<b>Contact Number:</b>";
						echo "</td>";

						echo "<td>";
							echo $row['contact'];
						echo "</td>";
					echo "</tr>";
				echo "</table>";
			echo "</b>"; 

			?>
		</div>
		
	</div>

</body>
</html>