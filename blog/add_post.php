<?php
	session_start();
	include("db.php");

	$result = false;



	if(isset($_POST['addButton'])) {
		$title = $_POST['title'];
		$author = $_POST['author'];
		$content = $_POST['content'];
		$date = date("Y-m-d");

		if(empty($title) && empty($content)  && empty($author)){
			$errors = 'All fields must be filled';
		} else if(empty($title)) {
			$titleErr = 'Title must be filled';
		} else if(empty($author)) {
			$authorErr = 'Name must be filled';
		}else if(empty($content)) {
			$contentErr = 'Content must be filled';
		} else {
		$pdo = "INSERT INTO posts(title, content, author, published_date) VALUES(?,?,?,?)";
		$stmt = $dbConn->prepare($pdo);

		try {
			$result = $stmt->execute([$title, $content, $author, $date]);
			header("Location: index.php");
		} catch(Exception $e) {
			$result = false;
		}
	}
  }

?>


<p>
	<title>New Post</title>
</p>

<p>
	<span class="m-title">Add New Post</span>
</p>

<p>
	<a class='btn btn-sm btn-outline-secondary' href='index.php' style="margin-right: 2px;">Blog</a>
</p>

<?php if($result) echo "<div class='alert alert-success' role='alert'>Succesfully Added</div>"; ?> 	

<?php echo $errors;?>
 <form action="add_post.php" method="POST" style="margin-top: 10px";>
	<p>
		<label for="title">Post Title</label>
		<input name="title" type="text" class="form-control" placeholder="Post Title">
		<?php echo $titleErr;?>
	</p>

	<p>
		<label for="author">Your Name</label>
		<input name="author" type="text" class="form-control" placeholder="Author">
		<?php echo $authorErr;?>
	</p>	

	<p>
		<label for="content">Content...</label>
		<textarea name="content" class="form-control" rows="3" placeholder="Content"></textarea>
		<?php echo $contentErr;?>
	</p>	

		<button class="btn btn-lg btn-primary btn-block" type="submit" name="addButton">Add Post</button>
</form>

	
