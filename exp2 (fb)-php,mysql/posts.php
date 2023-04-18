
<?php
	// connect to the database
 include "connection.php";
 session_start();

	if (isset($_POST['liked'])) {
		$postid = $_POST['postid'];
		$result = mysqli_query($db, "SELECT * FROM fb_users WHERE id=$postid");
		$row = mysqli_fetch_array($result);
		$n = $row['likes'];

		mysqli_query($db, "INSERT INTO likes (username, postid) VALUES ('$_SESSION[user]', $postid)");
		mysqli_query($db, "UPDATE fb_users SET likes=$n+1 WHERE id=$postid");

		echo $n+1;
		exit();
	}
	if (isset($_POST['unliked'])) {
		$postid = $_POST['postid'];
		$result = mysqli_query($db, "SELECT * FROM fb_users WHERE id=$postid");
		$row = mysqli_fetch_array($result);
		$n = $row['likes'];

		mysqli_query($db, "DELETE FROM likes WHERE postid=$postid AND userid=1");
		mysqli_query($db, "UPDATE fb_users SET likes=$n-1 WHERE id=$postid");

		echo $n-1;
		exit();
	}

	// Retrieve posts from the database
	$posts = mysqli_query($db, "SELECT * FROM  fb_users");
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
	
  <style media="screen">
  body {
padding-top: 100px;
padding-bottom: 100px;
display:grid;
grid-template-columns:1fr 1fr 1fr 1fr;
column-gap:10px;
}

.post {

width: 80%;
margin: 10px auto;
flex:50%;
border: 1px solid #cbcbcb;
padding: 5px 10px 0px 10px;
}
.like, .unlike, .likes_count {
color: blue;
}
.hide {
display: none;
}
.fa-thumbs-up, .fa-thumbs-o-up {
transform: rotateY(-180deg);
font-size: 1.3em;
}
p
{
  text-align: center;
}
.img
{
  width:100%;
}
  </style>
</head>
<body>
	<!-- display posts gotten from the database  -->
		<?php while ($row = mysqli_fetch_array($posts)) {
       $x = $row[2];

      $q = mysqli_query($db,"SELECT des from `description` where id = $row[2];");
      ?>

			<div class="post">
        <div  style =  "padding: 2px; margin-top: 2px;">
          <?php
          echo "<p>";
          echo "<h3>".$row[0]."</h3>";
          echo "</p>";
          ?>
        </div>
				<img class = "img" src="images/<?php echo $row['image']; ?>" width = 200 >

        <div  style =  "padding: 2px; margin-top: 2px;">
          <?php
          $q1 = mysqli_fetch_array($q);
          echo "<p>";
          echo $q1[0];
          echo "</p>";
          ?>
        </div>
				<div style="padding: 2px; margin-top: 5px;">
				<?php
					// determine if user has already liked this post
					$results = mysqli_query($db, "SELECT * FROM likes WHERE username= '$_SESSION[user]' AND postid=".$row['id']."");

					if (mysqli_num_rows($results) == 1 ): ?>
						<!-- user already likes post -->
						<span class="unlike fa fa-thumbs-up" data-id="<?php echo $row['id']; ?>"></span>
						<span class="like hide fa fa-thumbs-o-up" data-id="<?php echo $row['id']; ?>"></span>
					<?php else: ?>
						<!-- user has not yet liked post -->
						<span class="like fa fa-thumbs-o-up" data-id="<?php echo $row['id']; ?>"></span>
						<span class="unlike hide fa fa-thumbs-up" data-id="<?php echo $row['id']; ?>"></span>
					<?php endif ?>

					<span class="likes_count"><?php echo $row['likes']; ?> likes</span>
				</div>
        <div  style =  "padding: 2px; margin-top: 2px;">
         <p style = "text-align:center;">Comments</p>
         <?php $t = mysqli_query($db,"SELECT * from `comments` where postid = ".$row['id']."");
         $i = 1;
         ?>
         <table>
          <?php while ($r = mysqli_fetch_array($t)) {
            // code...
            ?>
             <tr>
               <td><?php echo $i; ?></td>
               <td>  <?php echo $r['comment']; echo "  <b> by "; echo $r['username'];echo "</b>"; ?> </td>
             </tr>
            <?php
            $i = $i + 1;
          } ?>
         </table>
         <div  style =  "padding: 2px; margin-top: 2px;">
          <form class="" action="posts.php" method="post">
             <label for="comment">Add Comment</label>
             <input type="text" name="comment" value="" id = "comment">
			 <br><br>
             <input type="submit" name="submit" value="submit">
          </form>
         </div>

        </div>
			</div>
      <?php
       if(isset($_POST['submit']))
         {

           mysqli_query($db,"INSERT into `comments` VALUES('$_SESSION[user]',$x,'$_POST[comment]');");
           ?>
           <script type="text/javascript">
             window.location = "posts.php";
           </script>
           <?php
         }
       ?>
		<?php } ?>


<!-- Add Jquery to page -->
<script src="jquery.min1.js"></script>
<script>
	$(document).ready(function(){
		// when the user clicks on like
		$('.like').on('click', function(){
			var postid = $(this).data('id');
			    $post = $(this);

			$.ajax({
				url: 'posts.php',
				type: 'post',
				data: {
					'liked': 1,
					'postid': postid
				},
				success: function(response){
					$post.parent().find('span.likes_count').text(response + " likes");
					$post.addClass('hide');
					$post.siblings().removeClass('hide');
				}
			});
		});

		// when the user clicks on unlike
		$('.unlike').on('click', function(){
			var postid = $(this).data('id');
		    $post = $(this);

			$.ajax({
				url: 'posts.php',
				type: 'post',
				data: {
					'unliked': 1,
					'postid': postid
				},
				success: function(response){
					$post.parent().find('span.likes_count').text(response + " likes");
					$post.addClass('hide');
					$post.siblings().removeClass('hide');
				}
			});
		});
	});
</script>
</body>
</html>
