<?php
require_once "../config.php";

if (!isset($_GET['recipe_id'])) {
	echo "<script>
	alert('Invalid input');
	 location.href='/Web';</script>";
	exit;
	}

$recipe_id = $_GET['recipe_id'];
$redirectTo = "../views/recipe-view/recipe.php?recipe_id=" . $recipe_id;

if (isset($_SESSION['user_id']) && isset($_POST["comment"]) && isset($_POST["rating"])) {
	$comment = $_POST["comment"];
	$rating = $_POST["rating"];
	$user_id = $_SESSION['user_id'];

	$sql = "INSERT INTO comment(user_id, recipe_id, review,rating) VALUES(?, ?, ?, ?)";
	$args = array($user_id, $recipe_id, $comment, $rating);

	$admin->cud($sql, $args, ' added review');
	echo "  <script> location.href='$redirectTo';</script>";
	exit;
	} else {
	$recipe_id = $_GET['recipe_id'];
	echo "<script> location.href='$redirectTo'; </script>";
	}