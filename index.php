<?php
include('config.php');
if ($protect) {
	require_once('protect.php');
}
?>

<html lang="en">
<!-- Author: Dmitri Popov, dmpop@linux.com
         License: GPLv3 https://www.gnu.org/licenses/gpl-3.0.txt -->

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

	<title><?php echo $title ?></title>
	<link rel="shortcut icon" href="favicon.png" />
	<link rel="stylesheet" href="css/milligram.min.css">
	<link rel="stylesheet" href="css/styles.css">
	<meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body>
	<div style="text-align: center;">
		<img style="height: 3em;" src="favicon.svg" alt="logo" />
		<h1 style="margin-top: 0em; letter-spacing: 3px;"><?php echo $title ?></h1>
		<table>
			<?php
			if (!extension_loaded('intl')) {
				die("<div>⚠️ The PHP intl extension is missing</div>");
			}
			if (!file_exists("img")) {
				mkdir("img", 0755, true);
			}
			$csvfile = "data.csv";
			if (!is_file($csvfile)) {
				$HEADER = "Photo; Item; Serial no.; Price(€); Type; Notes;\nandi.jpeg; Cameral Model; XXXXXX-XXXX; 1000; Camera; Note goes here;";
				file_put_contents($csvfile, $HEADER);
			}
			$sum = 0;
			$row = 1;
			if (($handle = fopen($csvfile, "r")) !== FALSE) {
				while (($data = fgetcsv($handle, 0, ";")) !== FALSE) {
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
					$fmt = numfmt_create($locale, NumberFormatter::CURRENCY);
					$value4 = $data[4];
					if ($row == 1) {
						echo '<th>' . $value1 . '</th>';
						echo '<th>' . $value2 . '</th>';
						echo '<th style="text-align: right;">' . $value3 . '</th>';
						echo '<th style="text-align: right;">' . $value4 . '</th>';
					} else {
						echo '<td></a> <a href="view.php?item=' . $row . '">' . $value1 . '</a></td>';
						echo '<td style="letter-spacing: 2px; text-align: left; color: #c46c6cff;">' . $value2 . '</td>';
						echo '<td style="text-align: right;">' . numfmt_format_currency($fmt, $value3, $currency) . '</td>';
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
		echo "<p style='text-align: center;'> Total: <strong>" . numfmt_format_currency($fmt, $sum, $currency) . "</strong></p>";
		?>
		<div style="margin-top: 1.5em;">
		<button class="button" style="display: inline;" onclick='window.location.href = "edit.php"'>Edit</button> <button class="button button-outline" onclick='window.location.href = "upload.php"'>Upload</button>
		<div style="text-align: center; margin-top: 1.5em;"><?php echo $footer ?></div>
	</div>
</body>

</html>