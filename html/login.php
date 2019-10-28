<?php

session_start();
include_once("conn.php");

if (isset($_POST['Logout']) && $_POST['Logout'] === "Logout") {
	unset($_SESSION['username']);
	unset($_SESSION['user_id']);
}

if (isset($_POST['username']) && isset($_POST['password'])) {
	$username = $_POST['username'];
	$password = $_POST['password'];
	$stat = $db->prepare("SELECT * from users where username = :username");
	$stat->execute([
		'username' => $username
	]);
	$result = $stat->fetch();
	if ($result && password_verify($password, $result['password_hash'])) {
		$_SESSION['username'] = $username;
		$_SESSION['user_id'] = $result['id'];
	}
}
header("location: index.php");
