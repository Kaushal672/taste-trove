<?php
$auth_mode = 'login';
if (isset($_GET['auth']) && ($_GET['auth'] === 'login' || $_GET['auth'] === 'register')) {
	$auth_mode = $_GET['auth'];
	}

?>

<!DOCTYPE html>
<html>

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>login</title>
	<link rel="stylesheet" href="../../styles/auth.css">
	<link rel="stylesheet" href="../../styles/style.css">
	<?php include ("../../includes/head-links.php"); ?>
</head>

<body>
	<?php include ("../../includes/navbar.php"); ?>
	<div class="container">
		<div class="wrapper">
			<form action="/Web/controller/auth.php" method="POST">
				<h2><?php echo ($auth_mode === 'login' ? 'Login' : 'Register'); ?>
				</h2>
				<?php if ($auth_mode !== 'login') { ?>
							<div class="input-field">
								<input type="text" name="username" required
									autocomplete="off">
								<label>Enter your username</label>
							</div>
				<?php } ?>
				<div class="input-field">
					<input type="email" name="email" required
						autocomplete="off">
					<label>Enter your email</label>
				</div>
				<div class="input-field">
					<input type="password" name="password" required>
					<label>Enter your password</label>
				</div>
				<br><br>
				<input type="text" name="intent"
					value=<?php echo ($auth_mode); ?> hidden>
				<button
					type="submit"><?php echo ($auth_mode === 'login' ? 'Login' : 'Register'); ?></button>
				<div class="register">
					<?php if ($auth_mode === 'login') { ?>
								<p>Don't have an account? <a
										href="/Web/views/auth/auth.php?auth=register"
										style="color: #f94c10;">Register</a></p>
					<?php } else { ?>
								<p>Already have an account? <a
										href="/Web/views/auth/auth.php?auth=login"
										style="color: #f94c10;">Login</a></p>
					<?php } ?>
				</div>
			</form>
		</div>
	</div>
	<?php include ("../../includes/footer.php"); ?>
</body>

</html>