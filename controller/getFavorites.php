<?php
$favs;
if (isset($_SESSION['user_id'])) {
	$user_id = $_SESSION['user_id'];
	$favs = $admin->ret(
		"SELECT image_url, `description`,rating, f.recipe_id as recipe_id, title  FROM favorite f JOIN recipe r ON r.recipe_id = f.recipe_id WHERE f.user_id = ?",
		array($user_id)
	);

	}