<!DOCTYPE html>
<html>
<head>
	<title>Simple Web Crawler</title>
	<link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
	<div class="container">

		<?php
			$pages_to_crawl = 3;

			for($p = 1; $p <= $pages_to_crawl; $p++){
				$page_contents = file_get_contents('https://www.quicksprout.com/blog/page/'.$p.'/');

				if($page_contents !== FALSE && !empty($page_contents)){

					// Extract all articles

					$main_contents = explode('<main class="content" id="genesis-content">', $page_contents);
					$main_contents = explode('</main>', $main_contents[1]);

					// Each article
					$articles = explode('<article ', $main_contents[0]);
					array_shift($articles);


					for($i = 0; $i < count($articles); $i++){

						// Extract main image
						$main_image = explode('<a class="entry-image-link"', $articles[$i]);
						$main_image = explode('<noscript><img src="', $main_image[1]);
						$main_image = explode('"', $main_image[1]);
						$main_image = trim($main_image[0]);

						// Extract post title along with it's link
						$title = explode('<h2 class="entry-title">', $articles[$i]);
						$title = explode('</h2>', $title[1]);
						$title = trim($title[0]);

						echo '
							<div>
								<img src="'.$main_image.'" />
								<h4>'.$title.'</h4>
							</div>
						';
					}
				}
			}
		?>
     
	</div>
</body>
</html>