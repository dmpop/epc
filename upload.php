<?php
require_once('protect.php');
?>

<html lang="en">
<!-- Author: Dmitri Popov, dmpop@linux.com
         License: GPLv3 https://www.gnu.org/licenses/gpl-3.0.txt -->

<head>
	<meta charset="utf-8">
	<title>Everyday Photo Carry</title>
	<link rel="shortcut icon" href="favicon.png" />
	<link rel="stylesheet" href="css/classless.css">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<style>
		h1 {
			letter-spacing: 3px;
			color: #99ccff;
		}

		img {
			display: block;
			margin-left: auto;
			margin-right: auto;
			margin-top: 1%;
			margin-bottom: 1%;
		}
	</style>
</head>

<body>
	<div style="text-align: center;">
		<h1 style="margin-top: 0em; margin-bottom: 1em;">Everyday Photo Carry</h1>
		<button style="margin-bottom: 2em;" onclick='window.location.href = "index.php"'>Back</button>
	</div>
	<?php
	$upload_dir = "img/";
	if (isset($_POST['submit'])) {
		// count total files
		$countfiles = count($_FILES['file']['name']);
		// looping all files
		for ($i = 0; $i < $countfiles; $i++) {
			$filename = $_FILES['file']['name'][$i];
			if (!file_exists($upload_dir)) {
				mkdir($upload_dir, 0777, true);
			}
			// upload file
			move_uploaded_file($_FILES['file']['tmp_name'][$i], $upload_dir . DIRECTORY_SEPARATOR . $filename);
		}
	}
	?>
	<form method='post' action='' enctype='multipart/form-data'>
		<input type="file" name="file[]" id="file" multiple>
		<div style="text-align: center; margin-top: 1em;">
			<button role="button" name="submit">Upload</button>
	</form>
	<p>
	<p>Read the <a href='https://gumroad.com/l/linux-photography'>Linux Photography</a> book</p>
	</p>
	</div>
</body>

</html>