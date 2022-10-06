<?php

session_start();

function myAlert($msg, $url){
    echo '<script language="javascript">alert("'.$msg.'");</script>';
    echo "<script>document.location = '$url'</script>";
}

$d = $_SESSION['username'];
session_destroy();
unset($_SESSION['username']);
myAlert("ฝันดีนะคุณ $d", "login.html");

?>