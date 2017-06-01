<?php
include("includes/config.php");
include("includes/db.php");

// If url has category, get the value of it and fetch the categoy with a matching id
if(isset($_GET['category'])){
  // $category = the value of the url var 'category'
  $category = mysqli_real_escape_string($db, $_GET['category']);
  // Fetch the array of rows that matches the query
  $cats = $db->query("SELECT * FROM categories WHERE id='$category'");
  // Since there is only one row, we wouldnt use a while loop
  $c = $cats->fetch_assoc();
  // $c is the whole row, so we bing the $page_title to the property 'text'
  $page_title = "Ahmed Hadjou | " . $c['text'];
}

include("includes/header.php");

if(isset($_GET['category'])){
  $category = mysqli_real_escape_string($db, $_GET['category']);
  $query = "SELECT * FROM posts WHERE category='$category' ORDER BY id DESC";
} else {
  $query = "SELECT * FROM posts WHERE category='1' ORDER BY id DESC";
}

$posts = $db->query($query);
 ?>
    <!-- HOME -->
    <!-- if link doesnt have category in it render the home component -->
    <?php if(!isset($_GET['category'])){ ?>
      <section id="showcase">
        <div class="container">
          <div class="row">
            <div class="col-md-6 col-sm-6 showcase-left">
              <div>
                <img class="profile-picture" src="assets/profilePicture.png" alt="">
              </div>
            </div>
            <div class="col-md-6 col-sm-6 showcase-right">
              <div>
                <h1>Web Designer / Developer</h1>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Facilis repudiandae iure ipsa quidem nemo laborum dolor placeat, vel, maiores consequatur accusamus! Dolorum velit ipsum esse, inventore, autem vitae alias optio.</p>
              </div>
              <!--"Read about me" button-->
              <a href="about.php" class="btn btn-default btn-lg read-about-btn">Read about me</a>
            </div>
          </div>
        </div>
      </section>
      <section id="quote">
        <div class="container">
          <p>"Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusamus fugiat debitis porro sint eos, eveniet, repudiandae! Cupiditate accusamus ab enim excepturi maiores ex ipsa, consequatur nemo totam hic, sint aut!"</p>
          <p class="customer">- Ahmed Hadjou</p>
        </div>
      </section>
    <?php } ?>
    <!-- HOME -->
    <!-- BLOG POSTS -->
    <div class="container">
      <?php if($posts->num_rows > 0) {
        while($row = $posts->fetch_assoc()){
        ?>
      <div class="blog-post">
        <!--Post title-->
        <h2 class="blog-post-title"><a href="single.php?post=<?php echo $row['id'] ?>"><?php echo $row['title']; ?></a></h2>
        <!--Author name and date published-->
        <!--Author name commented (since there is only one author for now)-->
        <p class="blog-post-meta"><?php echo $row['date']; ?> <!-- by <a href="about.php"><?php echo $row['author']; ?></a> --></p>
        <!--Post body text-->
        <p class="blog-post-body">
          <?php $body = $row['body'];
          // Only show 400 chars of the post
          // echo substr(strip_tags($body), 0, 400) . " . . .";
          echo substr(strip_tags($body), 0, 400) . " . . .";
          ?>
          <a href="single.php?post=<?php echo $row['id'] ?>" class="fa fa-long-arrow-right read-more-icon"></a>
        </p>
        <hr class="horizontal-ruler">
      </div><!-- /.blog-post -->
      <?php } } ?>
    </div>
    <!-- BLOG POSTS -->
    <?php
    include("includes/footer.php");
     ?>
