<?php
include 'navbar.php';
include 'connection.php';
?>
<!DOCTYPE html>
<html>
<head>
	<title>Edit Profile</title>
	<style type="text/css">
		body
		{
			background-color: black;
		}
		form
		{
			padding-left: 500px;
		}
		.form-control
		{
			width: 350px;
			height:35px;
		}
		label
		{
			color: white;
		}
	</style>
</head>
<body>
	<h2 style="text-align: center;color: white;">Edit Information</h2><br>

	<?php
		$sql="SELECT * FROM student WHERE username='$_SESSION[login_user]' ";
		$result=mysqli_query($db,$sql) or die (mysql_error());

		while ($row=mysqli_fetch_assoc($result)) 
		{
			$firstname=$row['firstname'];
			$lastname=$row['lastname'];
			$faculty=$row['faculty'];
			$semester=$row['semester'];
			$LCID=$row['LCID'];
			$username=$row['username'];
			$password=$row['password'];
			$email=$row['email'];
			$contact=$row['contact'];
		}
	?>

	
	<form action="" method="post" enctype="multipart/form-data">

		<input class="form-control" type="file" name="file"><br>

		<label><h6>First Name:</h6></label>
		<input class="form-control" type="text" name="firstname" value="<?php  echo $firstname;?>"><br>
		<label><h6>Last Name:</h6></label>
		<input class="form-control" type="text" name="lastname" value="<?php  echo $lastname;?>"><br>
		<label><h6>Faculty:</h6></label>
		<input class="form-control" type="text" name="faculty" value="<?php  echo $faculty;?>"><br>
		<label><h6>Semester:</h6></label>
		<input class="form-control" type="text" name="semester" value="<?php  echo $semester;?>"><br>
		<label><h6>LCID:</h6></label>
		<input class="form-control" type="text" name="LCID" value="<?php  echo $LCID;?>"><br>
		<label><h6>Username:</h6></label>
		<input class="form-control" type="text" name="username" value="<?php  echo $username;?>"><br>
		<label><h6>Password:</h6></label>
		<input class="form-control" type="text" name="password" value="<?php  echo $password;?>"><br>
		<label><h6>Email:</h6></label>
		<input class="form-control" type="text" name="email" value="<?php  echo $email;?>"><br>
		<label><h6>Contact Number:</h6></label>
		<input class="form-control" type="text" name="contact" value="<?php  echo $contact;?>"><br>

		<input class="btn-default" type="submit" name="submit" value="Save" style="color: black; width: 80px; height: 40px; border-radius: 5px;">
		

	</form>
	<?php
		if (isset($_POST['submit'])) 
		{
			move_uploaded_file($_FILES['file']['tmp_name'],"images/".$_FILES['file']['name']);

			$firstname=$_POST['firstname'];
			$lastname=$_POST['lastname'];
			$faculty=$_POST['faculty'];
			$semester=$_POST['semester'];
			$LCID=$_POST['LCID'];
			$username=$_POST['username'];
			$password=$_POST['password'];
			$email=$_POST['email'];
			$contact=$_POST['contact'];
			$photo=$_FILES['file']['name'];

			$sql1="UPDATE student SET  photo='$photo',firstname='$firstname', lastname='$lastname',faculty='$faculty',semester='$semester',LCID='$LCID',username='$username',password='$password',email='$email',contact='$contact' WHERE username='".$_SESSION['login_user']."';";
			if (mysqli_query($db,$sql1)) 
			{
				?>
				<script type="text/javascript">
					alert("Saved Successfully.");
					window.location="studentprofile.php";
				</script>
				<?php
			}
		}

	?>
</body>
</html>