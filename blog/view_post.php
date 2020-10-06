<?php





    session_start();
    include("db.php");

    $id = $_GET['id'];
    $sql = 'SELECT * FROM posts WHERE id=:id';

    $stmt = $dbConn->prepare($sql);
    $stmt->execute([':id' => $id]); 
    $post = $stmt->fetch(PDO::FETCH_OBJ);



    
?>
<p>
    <title>View Post</title>
</p>

            <p>
                <span class="m-title">View Post</span>
            </p>
            <p>        

                    <a class='btn btn-sm btn-outline-secondary' href='index.php' style="margin-right: 2px;">Blog</a>
            </p>
                <form method="POST" style="margin-top: 10px;">

                        <p>
                        <h1><b><?= $post->title;?></b></h1>
                        </p>
                        <p>    
                        <?php 
                        $date = strtotime($post->published_date);
                        $converted_date = date('F d, Y', $date);
                        echo $converted_date;
                    ?></p>

                        <p>By <ins><?= $post->author;?></ins></p>
               

                        <p><i><?= $post->content;?></i></p>
              

                    <a href="index.php">Return</a>
                </form>
    