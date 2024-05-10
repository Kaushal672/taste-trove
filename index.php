<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<link rel="stylesheet" href="./styles/style.css" />
	<?php include ("./includes/head-links.php"); ?>
	<title>Recipe</title>
</head>

<body>
	<?php include ("./includes/navbar.php"); ?>
	<?php include ("./controller/getFavorites.php"); ?>
	<section class="banner-container">
		<div>
			<h1 class="banner-slogan">
				The Only Place you'll ever need to look for recipes
			</h1>
			<p>
				Lorem ipsum dolor sit amet consectetur adipisicing elit.
				Debitis sapiente quisquam ad atque maiores est velit omnis
				dolor rem aperiam eaque dolorem consequuntur, ipsa illo
				earum fuga corporis, itaque numquam. Lorem ipsum dolor sit
				amet consectetur adipisicing elit. Voluptate voluptatum
				laboriosam fuga numquam adipisci, expedita, eligendi
				dignissimos incidunt aliquid praesentium tenetur et nostrum
				laudantium eius earum facilis molestiae pariatur
				accusantium!
			</p>
		</div>
	</section>
	<div class="container">
		<section class="content">
			<div class="info-cards">
				<div class="card-container">
					<div class="card">
						<div class="card-content">
							<img class='card-icon' src="./assets/cusine.svg"
								alt="">
							<h2>Cuisine</h2>
							<p>
								"Explore our website, where we offer a
								plethora of tantalizing recipes from diverse
								cuisines around the globe, ensuring you can
								indulge in the flavors of your favorite
								culinary traditions anytime, anywhere."
							</p>
						</div>
					</div>
				</div>
				<div class="card-container">
					<div class="card">
						<div class="card-content">
							<img class='card-icon' src="./assets/meal.svg"
								alt="">
							<h2>Meal Type</h2>
							<p>
								"Discover a culinary adventure at our
								website, where you can explore a vast array
								of mouthwatering recipes tailored to every
								meal type, from hearty breakfasts to
								delectable desserts."
							</p>
						</div>
					</div>
				</div>
				<div class="card-container">
					<div class="card">
						<div class="card-content">
							<img class='card-icon' src="./assets/grocery.png"
								alt="">
							<h2>Ingredients</h2>
							<p>
								"Discover a world of culinary possibilities
								with our website, where you can find
								delicious recipes tailored to the
								ingredients you have on hand."
							</p>
						</div>
					</div>
				</div>
				<div class="card-container">
					<div class="card">
						<div class="card-content">
							<img class='card-icon' src="./assets/dessert.svg"
								alt="">
							<h2>Desserts</h2>
							<p>
								"Indulge your sweet tooth with our extensive
								collection of dessert recipes, guaranteed to
								satisfy cravings and impress guests with
								every delightful bite."
							</p>
						</div>
					</div>
				</div>
			</div>
			<div class="use-cases__container">
				<h2>Use Cases</h2>
				<div class="tabs-container">
					<div class="tabs-container__buttons">
						<button class="tab-button active" data-index="1">
							<span class="material-symbols-outlined">
								manage_search </span>Recipe Analysis
						</button>
						<button class="tab-button" data-index="2">
							<span class="material-symbols-outlined">
								inventory_2 </span>Recipe Management
						</button>
						<button class="tab-button" data-index="3">
							<span class="material-symbols-outlined">
								calendar_month </span>Meal Planning
						</button>
						<button class="tab-button" data-index="4">
							<span class="material-symbols-outlined">
								shopping_bag </span>Shoppable Recipes
						</button>
					</div>
					<hr />
					<div class="tabs-content tab-content-1 tab-active">
						<img src="assets/recipe-analysis.jpg" alt="" />
						<div class="tab-details">
							<h3>Special Diets/Intolerances</h3>
							<p>
								We automatically analyze recipes to check
								for ingredients that contain common
								allergens, such as wheat, dairy, eggs, soy,
								nuts, etc. We also determine whether a
								recipe is vegan, vegetarian, Paleo friendly,
								Whole30 compliant, and more.
							</p>
						</div>
					</div>
					<div class="tabs-content tab-content-2">
						<img src="assets/reicpe-management.jpg" alt="" />
						<div class="tab-details">
							<h3>Search & Organize</h3>
							<p>
								We make it easy to search recipe and not
								just any recipe search. Our semantic search
								is fast, accurate, and pretty darn smart.
								"Gluten free nut free dessert without
								apples"? Easy as pie. Or create your own
								recipe manager. It's all possible. Have your
								own recipe database? Great! Let us help you
								get it under control. With our website, you
								will be able to find the recipes you want.
							</p>
						</div>
					</div>
					<div class="tabs-content tab-content-3">
						<img src="assets/plan-meals.jpg" alt="" />
						<div class="tab-details">
							<h3>Plan your meals</h3>
							<p>
								Plan your meals for the week using recipes
								or even your own brand of packaged foods.
								The daily nutritional information is
								calculated automatically.
							</p>
						</div>
					</div>
					<div class="tabs-content tab-content-4">
						<img src="https://plus.unsplash.com/premium_photo-1661409279183-569bfddb7100?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
							alt="" />
						<div class="tab-details">
							<h3>Shoppable Recipes</h3>
							<p>
								Finally! An all-in-one solution for cooking
								at home. Youcan pick your recipes and order
								all the ingredients from an online grocer to
								have everything delivered or ready for
								pickup.
							</p>
						</div>
					</div>
				</div>
			</div>
			<div class="trending-recipe">
				<h2>Trending Recipes</h2>
				<div class="trending-content">
					<?php
					$sql = "SELECT * FROM recipe LIMIT 3";
					$recipes = $admin->ret($sql, );
					if (isset($_SESSION['user_id']))
						$rows = $favs->fetchAll(PDO::FETCH_ASSOC);
					while ($recipe = $recipes->fetch(PDO::FETCH_ASSOC)) {
						if (isset($_SESSION['user_id'])) {
							$intent = 'insert';
							foreach ($rows as $row) {
								if ($row['recipe_id'] === $recipe['recipe_id']) {
									$intent = 'delete';
									break;
									}
								}

							$query = http_build_query(array('recipe_id' => $recipe['recipe_id'], 'intent' => $intent));
							}
						?>
						<div class="recipe-card">
							<img src=<?php echo $recipe['image_url']; ?> alt="" />
							<div class="recipe-card__description">
								<h3><?php echo $recipe['title']; ?></h3>
								<p>
									<?php echo $recipe['description']; ?>
								</p>
								<div class="interactable">
									<div class="rating-star">
										<?php for ($i = 1; $i <= 5; $i++) {
											if ($i <= $recipe['rating']) { ?>
												<span class="fa-solid fa-star"></span>
											<?php } else { ?>
												<span class="fa-regular fa-star"></span>
											<?php }
											} ?>
									</div>
								</div>
							</div>
							<a class="card-link"
								href=<?php echo "./views/recipe-view/recipe.php?recipe_id=" . $recipe['recipe_id']; ?>>Continue
								Reading
								<span class="fa-solid fa-arrow-right fa-lg"
									style="color: #ff916c"></span></a>
							<?php if (isset($_SESSION['user_id'])) { ?>
								<a
									href=<?php echo "./controller/addAndDeleteFavorites.php?" . $query; ?>>
									<span
										class="<?php echo "fa-" . ($intent === 'insert' ? 'regular' : 'solid') . " fa-bookmark fa-2xl"; ?>"
										style="color: #ff916c"></span>
								</a>
							<?php } ?>
						</div>
					<?php } ?>
				</div>
			</div>
		</section>
	</div>
	<?php include ("./includes/footer.php"); ?>
</body>

</html>