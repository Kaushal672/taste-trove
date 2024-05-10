<?php
require_once ('../../helper/isAuthenticated.php');
require_once ("../../config.php");
$intent = 'add';
$title = '';
$image_url = '';
$meal_type = 'Breakfast';
$cuisine = '';
$description = '';
$instruction = '';
$ingredients = '';
$action_url = "/Web/controller/addAndEditRecipe.php";

if ($_GET['intent'] === 'edit' && isset($_GET['recipe_id'])) {
	$recipe_id = $_GET['recipe_id'];
	$intent = 'edit';
	$action_url .= "?recipe_id=" . $recipe_id;
	$res = $admin->ret("SELECT * FROM recipe WHERE recipe_id = ?", array($recipe_id));

	if ($res->rowCount() > 0) {
		$row = $res->fetch(PDO::FETCH_ASSOC);
		$title = $row["title"];
		$image_url = $row["image_url"];
		$meal_type = $row["category"];
		$cuisine = $row["cuisine"];
		$description = $row["description"];
		$instruction = $row["instruction"];
		$ingredients = $row["ingredients"];
		}
	}
?>

<!DOCTYPE html>
<html>

<head>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<title>login</title>
	<link rel="stylesheet" href="/Web/styles/style.css" />
	<link rel="stylesheet" href="/Web/styles/recipe-form.css" />
	<?php include ("../../includes/head-links.php"); ?>
</head>

<body>
	<?php include ("../../includes/navbar.php"); ?>
	<div class="wrapper">
		<form class="add-form" action="<?php echo $action_url; ?>"
			method="POST">
			<h2><?php echo $_GET['intent']; ?> Recipe</h2>
			<input type="text" name="intent" value="<?php echo $intent; ?>"
				hidden>
			<div class="input-field">
				<label>Title</label>
				<input name="title" type="text" value="<?php echo $title; ?>"
					required />
			</div>
			<div class="input-field">
				<label>Image url</label>
				<input name="image_url" type="url"
					value="<?php echo $image_url; ?>" required />
			</div>
			<cla class="input-field">
				<label for="mealtype">Mealtype</label>
				<select name="mealtype" id="mealtype">
					<option <?php if ($meal_type === 'breakfast')
						echo 'selected'; ?> value="breakfast">Breakfast</option>
					<option <?php if ($meal_type === 'dinner')
						echo 'selected'; ?> value="dinner">Dinner</option>
					<option <?php if ($meal_type === 'lunch')
						echo 'selected'; ?> value="lunch">Lunch</option>
				</select>
			</cla>
			<div class="input-field">
				<label>Cuisine</label>
				<input name="cuisine" type="text"
					value="<?php echo $cuisine; ?>" required />
			</div>
			<div class="input-field">
				<label>Description</label>
				<textarea name="description" rows="3" cols="55"
					required><?php echo $description; ?></textarea>
			</div>
			<div class="input-field">
				<label>Instruction</label>
				<textarea name="instruction" rows="3" cols="55" required
					placeholder="Separate each steps with #"><?php echo $instruction; ?></textarea>
			</div>
			<div class="input-field">
				<label>Ingredients</label>
				<input name="ingredients" type="text"
					value="<?php echo $ingredients; ?>" required
					placeholder="Separate each ingredient with #" />
			</div>
			<br /><br />
			<button type="submit">Submit</button>
		</form>
	</div>
	<?php include ("../../includes/footer.php"); ?>
</body>

</html>