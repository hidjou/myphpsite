<?php
include("includes/config.php");
include("includes/db.php");
include("includes/header.php");
include("includes/sidebar.php");

if(isset($_POST['add_post'])){
  $title = mysqli_real_escape_string($db, $_POST['title']);
  $author = mysqli_real_escape_string($db, $_POST['author']);
  $category = mysqli_real_escape_string($db, $_POST['category']);
  $body = mysqli_real_escape_string($db, $_POST['body']);
  $keywords = mysqli_real_escape_string($db, $_POST['keywords']);

  // If url includes an id, UPDATE post with that id
  if(isset($_POST['id'])){
    $id = mysqli_real_escape_string($db, $_POST['id']);
    $query = "UPDATE posts SET title='$title', author='$author', category='$category', body='$body', keywords='$keywords' WHERE id='$id'";
  } else {
  // Else INSERT a new post
    $d = getdate();
    $date = "$d[month] $d[mday], $d[year]";
    $query = "INSERT INTO posts (title, author, category, body, keywords, date)
    VALUES ('$title','$author','$category','$body','$keywords','$date')";
  }

  $db->query($query);
}

// If uel has "post" in it, fetch that post and assign it to '$p'
if(isset($_GET['post'])){
  $id = mysqli_real_escape_string($db, $_GET['post']);
  $p = $db->query("SELECT * FROM posts WHERE id='$id'");
  $p = $p->fetch_assoc();
}

$categories = $db->query("SELECT * FROM categories");

 ?>


           <h1 class="page-header">Add new post</h1>
           <div class="table-responsive">
             <form method="post">
               <!-- If $p exists -->
               <?php if(isset($p)){
                 echo "<input type='hidden' value='$id' name='id' />";
               } ?>
               <div class="form-group">
                 <label>Post title: </label>
                 <input class="form-control" type="text" value="<?php echo @$p['title']; ?>" name="title">
               </div>

               <div class="form-group">
                 <label>Post author: </label>
                 <input class="form-control" type="text" value="<?php echo @$p['author']; ?>" name="author">
               </div>

               <div class="form-group">
                 <label>Post category: </label>
                 <select class="form-control" name="category">
                   <?php while($row = $categories->fetch_assoc()){
                     //
                     $selected = ($row['id'] == $p['category']) ? "selected" : "";
                     ?>
                   <option value="<?php echo $row['id']; ?>" <?php echo $selected; ?>><?php echo $row['text']; ?></option>
                   <?php } ?>
                 </select>
               </div>

               <div class="form-group">
                 <label>Post body: </label>
                 <textarea name="body" class="form-control" rows="8" cols="20"><?php echo @$p['body']; ?></textarea>
               </div>

               <div class="form-group">
                 <label>Keywords: </label>
                 <input class="form-control" type="text" value="<?php echo @$p['keywords']; ?>" name="keywords">
               </div>

               <button type="submit" name="add_post" class="btn btn-default">Add post</button>

             </form>
           </div>
         </div>
       </div>
     </div>

     <!-- Bootstrap core JavaScript
     ================================================== -->
     <!-- Placed at the end of the document so the pages load faster -->
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
     <script src="js/bootstrap.js"></script>
   </body>
 </html>
