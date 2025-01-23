<?php
session_start();

require_once "connection.php";

if(isset($_POST['login']) && $_SERVER['REQUEST_METHOD'] === 'POST'){
               
    $email = $_POST['email'];
    $password = $_POST['password'];

        $sql = "SELECT * FROM `users` WHERE `Email_Address`='$email'";

        $query = mysqli_query($conn,$sql);

        if(mysqli_num_rows($query) > 0){
            $row = mysqli_fetch_assoc($query);

            $_SESSION['type'] = $row['User_Type'];
            $_SESSION['uid'] = $row['User_ID'];
            $pass = $row['Password'];
            $type = $row['User_Type'];
            $uid = $row['User_ID'];

        if(md5($password) == $pass){

               if ($type == "Administrator") {
                $_SESSION['adminname'] = $uid;
                header("Location: ../index.php");
                }else if ($type == "Charity Owner") {

                $_SESSION['charname'] = $uid;   

                header("Location: ../index1.php");
                }else if ($type == "Delivery Driver") {

                $_SESSION['ddname'] = $uid;   

                header("Location: ../index2.php");
                }else if ($type == "Donor") {

                $_SESSION['username'] = $uid;   

                header("Location: ../index3.php");
                }
}else{
    echo "Error Occured: Passwords do not match.";
}
}else{
    echo "Error Occured: User not found.";
}
}
?>