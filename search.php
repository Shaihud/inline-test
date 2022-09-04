<?php

	include('db.php');

	//connection to db
	$connection = mysqli_connect($host, $user, $password, $db);
	if($connection)
	{
		//searching
		$text = $_GET['text'];
		$query = "SELECT postId, posts.title, comments.id, comments.name, comments.body FROM comments INNER JOIN posts ON postId = posts.id WHERE comments.body LIKE '%$text%';";

		$result = mysqli_fetch_all(mysqli_query($connection, $query), 1);
		mysqli_close($connection);

		//result + check
		if($result != null)
		{
			$resultCount = count($result);
			echo "<p>Найдено $resultCount.</p>";

			foreach ($result as $r)
			{
				$postId = $r['postId'];
				$title = $r['title'];
				$id = $r['id'];
				$name = $r['name'];
				$body = $r['body'];

				//post div
				echo "<div class='post' id='post_$postId'>";

					//title
					echo "<h1 class='title'>$title</h1>";

					//username + comment body
					echo "<div class='comment' id='comment_$id'><p class='username'>$name: </p><p class='comment_body'>$body</p></div>";

				//post div end
				echo "</div>";
			}
		}
		else
		{
			echo "<p>Ничего не найдено.</p>";
		}
	}
	else
	{
		echo "<p>Ошибка.</p>";
	}

//laudanti

?>