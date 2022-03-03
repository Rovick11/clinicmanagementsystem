<?php 
include('../functions.php');

if (!isAdmin()) {
	$_SESSION['msg'] = "You must log in first";
	header('location: ../login.php');
}

if (isset($_GET['logout'])) {
	session_destroy();
	unset($_SESSION['user']);
	header("location: ../login.php");
}
if (isset($_POST['update_btn'])) {
    $userid = $_SESSION['userid'];
    $findings=htmlspecialchars($_POST["findings"]);
    $prescription=htmlspecialchars($_POST["prescription"]);
    $result = mysqli_query($db, "INSERT INTO comments (pres_id,findings,prescription) VALUES ('".$userid."','".$findings."','".$prescription."')");
    header("location: home.php");
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Home</title>
	<link rel="stylesheet" type="text/css" href="../style.css">
	<style>
	.header {
		background: #003366;
	}
	button[name=register_btn] {
		background: #003366;
	}
	</style>
</head>
<body>
	<div class="header">
		<h2>Doctor - Home Page</h2>
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
			<img src="../images/admin_profile.png"  >

			<div>
				<?php  if (isset($_SESSION['user'])) : ?>
					<strong><?php echo $_SESSION['user']['username']; ?></strong>

					<small>
						<i  style="color: #888;">(<?php echo ucfirst($_SESSION['user']['user_type']); ?>)</i> 
						<br>
						<a href="home.php?logout='1'" style="color: red;">logout</a>
					</small>

				<?php endif ?>
			</div>
		</div>
	</div>
</body>

		<form method="post">
		    <br>
		    <label>Findings:</label><br>
		    <textarea name="findings" rows="5" cols="50"></textarea><br>
		    <label>Prescription:</label><br>
		    <textarea name="prescription" rows="5" cols="50"></textarea><br>
            <button type="submit" class="btn" name="update_btn">Update</button>
        </form>
	</form>
</html>



