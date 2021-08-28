<?php

include "config.php";
session_start();
if(!isset($_SESSION['loggedin']) && $_SESSION['loggedin']==false){
  header('location:login.php');
}
$presentationId=$_GET['presId'];

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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  </head>
  <body>

<?php  include 'header.php'?>

<?php $sql2="Select * from slides where presentation_id='$presentationId'";
   $result2=mysqli_query($conn,$sql2);
   $no=1;
   while($rows=mysqli_fetch_assoc($result2)){
       echo '<a href="slide.php?id='.$rows['id'].'&presId='.$presentationId.'">Go to page'.$no.'<br></a>';
       $no++;
   }
 ?>
 <div class="container5">
    <?php echo'<a href="presentation.php?id='.$presentationId.'">Back to Presentation</a>';
    ?>
 </div>
 <div class="container4">
   <form action="" class="form">
      <button type="button" data-cmd="justifyLeft">
        <i class="fa fa-align-left" aria-hidden="true"></i>
      </button>
      <button type="button" data-cmd="justifyCenter">
        <i class="fa fa-align-center" aria-hidden="true"></i>
      </button>
      <button type="button" data-cmd="justifyRight">
        <i class="fa fa-align-right" aria-hidden="true"></i>
      </button>
      <button type="button" data-cmd="bold">
        <i class="fa fa-bold" aria-hidden="true"></i>
      </button>
      <button type="button" data-cmd="insertOrderedList">
        <i class="fa fa-list-ol" aria-hidden="true"></i>
      </button>
      <button type="button" data-cmd="insertUnorderedList">
        <i class="fa fa-list-ul" aria-hidden="true"></i>
      </button>
      <button type="button" data-cmd="insertImage" style="height:20px">
        <i class="fa fa-file-image-o" aria-hidden="true">Image</i>
      </button>
      <button type="button" data-cmd="createLink">
        <i class="fa fa-link" aria-hidden="true"></i>
      </button>
      <button type="button" data-cmd="Underline">
        <i class="fa fa-underline" aria-hidden="true"></i>
      </button>
      <button type="button" data-cmd="Italic">
        <i class="fa fa-italic" aria-hidden="true"></i>
      </button>
      <button type="button" data-cmd="showCode"  name="active" >
        <i class="fa fa-code" aria-hidden="true"></i>
      </button> 
    
   </form>
   <iframe id="frame" name="textEditor" style="border:2px solid black;width:600px;height:350px"></iframe>
   </div>
<script>
    const button=document.querySelectorAll('button');
     textEditor.document.designMode="On";
     let show=false;
     for(var i=0;i<button.length;i++){
         button[i].addEventListener('click',function(){
            let cmd=this.getAttribute('data-cmd');
         if(this.name=="active"){
            this.classList.toggle("active");
         }
 
         if(cmd=="insertImage" || cmd=="createLink"){
             let url=prompt("Enter url link of image:","");
             textEditor.document.execCommand(cmd,false,url);
             if(cmd=="insertImage"){
                 const imgs=document.querySelectorAll('img');
                 imgs.forEach(function(image){
                     image.style.maxWidth="500px";
                 });
             }else{
                 if(cmd=="createLink"){
                     const links=document.querySelectorAll('a');
                     links.forEach(function(item){
                         item.target="_blank";
                         item.addEventListener("mouseover",function(){
                             textEditor.document.designMode="Off";
                         });
                         item.addEventListener("mouseout",function(){
                             textEditor.document.designMode="On";
                         });
                     });
                 }
             }
         }else{
             textEditor.document.execCommand(cmd,false,null);
         }
        if(cmd=="showCode"){
            const textBody=textEditor.document.querySelector('body');
            if(show){
                textBody.innerHTML=textBody.textContent;
                show=false;
            }else{
                textBody.textContent=textBody.innerHTML;
                show=true;
            }
        }
     
         });
       
     }
    </script>

    </body>
    </html>