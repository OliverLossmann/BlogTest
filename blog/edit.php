<?php
    session_start();
    include("db.php");

    $id = $_GET['id'];
    $pdo = 'SELECT * FROM posts WHERE id=:id';

    $stmt = $dbConn->prepare($pdo);
    $stmt->execute([':id' => $id]); 
    $post = $stmt->fetch(PDO::FETCH_OBJ);



    if(isset($_POST['addButton'])) {
        $title = $_POST['title'];
        $author = $_POST['author'];
        $content = $_POST['content'];

        if(empty($title) && empty($author) && empty($content)){
            $errors = 'All fields must be filled';
        } else if(empty($title)) {
            $titleErr = 'Title must be filled';
        } else if(empty($author)) {
            $authorErr = 'Content must be filled';
        } else if(empty($content)) {
            $contentErr = 'Name must be filled';
        } else {

        $pdo = "UPDATE posts SET title=:title, author=:author, content=:content WHERE id=:id";
        $stmt = $dbConn->prepare($pdo);

        try{ $result = $stmt->execute([':title' => $title, ':author' => $author, ':content' => $content, ':id' => $id]);
           header("Location: index.php");
        }catch(PDOException $e) {
            $result = false;
        }
    }
}
?>

<p>
    <title>Edit Post</title>
</p>
                <p>
                <span class="m-title">Edit Post</span>
                    </p>
                    <p>
                    <a class='btn btn-sm btn-outline-secondary' href='index.php' style="margin-right: 2px;">Blog</a>
                        </p>
            <?php echo $errors;?>
            <?php if($result) echo "<div class='alert alert-success' role='alert'>Succesfully Added</div>"; ?>      
                <form  method="POST" style="margin-top: 10px;">
                    <p>
                        <label for="title">Post Title</label>
                        <input value="<?= $post->title;?>" name="title" type="text" class="form-control" placeholder="Post Title">
                        <?php echo $titleErr; ?>
                    </p>
                    <p>
                        <label for="author">Your author</label>
                        <input value="<?= $post->author;?>" name="author" type="text" class="form-control" placeholder="Author">
                        <?php echo $authorErr;?>
                    </p>
                    <p>
                        <label for="content">Content...</label>
                        <textarea name="content" class="form-control" rows="3" placeholder="Content" ><?= $post->content;?></textarea>
                        <?php echo $contentErr;?>
                    </p>
                    <p>
                    <button class="btn btn-lg btn-primary btn-block" type="submit" name="addButton">Edit Post</button>
                    </p>
                </form>
