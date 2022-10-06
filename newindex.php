<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="styleindex.css">
    <title>Twitty</title>
</head>
<body>

<?php
    include("connect.php");
    
    session_start();
    if (!isset($_SESSION['username'])) {
        header('location: login.html');
    }
    $a;
    
    function checkURL($posttext){
	    $posttext1 = $posttext;
        $posttext = filter_var($posttext, FILTER_SANITIZE_URL);
        $i = 0;
        
	    if (filter_var($posttext, FILTER_VALIDATE_URL)) {
            $posttextp = $posttext;
            $i = 2;
	    }
        
        if(stripos($posttext, 'http') >= 0){
            $textlink = substr($posttext,stripos($posttext, 'https'));
            $rest = substr($posttext, 0, stripos($posttext, 'https'));
            //echo $rest;
            //echo '<label>'.$rest.'</label><a href="'.$textlink.'" target="_blank"> '.$textlink.' </a>';
            if (filter_var($textlink, FILTER_VALIDATE_URL)) {
                if(strlen($posttext) > 31){
                    $product_name = mb_substr($textlink, 0, 30).'...';
                    //echo '<a href="'.$posttextp.'" target="_blank"> '.$product_name.' </a>';
                    echo '<label>'.$rest.'</label><a href="'.$textlink.'" target="_blank"> '.$product_name.' </a>';
    
                }else{
                    //echo '<a href="'.$posttextp.'" target="_blank"> '.$posttextp.' </a>';
                    echo '<label>'.$rest.'</label><a href="'.$textlink.'" target="_blank"> '.$textlink.' </a>';
                }
                //echo '<label>'.$rest.'</label><a href="'.$textlink.'" target="_blank"> '.$textlink.' </a>';
            }else{
                echo $posttext;
            }
        }elseif(stripos($posttext, 'https') >= 0){
            $textlink = substr($posttext,stripos($posttext, 'https'));
            $rest = substr($posttext, 0, stripos($posttext, 'https'));
            if (filter_var($textlink, FILTER_VALIDATE_URL)) {
                if(strlen($posttext) > 31){
                    $product_name = mb_substr($textlink, 0, 30).'...';
                    //echo '<a href="'.$posttextp.'" target="_blank"> '.$product_name.' </a>';
                    echo '<label>'.$rest.'</label><a href="'.$textlink.'" target="_blank"> '.$product_name.' </a>';
    
                }else{
                    //echo '<a href="'.$posttextp.'" target="_blank"> '.$posttextp.' </a>';
                    echo '<label>'.$rest.'</label><a href="'.$textlink.'" target="_blank"> '.$textlink.' </a>';
                }
                //echo '<label>'.$rest.'</label><a href="'.$textlink.'" target="_blank"> '.$textlink.' </a>';
            }else{
                echo $posttext;
            }
        }
        
        

        if(stripos($posttext, 'www.') === 0){
            $posttextp = "http://".$posttext;
            $i = 1;
        }              
        /*
        if($i == 1){
            if(strlen($posttext) > 31){
                $product_name = mb_substr($textlink, 0, 30).'...';
                //echo '<a href="'.$posttextp.'" target="_blank"> '.$product_name.' </a>';
                echo '<label>'.$rest.'</label><a href="'.$textlink.'" target="_blank"> '.$product_name.' </a>';

            }else{
                //echo '<a href="'.$posttextp.'" target="_blank"> '.$posttextp.' </a>';
                echo '<label>'.$rest.'</label><a href="'.$textlink.'" target="_blank"> '.$textlink.' </a>';

		    }
        }elseif($i == 2){
            if(strlen($posttext) > 31){
                $product_name = mb_substr($posttext, 0, 30).'...';
                echo '<a href="'.$posttextp.'" target="_blank"> '.$product_name.' </a>';

            }else{
                echo '<a href="'.$posttextp.'" target="_blank"> '.$posttextp.' </a>';;

		    }
        }
        else{
            echo("$posttext1");
        }*/
    }

    function psotimguser($user,$con){
        $sql1 = "SELECT image FROM information WHERE Username = '$user'";

        $result = mysqli_query($con, $sql1);
        $img = mysqli_fetch_assoc($result);

        if($img == null){
            return "nope.png";
        }else{
            return $img['image'];
        }   
    }

    

?>

    <div>
        <h2>
           Twitty
        </h2>
    </div>

    <div>
        <table class="center">
            <tr>
                <th><label>Shere your story for today</label><br>
                    <form method="post" action="save.php">
                        <input type="text" id="lname" name="textpost">
                        <input type="submit" class="button" name="submit" value="Post">
                    </form>
                </th>
                <th>
                    <form method="post" action="logout.php">
                        <input type="submit" name="logout" value="logout">
                    </form>
                </th>
            </tr>
        </table><br>
    </div>       


    <?php   
    $sql = "SELECT * FROM `dataposts` ORDER BY `dataposts`.`timeposts` DESC ";
    $result = mysqli_query($conn, $sql); //ดึงข้อมูล
    
    //สร้างตาราง
    if (mysqli_num_rows($result) > 0) {
      // output data of each row
    ?>

          
    <div>
        <table class="center">
            <tr>
                <th>PostTwitty</th>
            </tr>
            <?php
                while ($row = mysqli_fetch_assoc($result)) {      
            ?>      
            <tr>
                <td> 
                    <img src="image/<?php echo psotimguser($row['usernames'],$conn) ?>" height="30" width="30" >
                    <p style="font-size:18px;"><?php checkURL($row['userposts']);  ?></p>
                    <p style="font-size:14px;"><br><?php  echo $row['usernames'];//"Peter" ?><br><?php echo $row['timeposts'] ?></p>
                </td>
            </tr>
                    <?php                       
                } //end ดึงข้อมูลและสร้างตาราง
                    ?>
        </table>
    </div>

    <?php
    } else {
      echo "0 results";
    }
    $conn->close();
    ?>  

</body>
</html>