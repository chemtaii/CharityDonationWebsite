<?php 
 
require 'connection.php';

session_start();

//Register User
if (isset($_POST['regu'])) {
 $fname = $_POST['fname'];
 $email = $_POST['email'];
 $type = $_POST['type'];
 $phone = $_POST['phone'];
 $password = $_POST['password'];
 $passwordconfirm = $_POST['cpassword'];

 if ($password == $passwordconfirm) {

    $filename = $_FILES['image']['name'];

$valid_extensions = array("jpg","jpeg","png");

$extension = pathinfo($filename, PATHINFO_EXTENSION);

if((in_array(strtolower($extension),$valid_extensions))) {

if((move_uploaded_file($_FILES['image']['tmp_name'], "../img/".$filename))){

  $sql = "INSERT INTO `users`(`Fullname`, `Phone_Number`, `Email_Address`,`User_Type`, `Password`, `Profile_Picture`) VALUES ('$fname','$phone','$email','$type',md5('$password'), '$filename')";
     mysqli_query($conn, $sql);
     if(isset($_SESSION['adminname'])){
  header("Location: ../index.php?userregistration=success");
}else{
  header("Location: ../index.html?userregistration=success");
}
 }else{
  echo "An Error Occured: Image directory not found.";
}
}else{
  echo "An Error Occured: Kindly check the image format, current format is not accepted.";
} 

}else{
  echo "Passwords do not match.";
 }
}

//Update User
if (isset($_POST['upu'])) {
 $uid = $_POST['uid'];
 $fname = $_POST['fname'];
 $email = $_POST['email'];
 $password = $_POST['password'];
 $passwordconfirm = $_POST['cpassword'];
 $phone = $_POST['phone'];
 $mod = $_POST['mod'];

 if ($password == $passwordconfirm) {

$filename = $_FILES['image']['name'];

$valid_extensions = array("jpg","jpeg","png");

$extension = pathinfo($filename, PATHINFO_EXTENSION);

if((in_array(strtolower($extension),$valid_extensions))) {

if((move_uploaded_file($_FILES['image']['tmp_name'], "../img/".$filename))){

  if (isset($_SESSION['adminname'])) {
  $sql = "UPDATE `users` SET `Fullname`='$fname',`Email_Address`='$email',`Phone_Number`='$phone',`Password`=md5('$password'), `Profile_Picture` = '$filename' WHERE `User_ID`='$uid'";
     mysqli_query($conn, $sql);
  header("Location: ../index.php?updateadministrator=success");
  }else if (isset($_SESSION['charname'])) {
  $sql = "UPDATE `users` SET `Fullname`='$fname',`Email_Address`='$email',`Phone_Number`='$phone',`Password`=md5('$password'), `Profile_Picture` = '$filename' WHERE `User_ID`='$uid'";
     mysqli_query($conn, $sql);
  header("Location: ../index1.php?updatecharity=success");
  }else if (isset($_SESSION['ddname'])) {
  $sql = "UPDATE `users` SET `Fullname`='$fname',`Email_Address`='$email',`Phone_Number`='$phone',`Password`=md5('$password'), `Profile_Picture` = '$filename' WHERE `User_ID`='$uid'";
     mysqli_query($conn, $sql);
  header("Location: ../index2.php?updatedeliverydriver=success");
  }else if (isset($_SESSION['donname'])) {
  $sql = "UPDATE `users` SET `Fullname`='$fname',`Email_Address`='$email',`Phone_Number`='$phone',`Password`=md5('$password'), `Profile_Picture` = '$filename' WHERE `User_ID`='$uid'";
     mysqli_query($conn, $sql);
  header("Location: ../index1.php?updatedonor=success");
  }else{
    header("Location: ../index.html");
  }

 }else{
  echo "An Error Occured: Image directory not found.";
}
}else{
  echo "An Error Occured: Kindly check the image format, current format is not accepted.";
} 

 }else{
  echo "Passwords do not match.";
 }
}

//Delete A User
if($_REQUEST['action'] == 'deleteU' && !empty($_REQUEST['id'])){ 
$deleteItem = $_REQUEST['id'];
$sql = "DELETE FROM `users` WHERE `User_ID` = '$deleteItem'";
mysqli_query($conn, $sql); 
$sql1 = "DELETE FROM `charities` WHERE `User_ID` = '$deleteItem'";
mysqli_query($conn, $sql1); 
$sql2 = "DELETE FROM `donations` WHERE `User_ID` = '$deleteItem'";
mysqli_query($conn, $sql2); 
header("Location: ../index.php?deleteuser=success");
}

//Make A Donation
if (isset($_POST['makeD'])) {
    $uid = $_SESSION['username'];
    $cid = $_SESSION['view_c'];
    $desc = $_POST['desc'];
    $type = $_POST['type'];
    $quan = $_POST['quan'];

$filename = $_FILES['image']['name'];

$valid_extensions = array("jpg","jpeg","png");

$extension = pathinfo($filename, PATHINFO_EXTENSION);

if((in_array(strtolower($extension),$valid_extensions))) {

if((move_uploaded_file($_FILES['image']['tmp_name'], "../img/".$filename))){
    
$sql = "INSERT INTO `donations`(`Description`, `Type`, `Image`, `User_ID`, `Quantity`, `Status`, `Driver_ID`, `Charity_ID`) VALUES ('$desc','$type','$filename','$uid','$quan','Active','0','$cid')";

  mysqli_query($conn, $sql);

  header("Location: ../index3.php?makeadonation=success");
 }else{
  echo "An Error Occured: Image directory not found.";
}
}else{
  echo "An Error Occured: Kindly check the image format, current format is not accepted.";
} 
}

//Delete A Donation 
if($_REQUEST['action'] == 'deleteD' && !empty($_REQUEST['id'])){ 
$deleteItem = $_REQUEST['id'];
$sql = "DELETE FROM `donations` WHERE `Donation_ID` = '$deleteItem'";
mysqli_query($conn, $sql);
header("Location: ../index3.php?deleteadonation=success");
}

//Cancel A Donation 
if($_REQUEST['action'] == 'cancelD' && !empty($_REQUEST['id'])){ 
$deleteItem = $_REQUEST['id'];
$sql = "UPDATE `donations` SET `Status` = 'Cancelled' WHERE `Donation_ID` = '$deleteItem'";
mysqli_query($conn, $sql); 
header("Location: ../index3.php?canceladonation=success");
}

//Accept A Donation 
if($_REQUEST['action'] == 'acceptD' && !empty($_REQUEST['id'])){ 
$deleteItem = $_REQUEST['id'];
$uid = $_SESSION['ddname'];
$sql = "UPDATE `donations` SET `Status` = 'Accepted', `Driver_ID` = '$uid' WHERE `Donation_ID` = '$deleteItem'";
mysqli_query($conn, $sql); 
header("Location: ../index2.php?acceptadonation=success");
}

//Deny A Donation 
if($_REQUEST['action'] == 'denyD' && !empty($_REQUEST['id'])){ 
$deleteItem = $_REQUEST['id'];
$uid = $_SESSION['ddname'];
$sql = "UPDATE `donations` SET `Status` = 'Denied', `Driver_ID` = '$uid' WHERE `Donation_ID` = '$deleteItem'";
mysqli_query($conn, $sql); 
header("Location: ../index2.php?denyadonation=success");
}

//Complete A Donation 
if($_REQUEST['action'] == 'completeD' && !empty($_REQUEST['id'])){ 
$deleteItem = $_REQUEST['id'];
$sql = "UPDATE `donations` SET `Status` = 'Completed' WHERE `Donation_ID` = '$deleteItem'";
mysqli_query($conn, $sql); 
header("Location: ../index1.php?completeadonation=success");
}

//Add A Charity Center
if(isset($_POST["addC"])){

    $cname = $_POST['cname'];
    $desc = $_POST['desc'];
    $loc = $_POST['loc'];
    $lat = $_POST['lat'];
    $long = $_POST['long'];
    $uid = $_SESSION['charname'];

$filename = $_FILES['image']['name'];

$valid_extensions = array("jpg","jpeg","png");

$extension = pathinfo($filename, PATHINFO_EXTENSION);

if((in_array(strtolower($extension),$valid_extensions))) {

if((move_uploaded_file($_FILES['image']['tmp_name'], "../img/".$filename))){

  $sql = "INSERT INTO `charities`(`User_ID`, `Location`, `Long`, `Lat`, `Name`, `Description`, `Image`) VALUES ('$uid','$loc','$long','$lat','$cname','$desc','$filename')";

   mysqli_query($conn, $sql);
  // var_dump($sql);

   header("Location: ../index1.php?addacharitycenter=success");

 }else{
  echo "An Error Occured: Image directory not found.";
}
}else{
  echo "An Error Occured: Kindly check the image format, current format is not accepted.";
} 
 }

//Delete A Charity Center 
if($_REQUEST['action'] == 'deleteC' && !empty($_REQUEST['id'])){ 
$deleteItem = $_REQUEST['id'];
$sql = "DELETE FROM `charities` WHERE `Charity_ID` = '$deleteItem'";
mysqli_query($conn, $sql);
$sql2 = "DELETE FROM `donations` WHERE `Charity_ID` = '$deleteItem'";
mysqli_query($conn, $sql2); 
header("Location: ../index1.php?deleteacharitycenter=success");
}

//View A Charity Center 
if($_REQUEST['action'] == 'viewC' && !empty($_REQUEST['id'])){ 
$viewItem = $_REQUEST['id'];
$_SESSION['view_c'] = $viewItem;
header("Location: ../donation_info.php?viewdonationinfo=success");
}

//Send A Message
if(isset($_POST["sendM"])){

    $mes = $_POST['mes'];
    $did = $_POST['did'];

  $sql = "UPDATE `donations` SET `Message` = '$mes' WHERE `Donation_ID` = '$did'";

   mysqli_query($conn, $sql);

  header("Location: ../index1.php?sendmessage=success"); 
 }

?>