<?php
if ($_SERVER['REQUEST_METHOD'] === 'PUT' || $_SERVER['REQUEST_METHOD'] === 'DELETE') {
	parse_str(file_get_contents('php://input'), $params);
	$GLOBALS["_{$_SERVER['REQUEST_METHOD']}"] = $params;
}
