<?php
require 'redis.php';
$r = new Redis();
$r->connect();

if (isset($_GET['firstname'])) {
    $r->set('firstname', $_GET['firstname']);
}

if (isset($_GET['genre'])) {
    $r->push('genres', $_GET['genre']);
    header('location:index.php');
    exit;
}

if (isset($_GET['actor'])) {
    $r->sadd('actors', $_GET['actor']);
    header('location:index.php');
    exit;
}

if (isset($_GET['movie'])) {
    $movieid = $r->incr('movieids');
    $r->set('movie:' . $movieid, $_GET['movie']);
    $r->zadd('movies', $r->zscore('movies', array_pop($r->zrange('movies', -1, -1)))+1, $movieid);
    header('location:index.php');
    exit;
}

if (isset($_GET['update']) && $_GET['update'] == 'score') {
    foreach ($_GET['scores'] as $movie=>$score) {
	$r->zadd('movies', $score, $movie);
    }
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
   "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
  <head>
     <title>Redis Tutorial</title>
  </head>
  <body>
    <strong>Redis String Example</strong>
    <br />
    Redis strings are simple key->value relationships. They're like PHP variables.
    <br />
    <?php if ($r->get('firstname')) { echo "Hello " . $r->get('firstname'); } ?>
    <br />
    <form action="index.php" method="get">
    <input type="text" size="35" name="firstname" />
    <input type="submit" value="Set Firstname" />
    </form>
    <br />
    <strong>Redis List Example</strong>
    <br />
    You can add the same genre to the list more than once. List values are not unique.
    <br />
    <em>Genres</em>
    <br />
    <?php
    if ($r->llen('genres')) {
	foreach ($r->lrange('genres', 0, -1) as $genre) {
	    echo $genre . "<br />";
	}
    }
    ?>
    <form action="index.php" method="get">
    <input type="text" size="25" name="genre" />
    <input type="submit" value="Add Movie Genre" />
    </form>
    <br />
    <strong>Redis Set Example</strong>
    <br />
    You can not add the same actor to the set because set keys are unique.
<br />
    <em>Actors</em>
    <br />
    <?php
    $actors = $r->smembers('actors');
    if (is_array($actors)) {
	foreach ($actors as $actor) {
	    echo $actor . "<br />\n";
	}
    }
    ?>
    <form action="index.php" method="get">
	<input type="text" name="actor" size="25" />
	<input type="submit" name="Add Actor" />
    </form>
    <br />
    <strong>Redis Sorted Set Example</strong>
    <br />
    Redis Sorted Sets can be sorted by a score.
    <br />
    <em>Favorite Movies</em>
    <br />
    <form action="index.php" method="get">
	<input type="hidden" value="score" name="update" />
    <?php
	$movies = $r->zrange('movies', 0, -1);
        if (is_array($movies)) {
	    foreach ($movies as $movie) {
		echo '<input type="text" size="3" value="' . $r->zscore('movies', $movie) . '" name="scores[' . $movie .']" />';
		echo $r->get('movie:' . $movie) . "<br />\n";
	    }
	}
    ?>
    <input type="submit" value="Update Favorite Rankings" />
    </form>
    <form action="index.php" method="get">
	 <input type="text" name="movie" size="25" />
	 <input type="submit" value="Add Favorite Movie" />
    </form>
  </body>
</html>