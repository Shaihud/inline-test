<!DOCTYPE html>
<html>
<head>
	<script src="lib/jquery.min.js"></script>
	<style>
		#message
		{
			color: red;
		}
		#search_result
		{
			width: 800px;
			margin-left: 10px;
		}
		.post
		{
			border: 1px black solid;
			margin-bottom: 20px;
		}
		.title
		{
			margin: 10px;
		}
		.comment
		{
			width: 500px;
			border: 1px black solid;
			margin: 10px;
		}
		.comment_body
		{
			margin: 10px;
			margin-top: 0px;
		}
		.username
		{
			margin: 10px;
			margin-bottom: 0px;
			padding: 5px;
			font-weight: bold;
			background: lightgrey;

		}

	</style>
</head>

<body>

	<input size="50" type="text" name="searchbar" placeholder="Поиск комментария (минимум 3 символа)">
	<button onclick="Search()">Найти</button>
	<span id="message"></span>
	<div id="search_result"></div>

	<script>
		function Search()
		{
			var val = $("input[name='searchbar']").val();
			var minChars = 3

			//min char
			if(val.length >= minChars)
			{
				$('#message').empty();
				var data =
			    { 
			        text : val
			    };
			    $.ajax
			    ({
			        type: 'GET',
			        data: data,
			        url: 'search.php',
			        success: function(data)
			        {
			            $('#search_result').html(data);
			        }
			    });
			}
			else
			{
				$('#message').html("минимум 3 символа!");
			}
		}
	</script>
	
</body>