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
			$_POST['pres'] = $_SESSION['user']['id'];
			$user = $_POST['pres'];
		}

			$result = mysqli_query($db, "SELECT * FROM comments WHERE pres_id = '$user' ORDER BY date");

			if ($_SESSION["user"]['id']) {
				// code...
			?>	

		<table class="data">
			<thead>
				<tr>
					<th width="33%">Date</th>
					<th width="33%%">Findings</th>
					<th width="33%">Prescription</th>
				</tr>
			</thead>

			<tbody>
				<?php
					while ($row = mysqli_fetch_array($result)){
				?>
			<tr>
				<td><?php echo $row["date"]; ?></td>
				<td><?php echo $row["findings"]; ?></td>
				<td><?php echo $row["prescription"]; ?></td>
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