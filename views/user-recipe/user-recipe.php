<?php
require_once ('../../helper/isAuthenticated.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<title>Document</title>
	<link rel="stylesheet" href="/Web/styles/user-recipe.css" />
	<link rel="stylesheet" href="/Web/styles/style.css" />
	<?php include ("../../includes/head-links.php"); ?>
</head>

<body>
	<?php include ("../../includes/navbar.php"); ?>
	<div class="wrapper">
		<h1>Your Recipes</h1>
		<div class="user-recipe-container">
			<?php
			require_once ("../../config.php");
			if (isset($_SESSION['user_id'])) {
				$user_id = $_SESSION['user_id'];

				$res = $admin->ret("SELECT * FROM recipe WHERE user_id = ?", array($user_id));
				}
			if ($res->rowCount() > 0) {
				$rows = $res->fetchAll(PDO::FETCH_ASSOC);
				echo "<script> console.log(" . ($res->rowCount()) . ");</script>";
				foreach ($rows as $row) {
					$recipe_id = $row['recipe_id'];
					?>
									<div class="user-recipe-card">
										<img src="<?php echo $row['image_url']; ?>" alt="" />
										<div class="user-card__content">
											<h3><?php echo $row['title']; ?></h3>
											<p>
												<?php echo $row['description']; ?>
											</p>
											<a class="btn btn-edit"
												href="<?php
												echo "../recipe-form/recipe-form.php?intent=edit&recipe_id=$recipe_id"; ?>">Edit</a>
											<a class="btn btn-delete" href="<?php echo "/Web/controller/deleteRecipe.php?recipe_id=$recipe_id";
											?>">Delete</a>
											<a class="card-link"
												href="<?php echo "/Web/views/recipe-view/recipe.php?recipe_id=$recipe_id"; ?>"></a>
										</div>
									</div>
						<?php }
				} ?>
		</div>
	</div>
	<?php include ("../../includes/footer.php"); ?>
</body>

</html>