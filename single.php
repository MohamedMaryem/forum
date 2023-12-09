<?php require "includes/header.php";?>
<?php require "config/config.php";?>

<?php 

if(isset($_POST['submit'])){
  if(empty($_POST['author_name']) OR empty($_POST['replay'])){
    echo "<script>alert('one or more inputs are empty');</script>";

  }else{
    $author_name = $_POST['author_name'];
    $replay = $_POST['replay'];
    $post_id = $_POST['post_id'];

    $insert = $conn->prepare("INSERT INTO replies (author_name, replay, post_id) VALUES (:author_name, :replay, :post_id)");

    $insert->execute([
      ":author_name" => $author_name,
      ":replay" => $replay,
      ":post_id" => $post_id,
    ]);

    header("location: index.php");
  }
}


//getting the replies

if(isset($_GET['id'])){

$id = $_GET['id'];
$allReplies = $conn->query("SELECT * FROM replies WHERE post_id='1'");
$allReplies->execute();

$replies = $allReplies->fetchAll(PDO::FETCH_OBJ);

//getting data for every post

$singlePost = $conn->query("SELECT * FROM posts WHERE id='$id'");
$singlePost->execute();

$single = $singlePost->fetch(PDO::FETCH_OBJ);


}
?>

          <!-- Main content -->
          <div style="margin-top: 43px;" class="col-lg-9 mb-3">
           
            <!-- End of post 1 -->
            <div class="mt-5 card row-hover pos-relative py-3 px-3 mb-3 border-warning border-top-0 border-right-0 border-bottom-0 rounded-0">
              <div class="row align-items-center">
                <div class="col-md-12 mb-3 mb-sm-0">
                  <h5>
                    <a href="#" class="text-primary"><?php echo $single->title; ?></a>
                  </h5>
                  <p>
                  <?php echo $single->body; ?>
                </p>
                  <p class="text-sm"><span class="op-6">Posted</span> <a class="text-black" href="#"><?php echo $single->created_At; ?> by</span> <a class="text-black" href="#"><?php echo $single->post_author; ?></a></p>
                  <div class="text-sm op-5"> <a class="text-black mr-2" href="#"><?php echo $single->category; ?></a></div>
                </div>
                
              </div>
            </div>

            <div style="margin-left: 40px;" class="card row-hover pos-relative py-3 px-3 mb-3 border-primary border-top-0 border-right-0 border-bottom-0 rounded-0">
              <div class="row align-items-center">
                <div class="col-md-12 mb-3 mb-sm-0">
                  <h5>
                    <a href="#" class="text-primary">Write Comment</a>
                  </h5>
                  <form method="POST" action="single.php?id=1">
                    <div class="form-group">
                      <label for="exampleFormControlInput1">Author Name</label>
                      <input type="text" name="author_name" class="form-control" id="exampleFormControlInput1" placeholder="author name">
                    </div>
            
                    <div class="form-group">
                      <label for="exampleFormControlTextarea1">Replay</label>
                      <textarea class="form-control" name="replay" id="exampleFormControlTextarea1" rows="3"></textarea>
                    </div>
                    <div class="form-group">
                      <input type="hidden" name="post_id" value="<?php echo $id; ?>" class="form-control" id="exampleFormControlInput1" placeholder="author name">
                    </div>

                <button name="submit" type="submit" class="mt-4 btn btn-primary w-100">Add Replay</button>

                  </form>
                </div>
                
              </div>
          </div>

            <!-- Replies -->
            <?php foreach($replies as $singleReplay) : ?>
            <div style="margin-left: 40px;" class="card row-hover pos-relative py-3 px-3 mb-3 border-primary border-top-0 border-right-0 border-bottom-0 rounded-0">
                <div class="row align-items-center">
                  <div class="col-md-12 mb-3 mb-sm-0">
                    <h5>
                      <a href="#" class="text-primary"><?php echo $singleReplay->author_name; ?></a>
                    </h5>
                    <p>
                    <?php echo $singleReplay->replay; ?>
                    </p>
                    <p class="text-sm"><span class="op-6">Commented</span> <a class="text-black" href="#"><?php echo $singleReplay->created_at; ?></a></p>
                  </div>
                  
                </div>
            </div>
            <?php endforeach; ?>
            </div>
 
          </div>

<?php require "includes/footer.php";?>
