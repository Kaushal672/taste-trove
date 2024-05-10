<!DOCTYPE html>
<html>

<head lang="en">
	<meta charset="UTF-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<link rel="stylesheet" href="/Web/styles/style.css" />
	<link rel="stylesheet" href="/Web/styles/search-results.css" />
	<?php include ("../../includes/head-links.php"); ?>
	<title>Recipe</title>
</head>

<body>
	<?php include ("../../includes/navbar.php"); ?>
	<div class="container">
		<?php
		if (isset($_SESSION['search_results'])) {
			$res = $_SESSION['search_results'];
			}
		?>
		<span
			id="total-results"><?php echo count($res) . " results found for " . $_SESSION['q']; ?></span>
		<?php if (count($res) > 0) { ?>
				<div class="search-result__container">
					<?php foreach ($res as $row) { ?>
							<div class="recipe-card">
								<img src=<?php echo $row['image_url']; ?> alt="" />
								<div class="recipe-card__description">
									<h3><?php echo $row['title'] ?></h3>
									<p>
										<?php echo $row['description'] ?>
									</p>
									<div class="interactable">
										<div class="rating-star">
											<?php for ($i = 1; $i <= 5; $i++) {
												if ($i <= $row['rating']) { ?>
															<span class="fa-solid fa-star"></span>
													<?php } else { ?>
															<span class="fa-regular fa-star"></span>
													<?php }
												} ?>
										</div>
									</div>
								</div>
								<a class="card-link"
									href=<?php echo "../recipe-view/recipe.php?recipe_id=" . $row['recipe_id']; ?>>Continue
									Reading
									<span class="fa-solid fa-arrow-right fa-lg"
										style="color: #ff916c"></span></a>
							</div>
					<?php } ?>
				</div>
		<?php } ?>
	</div>
	<?php include ("../../includes/footer.php"); ?>
</body>

</html>