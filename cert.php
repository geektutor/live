<?php include('./config/connect.php'); 
    if (isset($_POST['submit'])) {
        $first = mysqli_real_escape_string($conn, $_POST['first']);
        $last = mysqli_real_escape_string($conn, $_POST['last']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $sqlEmail = "SELECT * FROM certificate WHERE `email` = '$email' AND certified = '0'";
        $result = mysqli_query($conn,$sqlEmail);
        $countEmail = mysqli_num_rows($result);
        if ($countEmail > 0) {
            $sql = "UPDATE certificate SET `certified` = '1' WHERE `email` = '$email'";
            if($conn->query($sql)){
                $sentence = "http://thenextconf.pythonanywhere.com/generate/?first_name={$first}&last_name={$last}";
                $stripped = str_replace(' ', '', $sentence);
                header("location:.$stripped.");
            }else{
                die('could not enter data: '. $conn->error);
            }
        }else{
            header("location:in/index.html");
        }
    }
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Next Conference - LIVE</title>
    <link rel="icon" href="img/logo.png" sizes="16*16">
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro&display=swap" rel="stylesheet">
</head>
<body> 
    
    <div class="box">
            <p class="signin">The Next Conference</p>
            <form method="POST">
            
            <input name="first" type="text" placeholder="Enter Your First Name">
            <br/>
            <input name="last" type="text" placeholder="Enter Your Last Name">
            <br/>
            <input name="email" type="email" placeholder="Enter Your Email" >
            
            <button type="submit" name="submit">Generate Certificate</button>
        </form>                                                                                                                                           
    </div>

</body>
</html>
