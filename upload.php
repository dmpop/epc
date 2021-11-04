<?php
include('config.php');
if ($protect) {
	require_once('protect.php');
}
?>

<html lang="en" data-theme="<?php echo $theme ?>">
<!-- Author: Dmitri Popov, dmpop@linux.com
         License: GPLv3 https://www.gnu.org/licenses/gpl-3.0.txt -->

<head>
	<meta charset="utf-8">
	<title><?php echo $title ?></title>
	<link rel="shortcut icon" href="favicon.png" />
	<link rel="stylesheet" href="css/classless.css">
	<link rel="stylesheet" href="css/themes.css">
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
		<img style="height: 3em;" src="favicon.svg" alt="logo" />
		<h1 style="margin-top: 0em; margin-bottom: 1em; letter-spacing: 3px; color: #cc6600;"><?php echo $title ?></h1>
		<button style="display: inline; margin-bottom: 2em;" onclick='window.location.href = "index.php"'>Back</button> <button style="margin-bottom: 2em;"  onclick='window.location.href = "edit.php"'>Edit</button>
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
			echo '<script language="javascript">';
			echo 'alert("Upload completed.")';
			echo '</script>';
		}
		?>
		<div class="card">
			<form method='post' action='' enctype='multipart/form-data'>
				<input type="file" name="file[]" id="file" multiple>
				<button role="button" name="submit">Upload</button>
			</form>
		</div>
		<p style="font-size: 85%"><?php echo $footer ?></p>
	</div>
</body>

</html>