<?php
require_once ("../config.php");
if (isset($_POST['intent']) && isset($_SESSION['user_id'])) {
	$title = $_POST['title'];
	$image_url = $_POST['image_url'];
	$meal_type = $_POST['mealtype'];
	$cuisine = $_POST['cuisine'];
	$description = $_POST['description'];
	$instruction = $_POST['instruction'];
	$ingredients = $_POST['ingredients'];
	$user_id = $_SESSION['user_id'];


	if ($_POST['intent'] === 'add') {
		$args = array($title, $description, $instruction, $cuisine, $meal_type, $ingredients, $user_id, $image_url);
		$sql = "INSERT INTO recipe(title, `description`, instruction, cuisine, category, ingredients, user_id, image_url) VALUES(?, ?, ?, ?, ?, ?, ?, ?)";

		$admin->cud($sql, $args, " added recipe");

		echo "<script> location.href='/Web/views/user-recipe/user-recipe.php'; </script>";
		exit;

		} else if ($_POST['intent'] === 'edit' && isset($_GET['recipe_id'])) {
		$recipe_id = $_GET['recipe_id'];
		$args = array($title, $image_url, $meal_type, $cuisine, $description, $instruction, $ingredients, $recipe_id);

		$sql = "UPDATE recipe SET title=?, image_url=?, category=?, cuisine=?, `description`=?, instruction=?, ingredients=? WHERE recipe_id = ?";


		$admin->cud($sql, $args, " updated recipe");

		echo "<script> location.href='/Web/views/recipe-view/recipe.php?recipe_id=$recipe_id';</script>";
		exit;
		} else {
		echo "<script> 
			alert('Invalid input');
			location.href='/Web/views/user-recipe/user-recipe.php; 
			</script>";
		}
	} else if (!isset($_SESSION['user_id'])) {
	echo "<script>
		alert('You have to be logged in to manage recipe');
		location.href ='/Web/views/auth/auth.php?auth=login';</script>";
	} else {
	echo "<script>
		alert('Invalid input');
		location.href ='/Web';</script>";
	}