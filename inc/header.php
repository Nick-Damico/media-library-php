<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title><?php echo $page_title; ?></title>
	<link rel="stylesheet" href="css/style.css" type="text/css">
</head>
<body>

	<div class="header">

		<div class="wrapper">

			<h1 class="branding-title"><a href="./">Personal Media Library</a></h1>

			<ul class="nav">
          <li class="books<?php echo $section == 'books' ? " on": null; ?>"><a href="catalog.php?cat=books">Books</a></li>
          <li class="movies<?php echo $section == 'movies' ? " on": null; ?>"><a href="catalog.php?cat=movies">Movies</a></li>
          <li class="music<?php echo $section == 'music' ? " on": null; ?>"><a href="catalog.php?cat=music">Music</a></li>
          <li class="games<?php echo $section == 'games' ? " on": null; ?>"><a id="nav__a--games" href="catalog.php?cat=games">Games</a></li>
          <li class="suggest<?php echo $section == 'suggest' ? " on": null; ?>"><a href="suggest.php">Suggest</a></li>
      </ul>

		</div>

	</div>

	<div id="content">
