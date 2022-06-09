<?php
include('config.php');
if ($protect) {
	require_once('protect.php');
}
?>

<html lang="en">
<!-- Author: Dmitri Popov, dmpop@linux.com
https://github.com/dmpop/epc
License: GPLv3 https://www.gnu.org/licenses/gpl-3.0.txt -->

<head>
	<meta charset="utf-8">
	<title><?php echo $title ?></title>
	<link rel="shortcut icon" href="favicon.png" />
	<link rel="stylesheet" href="css/milligram.min.css">
	<link rel="stylesheet" href="css/styles.css">
	<link rel="stylesheet" href="css/popup.css">
	<script src="js/popup.js"></script>
	<meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body>
	<div style="text-align: center;">
		<img style="height: 3em;" src="favicon.svg" alt="logo" />
		<h1 style="letter-spacing: 3px;"><?php echo $title ?></h1>
		<hr style="margin-top: 1.5em; margin-bottom: 1.5em;">
		<button class="button button-outline" style="display: inline; margin-bottom: 2em;" onclick='window.location.href = "index.php"'>Back</button>
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
			echo "<script>";
			echo 'popup("Upload completed");';
			echo "</script>";
		}
		?>
		<div class="card">
			<form method='post' action='' enctype='multipart/form-data'>
				<input type="file" name="file[]" id="file" multiple>
				<button role="button" name="submit">Upload</button>
			</form>
		</div>
		<hr style="margin-top: 1.5em; margin-bottom: 1.5em;">
		<div><?php echo $footer ?></div>
	</div>
</body>

</html>