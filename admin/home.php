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
        <input type="text" name="search">
        <input type="submit" name="submit" value="Search">
    </form>
    <?php
    if (isset($_POST['search'])) {
        $search_value=$_POST["search"];
        if($db->connect_error){
            echo 'Connection Failed: '.$db->connect_error;
            }else{
                $sql="select * from users where username like '%$search_value%'";

                $res=$db->query($sql);

                while($row=$res->fetch_assoc()){
                 $username = $row["username"];
                 $_SESSION['userid'] = $row["id"];
                 $userid = $_SESSION['userid'];
                 }       
              }
    ?>
    
    	<form>
		<?php
            $result = mysqli_query($db, "SELECT * FROM users WHERE username = '$username'");

			if ($_SESSION["user"]['username']) {
			?>	

	    	<table class="data">
	    		<thead>
	    			<tr>
	    				<th width="10%">ID</th>
	    				<th width="50%">Name of the student</th>
	    				<th width="20%">Weight</th>
	    				<th width="20%">Height</th>
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
        	$result = mysqli_query($db, "SELECT * FROM comments WHERE pres_id = '$userid' ORDER BY date");

			if ($_SESSION["user"]['id']) {
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
		<br><br>
		<h4><a href="update.php" style="color: green;">Add New History</a></h4>
		<?php
        }
    }
	?>
	</form>
	
	
</html>



