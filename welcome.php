<?php
include "config.php";
session_start();
if(!isset($_SESSION['loggedin'])){
  header('location:login.php');
}
$username=$_SESSION['username'];
if($_SERVER['REQUEST_METHOD']=='POST'){
    $presName=$_POST['pres_name'];
   
    $sql="Select * from presentation where presentation_name='$presName' and username='$username'";
    $result=mysqli_query($conn,$sql);
    if(mysqli_num_rows($result)>0){
        echo "This presentation already exists ";
    }else{
        $sql1="INSERT INTO `presentation` ( `username`, `presentation_name`, `time`) VALUES ( '$username', '$presName', current_timestamp())";
        $result1=mysqli_query($conn,$sql1);
        $sql2="Select * from presentation where presentation_name='$presName'";
        $result2=mysqli_query($conn,$sql2);
        $rows=mysqli_fetch_assoc($result2);
        header('location:presentation.php?id='.$rows['id']);
    }
}
?>


<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" media="screen and (max-width:690px)" href="phone.css">
    <title>Hello, world!</title>
  </head>
  <body>

<?php  include 'header.php'?>

    <h1>Start a new presentation</h1>
    <form action="" method="post">
      <div class="mb3">
        <label for="pres_name" class="form-label">Enter your presentation name:</label>
        <input type="text" name="pres_name" id="" class="form-control">
        <input type="submit" value="Submit" class="btn-primary">
    </form>
    </div>
<?php

$sql= "Select * from `presentation` where username='$username'";
$result=mysqli_query($conn,$sql);
echo ' <h2 style="margin-bottom:0;">Your presentations:</h2><div class=container2>';
while($rows=mysqli_fetch_assoc($result)){
 
  echo'
    <div class="container3">
     
    <h2 class="card-title">'.$rows['presentation_name'].'</h2>
    <a href="presentation.php?id='.$rows['id'].'"class="btn-primary">Go to presentation</a>
  </div>
';
}
echo '</div>';
?>
</body>
</html>