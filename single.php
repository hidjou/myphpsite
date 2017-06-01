<?php

include("includes/config.php");
include("includes/db.php");

// If url has category, get the value of it and fetch the categoy with a matching id
if(isset($_GET['post'])){
  // $post = the value of the url var 'post'
  $post = mysqli_real_escape_string($db, $_GET['post']);
  // Fetch the array of rows that matches the query
  $posts = $db->query("SELECT * FROM posts WHERE id='$post'");
  // Since there is only one row, we wouldnt use a while loop
  $p = $posts->fetch_assoc();
  // $p is the whole row, so we bing the $page_title to the property 'title'
  $page_title = $p['title'];
}

include("includes/header.php");

// if link has 'post' in it, fetch the post that has this post's value
if(isset($_GET['post'])){
  // Assign the value of the current post to '$id'
  $id = mysqli_real_escape_string($db, $_GET['post']);
  // query this one post that has this id
  $query = "SELECT * FROM posts WHERE id='$id'";
}

// Store post in '$posts'
$posts = $db->query($query);

// If the 'Post comment' button was posted
if(isset($_POST['post_comment'])){
  $name = mysqli_real_escape_string($db, $_POST['name']);
  $comment = mysqli_real_escape_string($db, $_POST['comment']);

  if(isset($_POST['website'])){
    $website = mysqli_real_escape_string($db, $_POST['website']);
  } else {
    $website = "";
  }

  $query = "INSERT INTO comments (name, comment, post, website) VALUES('$name', '$comment', '$id', '$website')";
  $db->query($query);
  // Using header to redirect to a certain route
  // Redirect user so browser doesnt propmt them to resubmit comment
  header("Location:single.php?post=$id");
  exit();
}

$query = "SELECT * FROM comments WHERE post='$id' AND status='1'";
$comments = $db->query($query);

 ?>
    <!-- BLOG POST -->
    <div class="container">
      <?php if($posts->num_rows > 0) {
        while($row = $posts->fetch_assoc()){
        ?>
      <div class="blog-post">
        <h2 class="blog-post-title"><?php echo $row['title']; ?></h2>
        <p class="blog-post-meta"><?php echo $row['date']; ?> by <a href="about.php"><?php echo $row['author']; ?></a></p>
        <?php echo $row['body']; ?>
      </div><!-- /.blog-post -->
      <?php } } ?>
      <blockquote><?php echo $comments->num_rows ?> Comments</blockquote>
      <!-- COMMENT AREA -->
      <div class="comment-area">
        <form class="well" method="post">
          <div class="form-group col-md-6 col-sm-6">
            <label class="input-label">Name</label>
            <input type="text" name="name" class="form-control" placeholder="Name">
          </div>
          <div class="form-group col-md-6 col-sm-6">
            <label class="input-label">Website</label>
            <input type="text" name="website" class="form-control" placeholder="Website (Optional)">
          </div>
          <div class="form-group col-md-12 col-sm-12">
            <label class="input-label">Comment</label>
            <textarea rows="10" name="comment" cols="60" class="form-control" placeholder="Comment"></textarea>
          </div>
          <button type="submit" name="post_comment" class="btn btn-default btn-lg read-about-btn">Post comment</button>
        </form>
      </div>
      <!-- COMMENT AREA -->
      <br>
      <br>
      <hr>
      <!-- Comment area -->
       <?php while($comment = $comments->fetch_assoc()) {
          // If user is not an admin
          if($comment['is_admin'] != 1){
         ?>

       <div class="comment">
         <div class="comment-head">
           <a href="#"><?php echo $comment['name'] ?></a>
         </div>
         <?php echo $comment['comment'] ?>
       </div>

       <?php } else { ?>

       <div class="comment">
         <div class="comment-head">
           <a href="#"><?php echo $comment['name'] ?></a>
           <button class="btn btn-info btn-xs">Admin</button>
         </div>
         <?php echo $comment['comment'] ?>
       </div>
       <?php } } ?>
       <!-- Comment area -->
    </div>
    <!-- BLOG POST -->
    <?php
    include("includes/footer.php");
     ?>
