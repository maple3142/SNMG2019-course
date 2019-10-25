<?php

session_start();

include_once("conn.php");
include_once("params.php");

function send_response()
{
	global $db;
	header("Content-Type: application/json; charset=utf-8");
	$result = $db->query('SELECT username AS sender, content, user_id, messages.id AS id, users.id AS user_id FROM messages INNER JOIN users ON messages.user_id = users.id')->fetchAll(PDO::FETCH_ASSOC);
	echo json_encode($result);
}
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
	send_response();
} else if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['content'])) {
	if (!isset($_SESSION['login'])) {
		die('Not logined');
	}
	$stat = $db->prepare("INSERT INTO messages (user_id, content) VALUES (:user_id, :content)");
	$stat->execute([
		'user_id' => $_SESSION['user_id'],
		'content' => $_POST['content']
	]);
	send_response();
} else if ($_SERVER['REQUEST_METHOD'] === 'DELETE' && isset($_DELETE['id'])) {
	if (!isset($_SESSION['login'])) {
		die('Not logined');
	}
	$stat = $db->prepare("DELETE FROM messages WHERE id = :id AND user_id = :user_id");
	$stat->execute([
		'id' => $_DELETE['id'],
		'user_id' => $_SESSION['user_id']
	]);
	send_response();
} else {
	http_response_code(405);
}
