<?php
require_once '../config.php';
if (!isset($_SESSION['user_id'])) {
	echo "<script> location.href='/Web'</script>";
	exit;
	}

if (isset($_GET['intent']) && isset($_GET['recipe_id'])) {
	$user_id = $_SESSION['user_id'];
	$recipe_id = $_GET['recipe_id'];

	if ($_GET['intent'] === 'insert') {
		$admin->cud("INSERT INTO favorite(recipe_id,user_id) VALUES (?, ?)", array($recipe_id, $user_id), ' added to favorites');
		echo "<script>alert(" . $_SESSION['success_message'] . ");</script>";
		echo "<script> location.href='/Web/views/favorite-recipe/favorite-recipe.php'</script>";
		exit;

		} else {
		$admin->cud("DELETE FROM favorite WHERE recipe_id = ? AND user_id = ?", array($recipe_id, $user_id), ' deleted from favorites');
		echo "<script> location.href='/Web/views/favorite-recipe/favorite-recipe.php'</script>";
		exit;

		}
	} else {
	echo "<script>
	alert('Invalid input');
	location.href='/Web'</script>";
	exit;
	}