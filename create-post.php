<?php require "includes/header.php";?>
<?php require "config/config.php";?>

<?php 

if(isset($_POST['submit'])){
  if(empty($_POST['title']) OR empty($_POST['post_author']) OR empty($_POST['category']) OR empty($_POST['body'])){
    echo "<script>alert('one or more inputs are empty');</script>";

  }else{
    $title = $_POST['title'];
    $post_author = $_POST['post_author'];
    $category = $_POST['category'];
    $body = $_POST['body'];

    $insert = $conn->prepare("INSERT INTO posts (title, post_author, category, body) VALUES (:title, :post_author, :category, :body)");

    $insert->execute([
      ":title" => $title,
      ":post_author" => $post_author,
      ":category" => $category,
      ":body" => $body
    ]);

    header("location: index.php");
  }
}

$categories = $conn->query("SELECT * FROM categories");
$categories->execute();

$allCategories = $categories->fetchAll(PDO::FETCH_OBJ);
?>

          <div style="margin-top: 57px;" class="col-lg-9 mb-3">

            <form method="POST" action="create-post.php">

                <div class="mb-3">
                  <label for="exampleInputEmail1" class="form-label">Title </label>
                  <input type="text" name="title" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                </div>

                <div class="form-group mb-3">
                      <label for="exampleFormControlTextarea1">Body</label>
                      <textarea name="body" class="form-control"  rows="3"></textarea>
                    </div>

                <div class="mb-3">
                  <label for="exampleInputPassword1" class="form-label">Post Author</label>
                  <input type="text" name="post_author" class="form-control" id="exampleInputPassword1">
                </div>

                <select name="category" class="form-select mb-5 mt-5" aria-label="Default select example">
                    <label class="form-label">Choose Category</label>

                    <option selected>Choose Category</option>
                    <?php foreach ($allCategories as category) :?>
                    <option value="<?php echo $category->name; ?>"><?php echo $category->name; ?></option>
                    <?php endforeach;?>
                </select>

                <button name="submit" type="submit" class="btn btn-primary w-100">Submit</button>

              </form>
          
       
          </div>

          <?php require "includes/footer.php";?>
