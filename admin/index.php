<?php

include("includes/config.php");
include("includes/db.php");
include("includes/header.php");
include("includes/sidebar.php");

if(isset($_GET['entity']) && isset($_GET['action']) && isset($_GET['id'])){
  $entity = mysqli_real_escape_string($db, $_GET['entity']);
  $action = mysqli_real_escape_string($db, $_GET['action']);
  $id = mysqli_real_escape_string($db, $_GET['id']);

  if($action == "delete"){
    if($entity == "post"){
      // Delete a post
      $query = "DELETE FROM posts WHERE id='$id'";
    } else if($entity == "comment"){
      // Delete a comment
      $query = "DELETE FROM comments WHERE id='$id'";
    } else {
      // Delete a category
      $query = "DELETE FROM categories WHERE id='$id'";
      // Change posts' category to 0 for the one that had this category's id since it getting deleted
      $query2 = "UPDATE posts SET category='0' WHERE category='$id'";
    }
  } else {
    $query = "UPDATE comments SET status='1' WHERE id='$id'";
  }

  $db->query($query);

  if(isset($query2)){
    $db->query($query2);
  }
}

$query = "SELECT * FROM posts ORDER BY id DESC";
$posts = $db->query($query);

$query = "SELECT * FROM comments WHERE status='0' ORDER BY id DESC";
$comments = $db->query($query);

$query = "SELECT * FROM categories ORDER BY id DESC";
$categories = $db->query($query);

 ?>


           <h1 class="page-header">Dashboard</h1>

           <h2 class="sub-header">Recent posts</h2>
           <div class="table-responsive">

             <table class="table table-striped">
               <thead>
                 <tr>
                   <th>Date posted</th>
                   <th>Title</th>
                   <th>Author</th>
                   <th>Actions</th>
                 </tr>
               </thead>
               <tbody>
                 <?php while($row = $posts->fetch_assoc()){ ?>
                 <tr>
                   <td><?php echo $row['date'] ?></td>
                   <td><?php echo $row['title'] ?></td>
                   <td><?php echo $row['author'] ?></td>
                   <!-- clicking the edit button will take the user to this post's edit page -->
                   <td><a href="new_post.php?post=<?php echo $row['id'] ?>" class="btn btn-warning">Edit</a>
                     <a href="index.php?entity=post&action=delete&id=<?php echo $row['id'] ?>" class="btn btn-danger">Delete</a></td>
                 </tr>
                 <?php } ?>
               </tbody>
             </table>

             <h2 class="sub-header">Recent comments</h2>
             <div class="table-responsive">
               <table class="table table-striped">
                 <thead>
                   <tr>
                     <th>Name</th>
                     <th>Comment</th>
                     <th>Actions</th>
                   </tr>
                 </thead>
                 <tbody>
                   <?php while($row = $comments->fetch_assoc()){ ?>
                   <tr>
                     <td><?php echo $row['name'] ?></td>
                     <td><?php echo $row['comment'] ?></td>

                     <td><a href="index.php?entity=comment&action=approve&id=<?php echo $row['id'] ?>" class="btn btn-success">Approve</a>
                       <a href="index.php?entity=comment&action=delete&id=<?php echo $row['id'] ?>" class="btn btn-danger">Delete</a></td>
                   </tr>
                   <?php } ?>
                 </tbody>
               </table>


               <h2 class="sub-header">Recent categories</h2>
               <div class="table-responsive">

                 <table class="table table-striped">
                   <thead>
                     <tr>
                       <th>ID</th>
                       <th>Title</th>
                       <th>Actions</th>
                     </tr>
                   </thead>
                   <tbody>
                     <?php while($row = $categories->fetch_assoc()){ ?>
                     <tr>
                       <td><?php echo $row['id'] ?></td>
                       <td><?php echo $row['text'] ?></td>
                       <td><a href="new_category.php?category=<?php echo $row['id'] ?>" class="btn btn-warning">Edit</a>
                         <a href="index.php?entity=category&action=delete&id=<?php echo $row['id'] ?>" class="btn btn-danger">Delete</a></td>
                     </tr>
                     <?php } ?>
                   </tbody>
                 </table>

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
