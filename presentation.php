<?php
include "config.php";
session_start();
if(!isset($_SESSION['loggedin']) && $_SESSION['loggedin']==false){
  header('location:login.php');
}
$presentationId=$_GET['id'];
if(isset($_POST['create'])){
   $sql="INSERT INTO `slides` ( `presentation_id`, `content`) VALUES ( '$presentationId', '')";
   $result=mysqli_query($conn,$sql);
   
}
else if(isset($_POST['delete'])){
  $sql3="DELETE FROM `presentation` WHERE `presentation`.`id` = $presentationId";
  $result3=mysqli_query($conn,$sql3);
  header('location:welcome.php');
}
?>

<body>
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

 <form action="" method="post">
   <button type="submit" name="create" class="btn-primary">Create Slide</button>
 </form>

<?php $sql2="Select * from slides where presentation_id='$presentationId'";
   $result2=mysqli_query($conn,$sql2);
   $no=1;
   while($rows=mysqli_fetch_assoc($result2)){
       echo '<a href="slide.php?id='.$rows['id'].'&presId='.$presentationId.'">Go to page'.$no.'<br></a>';
       $no++;
   }
   ?>
   <form action="" method="post">
     <button type="submit" name="delete" class="btn-primary">Delete Presentation</button>
   </form>
</body>
</html>