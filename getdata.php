<?php

	include('db.php');

	function GetJson($url)
	{
		$json = file_get_contents($url);
		$object = json_decode($json);
		return $object;
	}

	function CLog($text)
	{
		$text;
		echo "<script>console.log('$text');</script>";
	}

	//json urls
	$postsUrl = "https://jsonplaceholder.typicode.com/posts";
	$commentsUrl = "https://jsonplaceholder.typicode.com/comments";

	//connection to db + error 
	$connection = mysqli_connect($host, $user, $password, $db);
	if($connection)
	{
		//getting posts
		$posts = GetJson($postsUrl);
		if($posts != null)
		{
			foreach ($posts as $p)
			{
				$id = $p->id;
				$userId = $p->userId;
				$title = $p->title;
				$body = $p->body;

				$query = "INSERT INTO posts(id, userId, title, body) VALUES ('$id', '$userId', '$title', '$body');";
				mysqli_query($connection, $query);
			}
		}


		//getting comments
		$comments = GetJson($commentsUrl);
		if($comments != null)
		{
			foreach ($comments as $c)
			{
				$id = $c->id;
				$postId = $c->postId;
				$name = $c->name;
				$email = $c->email;
				$body = $c->body;

				$query = "INSERT INTO comments(id, postId, name, email, body) VALUES ('$id', '$postId', '$name', '$email', '$body');";
				mysqli_query($connection, $query);
			}
		}
		mysqli_close($connection);


		//console log
		$postsCount = count($posts);
		$commentCount = count($comments);
		$text = "Загружено $postsCount записей и $commentCount комментариев.";
		CLog($text);
	}
	else
	{
		echo mysqli_connect_error();
	}
?>