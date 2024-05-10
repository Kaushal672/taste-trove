<?php
require_once ('../config.php');

if (!isset($_SESSION['user_id'])) {
	echo "<script>
	alert('You have to be logged in to delete review');
	location.href='/Web'</script>";
	exit;
	}

if (isset($_GET['rating_id'])) {
	$rating_id = $_GET['rating_id'];
	$recipe_id = $_GET['recipe_id'];
	$admin->cud("DELETE FROM comment WHERE rating_id = ?", array($rating_id), " deleted review");
	echo "<script> location.href='/Web/views/recipe-view/recipe.php?recipe_id=$recipe_id';</script>";
	exit;

	}