<?php
require('connect.php');

function checkuser($user,$con){
    $query = "SELECT * FROM information WHERE username = '$user' ";
    $result = mysqli_query($con, $query);
    $check = mysqli_fetch_assoc($result);

    return $check;
}

function myAlert($msg, $url){
    echo '<script language="javascript">alert("'.$msg.'");</script>';
    echo "<script>document.location = '$url'</script>";
}

    if(isset($_POST['S_login'])) {
        $S_username = $_POST['S_username'];    
        $S_password  = $_POST['S_password'];
        $S_pc = $_POST['S_pc'];
        $S_Email = $_POST['S_Email'];
        
        if(checkuser($S_username,$conn) == null){
            //session_start();
            if($S_password == $S_pc){
            
                $filename =  md5($_FILES['S_file']['name'].$S_username);
                $ext = explode('.',$_FILES['S_file']['name']);
                //$dest =  __DIR__.DIRECTORY_SEPARATOR.'image'.DIRECTORY_SEPARATOR.$filename.'.'.$ext[1];
                $S_imageup = $filename.'.'.$ext[1];

                $path_copy="image/".$S_imageup;
                move_uploaded_file($_FILES['S_file']['tmp_name'],$path_copy);

                $Salt = md5(md5(md5("9".$S_username.$S_password."9T72")."b7I9g8S3K222")."22");
                $sqlsub = "INSERT INTO information(Username,password,Email,image)
                VALUES ('$S_username', '$Salt','$S_Email','$S_imageup')";
            
            if ($conn->query($sqlsub) === false) {
                myAlert("Error: " . $sql . "<br>" . $conn->error, "signup.html");
            }else{
                myAlert("ลงทะเบียนเสร็จสิ้น กรุณาล็อกอินเพื่อใช้งานเว็บของเรา", "login.html");
            }

        }else{
            myAlert("กรุณากรอกรหัสผ่านให้ตรง", "signup.html");
        }
    }else{
        myAlert("มีชื่อผู้ใช้ในระบบแล้ว", "signup.html");
    }    
}
?>