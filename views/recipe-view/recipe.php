<?php
require_once '../../config.php';
if (isset($_GET['recipe_id'])) {
	$res = $admin->ret("SELECT * FROM recipe WHERE recipe_id = ?", array($_GET['recipe_id']));
	$recipe = $res->fetch(PDO::FETCH_ASSOC);
	}

?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<link rel="stylesheet" href="/Web/styles/style.css" />
	<link rel="stylesheet" href="/Web/styles/recipe.css" />
	<?php include ("../../includes/head-links.php"); ?>
	<title><?php echo $recipe['title']; ?></title>
</head>

<body>
	<?php include ("../../includes/navbar.php"); ?>
	<?php include ('../../controller/getFavorites.php'); ?>
	<div class="container">
		<section class="recipe-container">
			<h1><?php echo $recipe['title']; ?></h1>
			<img src=<?php echo $recipe['image_url']; ?> alt="" />
			<div class="recipe-content">
				<div class="c_r-container">
					<div class="rating">
						<div class="rating-star">
							<?php
							$review_res = $admin->ret("SELECT * FROM comment WHERE recipe_id =?", array($_GET['recipe_id']));
							for ($i = 1; $i <= 5; $i++) {
								if ($i <= $recipe['rating']) { ?>
													<span class="fa-solid fa-star"></span>
										<?php } else { ?>
													<span class="fa-regular fa-star"></span>
										<?php }
								} ?>
						</div>
						<span
							class="total-rating">(<?php echo $review_res->rowCount(); ?>)</span>
						<a class="scroll-to__link" href="#reviews__section">
						</a>
					</div>
					<?php
					if (isset($_SESSION['user_id'])) {
						$rows = $favs->fetchAll(PDO::FETCH_ASSOC);
						$class = 'fa-regular';
						$intent = 'insert';
						foreach ($rows as $row) {
							if ($row['recipe_id'] === $recipe['recipe_id']) {
								$class = 'fa-solid';
								$intent = 'delete';
								break;
								}
							}
						?>
								<a
									href=<?php echo "../../controller/addAndDeleteFavorites.php?recipe_id=" . $recipe['recipe_id'] . "&intent=" . $intent; ?>>
									<span
										class="<?php echo $class . " fa-bookmark fa-2xl"; ?>"
										style="color: #ff916c"></span>
								</a>
					<?php } ?>
				</div>
				<span
					class="recipe-category"><?php echo $recipe['cuisine'] . " " . $recipe['category']; ?></span>
				<p class="description">
					<?php echo $recipe['description']; ?>
				</p>
				<hr>
				<div class="ingredients-container">
					<h4>Ingredients</h4>
					<ol type="1" class="ingredients">
						<?php
						$arr = explode('#', $recipe['ingredients']);
						foreach ($arr as $key => $value) { ?>
									<li class="ingredient-item"><?php echo $value ?>
									</li>
						<?php } ?>
					</ol>
				</div>
				<hr>
				<div class="instruction-container">
					<h4>Instruction</h4>
					<ul class="instruction-steps">
						<?php $arr = explode('#', trim($recipe['instruction']));
						foreach ($arr as $key => $value) { ?>
									<li><?php echo "<b>Step " . ($key + 1) . ":</b> " . $value ?>
									</li>
						<?php } ?>
					</ul>
				</div>
			</div>
		</section>
		<section class="reviews-container" id="reviews__section">
			<hr />
			<h2>Comments</h2>
			<div class="rate-container">
				<?php
				if (isset($_SESSION['user_id'])) { ?>
							<h3>Rate and comment</h3>
							<form
								action=<?php echo "../../controller/addReview.php?recipe_id=" . $recipe['recipe_id']; ?>
								method="POST">
								<div class="form-rating">
									<input type="number" name="rating" id="rating" hidden
										min="1" max="5" required />
									<span class="fa-regular fa-star fa-2xl"
										data-value="1"></span>
									<span class="fa-regular fa-star fa-2xl"
										data-value="2"></span>
									<span class="fa-regular fa-star fa-2xl"
										data-value="3"></span>
									<span class="fa-regular fa-star fa-2xl"
										data-value="4"></span>
									<span class="fa-regular fa-star fa-2xl"
										data-value="5"></span>
								</div>
								<textarea name="comment" id="comment" cols="50" rows="3"
									placeholder="Join the discussion..."
									required></textarea>
								<button class="btn btn-submit" type="submit">
									Submit
								</button>
							</form>
				<?php } else { ?>
							<h2>Login to add a comment</h2>
				<?php } ?>
			</div>
			<hr />
			<div class="comments"> <?php
			while ($review = $review_res->fetch(PDO::FETCH_ASSOC)) {
				$username = $admin->ret("SELECT username FROM user where user_id = ?", array($review['user_id']))->fetch(PDO::FETCH_ASSOC)['username'];
				$review_id = $review['rating_id'];
				?>
							<div class="comment-container">
								<div class="user"><span><?php echo $username; ?></span>
								</div>
								<div class="user-rating">
									<div>
										<?php for ($i = 1; $i <= 5; $i++) {
											if ($i <= $review['rating']) { ?>
																<span class="fa-solid fa-star fa-sm"></span>
													<?php } else { ?>
																<span class="fa-regular fa-star fa-sm"></span>
													<?php }
											} ?>
									</div>
									<?php if (isset($_SESSION['user_id']) && $review['user_id'] === $_SESSION['user_id']) { ?>
												<div class="user-options">
													<span
														class="fa-solid fa-ellipsis-vertical ellipsis"></span>
													<div class="user-modal">
														<a href="<?php
														echo "/Web/controller/deleteReview.php?rating_id=$review_id&recipe_id=" . $recipe['recipe_id']; ?>"
															class="btn btn-dlt">Delete</a>
													</div>
												</div>
									<?php } ?>
								</div>
								<div class="user-comment">
									<p>
										<?php echo $review['review']; ?>
									</p>
								</div>
							</div>
				<?php } ?>
			</div>
		</section>
	</div>
	<?php include ("../../includes/footer.php"); ?>
</body>

</html>