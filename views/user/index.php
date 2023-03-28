<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title></title>
</head>
<body>
	<ul>
		<?php foreach($data as $user): ?>
		<li><a href="/user/show/<?= $user["id"] ?>"><?= $user["email"] ?></a></li>
		<?php endforeach; ?>
	</ul>
</form>
</body>
</html>
