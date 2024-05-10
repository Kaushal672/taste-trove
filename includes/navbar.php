<?php
require_once __DIR__ . '\..\config.php';


if (isset($_SESSION['user_id'])) {
	$user_id = $_SESSION['user_id'];
	$res = $admin->ret("SELECT * FROM `user` WHERE `user_id` = ?", array($user_id));
	$user = $res->fetch(PDO::FETCH_ASSOC);
	}
?>
<header>
	<nav class="nav">
		<div class="logo-container">
			<img src="/Web/assets/logo13-circle.png" alt="" class="logo" />
			<h4>Taste Trove</h4>
			<a class="logo-link" href="/Web"></a>
		</div>
		<div class="search-bar_container">
			<form action="/Web/controller/searchRecipe.php">
				<label for="search">Search for stuff</label>
				<input id="search" type="search" placeholder="Search..."
					name="q" autofocus required />
				<button type="submit" class="search-btn">Go</button>
			</form>
		</div>
		<ul class="nav-items">
			<?php if (isset($_SESSION["user_id"])) { ?>
						<li class="nav-item">
							<a href="/Web/views/favorite-recipe/favorite-recipe.php"><span
									class="material-symbols-outlined">
									favorite
								</span></a>
						</li>
						<li class="nav-item"><a href="/Web/controller/logout.php">Log
								out</a></li>
						<li class="nav-item drop-down__container">
							<a href="#"><?php echo $user['username']; ?></a>
							<div class="drop-down">
								<div class="drop-down__item"><a
										href="/Web/views/recipe-form/recipe-form.php?intent=add">Add
										a Recipe</a></div>
								<div class="drop-down__item"><a
										href="/Web/views/user-recipe/user-recipe.php">Your
										Recipes</a></div>
							</div>
						</li>
			<?php } else { ?>
						<li class="nav-item"><a
								href="/Web/views/auth/auth.php?auth=register">Register</a>
						</li>
						<li class="nav-item login-btn">
							<a href="/Web/views/auth/auth.php?auth=login">Login</a>
						</li>
			<?php } ?>
		</ul>
	</nav>
</header>