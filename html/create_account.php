<?php
// For development purpose only
session_start();
if (!isset($_SESSION['username'])) {
	die('Not logined');
}
include_once("conn.php");
$stat = $db->prepare("INSERT INTO users (username, password_hash) VALUES (:username, :password_hash)");
$stat->execute([
	'username' => $_GET['u'],
	'password_hash' => password_hash($_GET['p'], PASSWORD_BCRYPT)
]);
