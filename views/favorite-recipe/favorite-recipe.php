<?php
require_once ("../../helper/isAuthenticated.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<title>Document</title>
	<link rel="stylesheet" href="/Web/styles/favorite-recipe.css" />
	<link rel="stylesheet" href="/Web/styles/style.css" />
	<?php include ("../../includes/head-links.php"); ?>
</head>

<body>
	<?php include ("../../includes/navbar.php"); ?>
	<div class="wrapper">
		<?php require ('../../controller/getFavorites.php'); ?>
		<?php if ($favs->rowCount() > 0) { ?>
					<h1>Your favorite Recipes</h1>
					<div class="user-recipe-container">
						<?php
						$allFavs = $favs->fetchAll(PDO::FETCH_ASSOC);
						foreach ($allFavs as $fav) { ?>
									<div class="recipe-card favorite-card">
										<img src=<?php echo $fav['image_url']; ?> alt="" />
										<div class="recipe-card__description">
											<h3><?php echo $fav['title']; ?></h3>
											<p>
												<?php echo $fav['description']; ?>
											</p>
											<div class="interactable">
												<div class="rating-stalas
							<?php for ($i = 1; $i <= 5; $i++) {
								if ($i <= $fav['rating']) { ?>
							<span class=" fa-solid fa-star"></span>
																<?php } else { ?>
																			<span class="fa-regular fa-star"></span>
																<?php }
								} ?>
												</div>
											</div>
										</div>
										<a class="card-link"
											href=<?php echo "../recipe-view/recipe.php?recipe_id=" . $fav['recipe_id']; ?>>Continue
											Reading
											<span class="fa-solid fa-arrow-right fa-lg"
												style="color: #ff916c"></span></a>
										<a
											href=<?php echo "../../controller/addAndDeleteFavorites.php?recipe_id=" . $fav['recipe_id'] . "&intent=delete"; ?>>
											<span class="fa-solid fa-bookmark fa-2xl"
												style="color: #ff916c"></span>
										</a>
									</div>
						<?php } ?>
					</div>
		<?php } else { ?>
					<h1> You have no favorites</h1>
		<?php } ?>
	</div>
	<?php include ("../../includes/footer.php"); ?>
</body>

</html>