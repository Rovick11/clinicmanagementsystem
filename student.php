<?php
include('functions.php');
if (!isLoggedIn()) {
	$_SESSION['msg'] = "You must log in first";
	header('location: login.php');
} ?>

<!DOCTYPE html>
<html>
<head>
	<title>Home</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<div class="header">
		<h2>Home Page</h2>
	</div>
	<div class="content">
		<!-- notification message -->
		<?php if (isset($_SESSION['success'])) : ?>
			<div class="error success" >
				<h3>
					<?php 
						echo $_SESSION['success']; 
						unset($_SESSION['success']);
					?>
				</h3>
			</div>
		<?php endif ?>
		<!-- logged in user information -->
		<div class="profile_info">
			<img src="images/user_profile.png"  >

			<div>
				<?php  if (isset($_SESSION['user'])) : ?>
					<strong><?php echo $_SESSION['user']['username']; ?></strong> <br>

					<small>
						<i  style="color: #888;">(<?php echo ucfirst($_SESSION['user']['user_type']); ?>)</i> 
						<br>
						<a href="index.php?logout='1'" style="color: red;">logout</a>
					</small>

				<?php endif ?>
			</div>
		</div>
	</div>

	<form>
		<link rel="stylesheet" type="text/css" href="css/styles.css">
			<div class="findings">
				<nav>
					<ul>
						<li><a href="findings.php">Findings</a></li>
						<li><a href="student.php">Student Info</a></li>
					</ul>
				</nav>
		</div>
	</form>

	<form>
		<?php
			if (isset($_SESSION['user'])) {
			$_POST['username'] = $_SESSION['user']['username'];
			$user = $_POST['username'];
		}

			$result = mysqli_query($db, "SELECT * FROM users WHERE username = '$user'");

			if ($_SESSION["user"]['username']) {
				// code...
			?>	

		<table class="data">
			<thead>
				<tr>
					<th width="5%">ID</th>
					<th width="50%">Name of the student</th>
					<th width="20%">Weight</th>
					<th width="25%">Height</th>
				</tr>
			</thead>

			<tbody>
				<?php
					while ($row = mysqli_fetch_array($result)){
				?>
			<tr>
				<td><?php echo $row["id"]; ?></td>
				<td><?php echo $row["username"]; ?></td>
				<td><?php echo $row["weight"]; ?></td>
				<td><?php echo $row["height"]; ?></td>
			</tr>
				<?php
				}  
			?>
			</tbody>
		</table>
		<?php
		}	
	?>	
	</form>
</body>
</html>