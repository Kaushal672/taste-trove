<?php
require_once ('../config.php');
if (isset($_GET["q"])) {
	$q = $_GET["q"];
	$sql = "SELECT * FROM recipe WHERE MATCH(title, `description`, cuisine, ingredients) AGAINST(:q IN NATURAL LANGUAGE MODE) OR category LIKE :category";

	$res = $admin->search($sql, $q, "%$q%");
	$_SESSION['search_results'] = $res->fetchAll(PDO::FETCH_ASSOC);
	$_SESSION['q'] = $q;
	echo "<script> location.href = '../views/search-results/search-results.php'</script>";
	exit();
	}