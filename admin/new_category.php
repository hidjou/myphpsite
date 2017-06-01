<?php

include("includes/config.php");
include("includes/db.php");
include("includes/header.php");
include("includes/sidebar.php");

if(isset($_GET['category'])){
  $id = mysqli_real_escape_string($db, $_GET['category']);
  $query = "SELECT * FROM categories WHERE id='$id'";
  $c = $db->query($query);
  $c = $c->fetch_assoc();
}

if(isset($_POST['add_category'])){
  $category = mysqli_real_escape_string($db, $_POST['category']);

  if(isset($_GET['category'])){
    $query = "UPDATE categories SET text='$category'WHERE id='$id'";
    $db->query($query);
  } else {
    $query = "INSERT INTO categories (text) VALUES('$category')";
    $db->query($query);
  }
}

 ?>


           <h1 class="page-header">Add new category</h1>
           <div class="table-responsive">
             <form method="post">

               <div class="form-group">
                 <label for="category">Category</label>
                 <input class="form-control" type="text" name="category" id="category" value="<?php echo @$c['text'] ?>">
               </div>

               <button type="submit" name="add_category" class="btn btn-default">Add category</button>

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
