<?php
require_once "../config.php";

if (isset($_SESSION['user_id'])) {
	echo "<script>
	alert('User already logged in!');
	location.href= '/Web';</script>";
	exit;
	}


if (isset($_POST["intent"])) {
	if ($_POST['intent'] === 'login') {
		$email = $_POST['email'];
		$password = $_POST['password'];


		// retrieve the user details
		$user = $admin->ret("SELECT * FROM `user` WHERE `email` = ?", array($email));
		$row = $user->fetch(PDO::FETCH_ASSOC);
		$num = $user->rowCount();


		// check if user exists
		if ($num > 0) {
			$user_pass = $row["password"];

			// check if password matches
			if (password_verify($password, $user_pass)) {
				$id = $row["user_id"];
				$_SESSION["user_id"] = $id; // set user id in session

				echo "<script> alert('login sucessful'); location.href = '/Web'; </script>";
				} else {
				echo "<script> alert('Email or password is incorrect'); location.href='/Web/views/auth/auth.php?auth=login' </script>";
				}

			} else {
			echo "<script> alert('Email or password is incorrect'); location.href='/Web/views/auth/auth.php?auth=login' </script>";
			}
		} else if ($_POST["intent"] === "register") {
		$email = $_POST["email"];
		$password = $_POST["password"];
		$username = $_POST["username"];

		$hashed_pw = password_hash($password, PASSWORD_DEFAULT);

		$user = $admin->ret("SELECT * FROM `user` where `email`= ?", array($email));
		$rowCount = $user->rowCount();

		if ($rowCount > 0) {
			echo "<script>alert('Email already exists'); location.href = '/Web/views/auth/auth.php?auth=login'; </script>";
			exit();

			} else {
			$admin->cud("INSERT INTO `user`(`username`, `email`, `password`) VALUES (?, ?, ?)", array($username, $email, $hashed_pw), 'saved');

			$res = $admin->ret("SELECT `user_id` FROM `user` WHERE `email` = ?", array($email));
			$id = $res->fetch(PDO::FETCH_ASSOC)['user_id'];
			$_SESSION['user_id'] = $id;

			echo "<script>alert('User added successfully $id'); location.href='/Web'; </script>";
			exit();

			}

		}
	} else {
	echo "<script> alert('Please fill the fields'); location.href='/Web/views/auth/auth.php?auth=login';";
	exit();
	}