<?php

	session_start(); //get the session information
	include("db.php");

if (!isset($_SESSION['root'])) {

    }else {
    	header('Location: index_guest.php?');
    }
    



	$result = false;

	if(isset($_POST['delete_id'])){
       	try {
		    $query = "
		        DELETE FROM posts
		        WHERE id = :id;";

		    $stmt = $dbConn->prepare($query);
		    $stmt->bindValue(':id', $_POST['delete_id']);
		    $stmt->execute();
		} catch (\PDOException $e) {
	    	throw new \PDOException($e->getMessage(), (int) $e->getCode());
		}	
	}



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

					<?php
						echo "<button class='btn btn-danger' onclick='deletePost($post->id)'>X</button>"
						?>
						<td>
						<a href="edit.php?id=<?php echo $post->id;?>">Edit</a>
						</td>
					<!-- /.blog-post -->
				<?php } ?>

		<form action="index.php" method="POST" id="deletePost">
			<input type="hidden" id="delete_id" name="delete_id" value="">
		</form>
	

	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
	<script type="text/javascript">
		
		function deletePost(id){
			Swal.fire({
			  title: 'Are you sure?',
			  text: "You won't be able to revert this!",
			  icon: 'warning',
			  showCancelButton: true,
			  confirmButtonColor: '#3085d6',
			  cancelButtonColor: '#d33',
			  confirmButtonText: 'Yes, delete it!'
			}).then((result) => {
			  if (result.value) {
			   document.getElementById("delete_id").value = id;
			   document.getElementById("deletePost").submit();
			  }
			})
		}
		
	</script>
