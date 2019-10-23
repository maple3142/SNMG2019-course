<?php 

session_start();
include_once("conn.php");

if(isset($_POST['Content'])){
    $username = $_SESSION['username'];
    $content = $_POST['Content'];
    $sql = "INSERT INTO messages (username, content) VALUES ('$username', '$content')";
    $db->exec($sql);
}
?>