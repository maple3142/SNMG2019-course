<?php 

session_start();
include_once("conn.php");

if(isset($_POST['Logout'])&&$_POST['Logout']==="Logout")
$_SESSION['login'] = false;

if(isset($_POST['Name']) && isset($_POST['Password'])){
    $username = $_POST['Name'];
    $password = $_POST['Password'];
    $sql = "SELECT * from users where username = '$username' and password = '$password'";
    $result = $db->query($sql)->fetchAll();
    if($result){
        $_SESSION['login'] = true;
        $_SESSION['username'] = $username;
        // print_r($result);
    }else{
        $_SESSION['login'] = false;
        // echo "<h3>登入失敗</h3> <br>";
    }
}
header("location: index.php");
?>