<?php
session_start();
if (isset($_SESSION["username"])) {
	header("Location: gweets.php");
}
?>

<html>
	<head>
		<title>Gwitter</title>

		<style>
.center_vertically {
	padding:25px;
	display:flex;
	flex-direction:column;
	justify-content:flex-start;
	align-items:center
}

form > * {
	margin: 10px;
}
		</style>
	</head>

	<body style="padding:50px; height: 100%">

		<h1>Welcome To Gwitter</h1>

		<div style="height:80%" class="center_vertically"> <!-- Veritcally Center Children -->

			<div class="center_vertically"> <!-- Vertically Center Children -->
				<h2>LogIn To Continue</h2>
				<form action="login.php" style="padding-left:25px" method="post">
					<input type="text" name="username" placeholder="Username">
					<br>
					<input type="password" name="password" placeholder="Password">
					<br>
					<input type="submit" value="Submit" />
				</form>
			</div>

			<div style="padding:50"></div> <!-- The padding between layers -->

			<div class="center_vertically"> <!-- Veritcally Center Children -->
				<h2>New To Gwitter? SignUp!</h2>
				<form action="signup.php" style="padding-left:25px" method="post">
					<input type="text" name="name" placeholder="Name"><br/>
					<input type="text" name="username" placeholder="Username"><br/>
					<input type="password" name="password" placeholder="Password"><br/>
					<label for="birthday">Birthday</label><input type="date" name="bdate"><br/>

					<br>
					<input type="submit" value="Submit" />
				</form>
			</div>
		</div>
	</body>
</html>
