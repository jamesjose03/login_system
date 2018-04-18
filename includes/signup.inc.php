<?php


if(isset($_POST['submit'])){

    include_once 'dbh.inc.php';

    $first = mysqli_real_escape_string($conn, $_POST['user_first']);
    $last = mysqli_real_escape_string($conn, $_POST['user_last']);
    $email = mysqli_real_escape_string($conn, $_POST['user_email']);
    $uid = mysqli_real_escape_string($conn, $_POST['user_username']);
    $pwd = mysqli_real_escape_string($conn, $_POST['user_password']);


    if(empty($first) || empty($last) || empty($email) || empty($uid) || empty($pwd)){
        header("Location: ../signup.php?signup=empty");
        exit();
    }
    else{
        //Check if input characters are valid or not
        if(!preg_match("/^[a-zA-Z]*$/",$first) || !preg_match("/^[a-zA-Z]*$/",$last)){
            header("Location: ../signup.php?signup=invalid");
            exit();   
        } else{
            //Email Validation
            if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                header("Location: ../signup.php?signup=email");
                exit();
            }else{
                $sql = "SELECT * FROM users WHERE user_username='$uid'";
                $result = mysqli_query($conn, $sql);
                $resultCheck = mysqli_num_rows($result);

                if($resultCheck>0){
                    header("Location: ../signup.php?signup=usertaken");
                    exit();
                }
                else{
                    //Password Hashing
                    $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);
                    //Insert the user into the db
                    $sql = "INSERT INTO users (user_first, user_last, user_email, user_username, user_password) VALUES ('$first','$last','$email','$uid','$hashedPwd');";
                    mysqli_query($conn, $sql);
                    header("Location: ../signup.php?signup=success");
                    exit();
                }

            }
        }
    }

}
else{
    header("Location: ../signup.php");
    exit();
}