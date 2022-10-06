<?php
require('connect.php');

function myAlert($msg, $url){
    echo '<script language="javascript">alert("'.$msg.'");</script>';
    echo "<script>document.location = '$url'</script>";
}

date_default_timezone_set("Asia/Bangkok");
    $timenow = date("Y-m-d",time()) . "_" . date("H:i:s",time());
    //start เซฟลง MySQL
    if(isset($_POST['submit'])) {
        if(!empty($_POST["textpost"])){
        session_start();
        $us = $_SESSION['username'];    
        $userpost = $_POST['textpost'];
        $sqlsub = "INSERT INTO dataposts (userposts, timeposts,usernames)
        VALUES ('$userpost', '$timenow','$us')";
        
        if ($conn->query($sqlsub) === false) {
            myAlert("Error: " . $sql . "<br>" . $conn->error, "newindex.php");
        }
        header("location: newindex.php");

    }else{
        
        header("location: newindex.php");
    }
}
?>