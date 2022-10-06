<?php
include('connect.php');


function myAlert($msg, $url){
    echo '<script language="javascript">alert("'.$msg.'");</script>';
    echo "<script>document.location = '$url'</script>";
}

if(isset($_POST['login'])){
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, md5(md5(md5("9".$username.$_POST['password']."9T72")."b7I9g8S3K222")."22"));   
    $query = "SELECT * FROM information WHERE username = '$username' AND password = '$password' ";
    $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) == 1) {
            session_start();
            $_SESSION['username'] = $username;
            myAlert("ยินดีต้อนรับ $username", "newindex.php");
            //header("location: newindex.php");
        } else {
            //array_push($errors, "Wrong Username or Password");
            myAlert("ชื่อหรือผู้ใช้ไม่ถูกต้อง", "login.html");
            //header("location: login.html");
        }
    } else {
        //array_push($errors, "Username & Password is required");
        myAlert("กรุณากรอกข้อมูลให้ครบถ้วน", "login.html");
        //header("location: login.html");
    }   
?>