<?php

$query = "SELECT * FROM categories";
$categories = $db->query($query);

 ?>

 <!doctype html>
 <html>
 <head>
   <meta charset="utf-8">
   <meta http-equiv="X-UA-Compatible" content="">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <title><?php echo $page_title ?></title>

   <link href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet">
   <link rel="stylesheet" href="css/font-awesome.css">
   <link rel="stylesheet" href="css/bootstrap.css">
   <link rel="stylesheet" href="css/styles.css">

 </head>
 <body>
   <!-- NAVBAR -->
   <nav class="navbar navbar-default">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="index.php">Ahmed Hadjou</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav navbar-right">

            <?php if(isset($_GET['category']) || strpos($_SERVER['REQUEST_URI'], "index.php") === false){ ?>
            <li><a href="index.php">Home</a></li>
            <?php } else { ?>
            <li class="active"><a href="index.php">Home</a></li>
            <?php } ?>
            <!-- Iterate through categoies and add a navbar link for each (currently two: Blog and Projects) -->
            <?php if($categories->num_rows > 0) {
              while($row = $categories->fetch_assoc()){
                if(isset($_GET['category']) && $row['id'] == $_GET['category']){ ?>
            <li class="active"><a href="index.php?category=<?php echo $row['id']; ?>"><?php echo $row['text']; ?></a></li>
            <?php } else echo "<li><a href='index.php?category=$row[id]'>$row[text]</a></li>";
            } } ?>
            <!-- 'About' page link -->
            <?php if(strpos($_SERVER['REQUEST_URI'], "about.php") === false){ ?>
            <li><a href="about.php">About</a></li>
            <?php } else { ?>
            <li class="active"><a href="about.php">About</a></li>
            <?php } ?>
            <!-- 'Contact' page link -->
            <?php if(strpos($_SERVER['REQUEST_URI'], "contact.php") === false){ ?>
            <li><a href="contact.php">Contact</a></li>
            <?php } else { ?>
            <li class="active"><a href="contact.php">Contact</a></li>
            <?php } ?>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>
    <!-- NAVBAR -->
