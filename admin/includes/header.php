<?php

session_start();

if(!isset($_SESSION['username'])){
  header("Location:signin.php?err_msg=You need to login to access this page");
  exit();
}

 ?>

 <!DOCTYPE html>
 <html lang="en">
   <head>
     <meta charset="utf-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <meta name="viewport" content="width=device-width, initial-scale=1">

     <script src="https://cloud.tinymce.com/stable/tinymce.min.js"></script>
     <script>tinymce.init({ selector:'textarea' });</script>

     <title>Dashboard</title>

     <!-- Bootstrap core CSS -->
     <link href="css/bootstrap.css" rel="stylesheet">

     <!-- Custom styles for this template -->
     <link href="css/dashboard.css" rel="stylesheet">
   </head>

   <body>

     <nav class="navbar navbar-inverse navbar-fixed-top">
       <div class="container-fluid">
         <div class="navbar-header">
           <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
             <span class="sr-only">Toggle navigation</span>
             <span class="icon-bar"></span>
             <span class="icon-bar"></span>
             <span class="icon-bar"></span>
           </button>
           <a class="navbar-brand" href="index.php">BlogCMS</a>
         </div>
         <div id="navbar" class="navbar-collapse collapse">
           <ul class="nav navbar-nav navbar-right">
             <li><a href="index.php">Dashboard</a></li>
             <li><a href="logout.php">Logout</a></li>
           </ul>
         </div>
       </div>
     </nav>
