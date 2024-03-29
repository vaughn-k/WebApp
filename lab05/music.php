<!DOCTYPE html>
<html lang="en">

	<head>
		<title>Music Library</title>
		<meta charset="utf-8" />
		<link href="http://selab.hanyang.ac.kr/courses/cse326/2017/labs/images/5/music.jpg" type="image/jpeg" rel="shortcut icon" />
		<link href="http://selab.hanyang.ac.kr/courses/cse326/2017/labs/labResources/music.css" type="text/css" rel="stylesheet" />
	</head>

	<body>
		<h1>My Music Page</h1>

		<!-- Ex 1: Number of Songs (Variables) -->
		<?php 
		$song_count = count(glob("lab5/musicPHP/songs/*.mp3"));
		?>
		<p>
			I love music.
			I have <?= $song_count ?> total songs,
			which is over <?= (int)($song_count / 10) ?> hours of music!
		</p>

		<!-- Ex 2: Top Music News (Loops) -->
		
		<!-- Ex 3: Query Variable -->
		<div class="section">
			<h2>Yahoo! Top Music News</h2>
		
			<ol>
			<?php 
				if (isset($_GET["newspages"])) {
					$newspages = $_GET["newspages"];
				}
				else {
					$newspages = 5;
				}
				for ($i = 1; $i <= $newspages; $i++) { ?>
					<li><a href="http://music.yahoo.com/news/archive/?page=<?= $i ?>">Page <?= $i ?></a></li>
			<?php } ?>
			</ol>
		</div>

		<!-- Ex 4: Favorite Artists (Arrays) -->


			<?php 
			$artists = array("Guns N' Roses", "Green Day", "Blink182");
			array_push($artists, "Queen");
			foreach ($artists as  $artist) { ?>
				<li><?= $artist ?></li>
			<?php } ?>

		<!-- Ex 5: Favorite Artists from a File (Files) -->
		<div class="section">
			<h2>My Favorite Artists</h2>
		
			<ol>
				<?php 
				foreach (file("favorite.txt") as $artist) { ?>
					<li><a href = "http://en.wikipedia.org/wiki/<?= str_replace(" ","_",$artist) ?>"><?= $artist ?></a></li>
				<?php } ?>
				
			</ol>
		</div>
		
		<!-- Ex 6: Music (Multiple Files) -->
		<!-- <div class="section">
			<h2>My Music and Playlists</h2>
			<ul id="musiclist">
				<?php 
					foreach (glob("lab5/musicPHP/songs/*.mp3") as $value) { ?>
						<li class="mp3item">
							<?php print_r($value) ?></li>
				<?php } ?>
			</ul>
		</div> -->
		<!-- Ex 7: MP3 Formatting -->
		<div class="section">
			<h2>My Music and Playlists</h2>
			
			<ul id="musiclist">
				<?php 
				$files = array();
				foreach (glob("lab5/musicPHP/songs/*.mp3") as $value) {
					$files[basename($value)] = (int)(filesize($value)/1024);
				}
				
				arsort($files);
				foreach ($files as $file => $filesize) { ?>
					<li class = "mp3item">
						<a href = "lab5/musicPHP/songs/<?= $file ?>" download><?= $file ?></a> (<?= $filesize ?> KB)
					</li>
				<?php } ?>

				<!-- Exercise 8: Playlists (Files) -->
				<?php 
				foreach (array_reverse(glob("lab5/musicPHP/songs/*.m3u")) as $file) { ?>
					<li class="playlistitem">
						<?= basename($file) ?>
						<ul>
							<?php 
							$files = file($file);
							shuffle($files);
							foreach ($files as $line) {
								if (strpos($line, "#") === false) { ?>
									<li><?= $line ?></li>
							<?php }} ?>
						</ul>
					</li>
				<?php } ?>
			</ul>
		</div>

		<div>
			<a href="http://validator.w3.org/check/referer">
				<img src="http://selab.hanyang.ac.kr/courses/cse326/2017/labs/images/w3c-html.png" alt="Valid HTML5" />
			</a>
			<a href="http://jigsaw.w3.org/css-validator/check/referer">
				<img src="http://selab.hanyang.ac.kr/courses/cse326/2017/labs/images/w3c-css.png" alt="Valid CSS" />
			</a>
		</div>
	</body>
</html>
