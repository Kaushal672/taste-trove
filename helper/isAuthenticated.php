<?php
require_once (__DIR__ . "\..\config.php");
if (!isset($_SESSION['user_id'])) {
	echo "<script> 
		alert('You are not logged in!!');
		location.href = '/Web/views/auth/auth.php?auth=login';</script>";
	exit;
	}