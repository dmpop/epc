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
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

	<title><?php echo $title ?></title>
	<link rel="shortcut icon" href="favicon.png" />
	<link rel="stylesheet" href="css/classless.css">
	<meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body>
	<div style="text-align: center;">
		<img style="height: 3em;" src="favicon.svg" alt="logo" />
		<h1 style="margin-top: 0em; letter-spacing: 3px; color: #cc6600;"><?php echo $title ?></h1>
		<div class="card" style="margin-top: 2em; margin-bottom: 1.5em;">
			<table>
				<?php
				$CSVFILE = "data.csv";
				if (!is_file($CSVFILE)) {
					$HEADER = "Photo; Item; Serial no.; Price(€); Type; Notes\nandi.jpeg; Cameral Model; XXXXXX-XXXX; 1000; Camera; Note goes here";
					file_put_contents($CSVFILE, $HEADER);
				}
				$sum = 0;
				$row = 1;
				if (($handle = fopen($CSVFILE, "r")) !== FALSE) {
					while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) {
						if ($row == 1) {
							echo '<thead><tr>';
						} else {
							echo '<tr>';
						}
						$value0 = $data[0];
						$value1 = $data[1];
						$value2 = $data[2];
						$value3 = $data[3];
						$sum += floatval($value3);
						$value4 = $data[4];
						if ($row == 1) {
							echo '<th>' . $value1 . '</th>';
							echo '<th>' . $value2 . '</th>';
							echo '<th style="text-align: right;">' . $value3 . '</th>';
							echo '<th style="text-align: right;">' . $value4 . '</th>';
						} else {
							echo '<td></a> <a href="view.php?item=' . $row . '">' . $value1 . '</a></td>';
							echo '<td style="letter-spacing: 2px; text-align: left; color: #c46c6cff;">' . $value2 . '</td>';
							echo '<td style="text-align: right;">' . number_format(floatval($value3), 2) . '</td>';
							echo '<td style="text-align: right;">' . $value4 . '</td>';
						}
						if ($row == 1) {
							echo '</tr></thead><tbody>';
						} else {
							echo '</tr>';
						}
						$row++;
					}
					fclose($handle);
				}
				?>
				</tbody>
			</table>
			<?php
			echo "<p style='text-align: center;'> Total: <strong>" . number_format(floatval($sum), 2) . "</strong></p>";
			?>
		</div>
		<button style="display: inline;" onclick='window.location.href = "edit.php"'>Edit</button> <button onclick='window.location.href = "upload.php"'>Upload</button>
		<p style="font-size: 85%"><?php echo $footer ?></p>
	</div>
</body>

</html>