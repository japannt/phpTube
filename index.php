<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" href="/css/mainpage.css">
		<title>phpTube</title>
	</head>

	<body>
		<ul>
			<li><i>home</i></li>
			<li><a href="/upload">upload</a></li>
			<li><a href="/about">about</a></li>
		</ul>
		
		<div class="flexCenter">
			<img style="width: 40vh;" src="/img/phptubeLogo.svg" alt="phpTube">
			<p style="text-align: center;">Your digital video repository</p>

			<div>
				<form action="/api/watch.php" method="get" enctype="multipart/form-data">
					<fieldset>
						<legend>go to a video</legend>
						id: <input style="width:25vw; text-align:center;" type="text" name="v">
						<input type="submit" value="go!">
					</fieldset>
				</form>
			</div>
			<p style="text-align: center;">example link: <a href="/api/watch.php?v=65a89fac46c8e40fe694e96acf3bcd97"><?php echo $_SERVER['HTTP_HOST'] ?>/api/watch.php?v=65a89fac46c8e40fe694e96acf3bcd97</a></p>
		</div>
	</body>
</html>