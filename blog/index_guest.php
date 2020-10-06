<?php

	session_start(); //get the session information
	include("db.php");



$sql = "SELECT * FROM posts";
	$stmt = $dbConn->prepare($sql);
	$stmt->execute([]);
	$allPosts = $stmt->fetchAll();


	
?>
	<title>Home</title>

			<p>
				<span class="m-title"><b>Posts Blog</b></span>
		
			</p>
			<p>
				<a class='btn btn-sm btn-outline-secondary' href='add_post.php' style='margin-right:2px;'>Add New</a>
								
			</p>
                <?php 

                if($result != false){
                	echo "<div class='alert alert-danger' role='alert'>Post Succesfully Deleted</div>";
                }

                foreach($allPosts as $post) { ?>
					<p>
						<a href="view_post.php?id=<?php echo $post->id;?>"><h1 class="blog-post-title"><?php echo $post->title ?></h1></a>
						
					</p>

					<p>	
						<?php 
						$date = strtotime($post->published_date);
						$converted_date = date('F d, Y', $date);
						echo $converted_date;
					?>

						by <ins><?php echo $post->author
						?></ins>

					<p><i><?php $str = $post->content;
							if( strlen($post->content) > 50) {
							    $str = explode( "\n", wordwrap($post->content, 50));
							    $str = $str[0] . '...';
							}

							echo $str;
							 ?></i></p>

					</p>