<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Login</title>
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="assets/css/styles.css">
</head>
<body>
	<?php require("components/header.php")  ?>
	<h1>Login</h1>
	<form action="login.php" method="POST">
		<input type="text" name="email" placeholder="enter your email">
		<input type="password" name="password" placeholder="enter your password">
		<input type="submit" value="Send">
	</form>
</body>
</html>
