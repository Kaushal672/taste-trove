<?php
require_once ('../config.php');

session_destroy();

unset($_SESSION['user_id']);

echo "<script> alert('Logged out successfully'); location.href='/Web'</script>";