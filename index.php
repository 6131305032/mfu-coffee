<!-- Start Session -->
<?php
session_start();

unset($_SESSION['active']); 
unset($_SESSION['username']);
unset($_SESSION['useravatar']);
?>

<!--Include Header -->
<?php include 'header.php'; ?>

<!-- Connect to mysql to display existing data -->
<?php 
$mysqli = new mysqli('localhost', 'test', '123456', 'mfu-coffee') or die(mysqli_error($mysqli));

if (isset($_POST['login'])) {
	$username = $_POST['user'];
	$password = $_POST['pass'];

	$result = $mysqli->query("SELECT * FROM user WHERE username LIKE '$username' AND userid = '$password'") or die(mysqli_error($mysqli));

	$row = $result->fetch_array();

	if ($row != null){
		$_SESSION['username']=$row['username'];
		$_SESSION['useravatar']=$row['useravatar'];
		$_SESSION['active']=TRUE;
		$_SESSION['userid']=$row['userid'];
		header("location: coffees.php");
	} else {
		$_SESSION['message']= "Failed to login!";
		$_SESSION['msg_type'] = "danger";
		header("location: index.php");
	}
}
?>

<body>
	<div class="container-fluid">
		<div class="row justify-content-center">
			<div class="border p-3 mt-3" style="width: 20rem;">
				<form action="" method="post">
					<div class="panel panel-success">
						<div class="panel-heading">
							LOGIN
						</div>
						<div class="panel-body">
							<div class="form-group">
								<label> Username:</label>
								<input type="text" name="user" class="form-control">
							</div>
							<div class="form-group">
								<label> Password:</label>
								<input type="Password" name="pass" class="form-control">

							</div>
							<div class="form-group">
								<button type="submit" name="login" class="form-control btn btn-success">Login</button>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</body>
</html>