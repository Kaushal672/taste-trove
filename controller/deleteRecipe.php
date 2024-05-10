<?php
require_once "../config.php";

if (!isset($_SESSION['user_id'])) {
	echo "<script>
	alert('You have to be logged in to delete recipe');
	location.href='/Web'</script>";
	exit;
	}

if (isset($_GET['recipe_id'])) {
	$recipe_id = $_GET['recipe_id'];

	$admin->cud("DELETE FROM recipe WHERE recipe_id=? AND user_id=?", array($recipe_id, $_SESSION['user_id']), " deleted recipe");

	echo "<script> location.href='/Web/views/user-recipe/user-recipe.php';</script>";
	}