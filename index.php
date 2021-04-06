<?php
require_once('protect.php');
?>

<html lang="en">
<!-- Author: Dmitri Popov, dmpop@linux.com
         License: GPLv3 https://www.gnu.org/licenses/gpl-3.0.txt -->

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

	<title>Everyday Photo Carry</title>
	<link rel="shortcut icon" href="favicon.png" />
	<link rel="stylesheet" href="css/classless.css">
	<link href="css/featherlight.min.css" type="text/css" rel="stylesheet" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<style>
		h1 {
			letter-spacing: 3px;
			color: #99ccff;
		}

		img {
			width: 100px;
			max-width: 800px;
			border-radius: 9px;
		}

		td.col0 {
			text-align: left;
		}

		td.col1 {
			letter-spacing: 2px;
			text-align: left;
			color: #3399ff;
		}

		td.col2 {
			font-style: italic;
			text-align: left;
		}

		th {
			text-align: left;
		}
	</style>
</head>

<body>
	<script src="js/jquery.min.js"></script>
	<script src="js/featherlight.min.js" type="text/javascript" charset="utf-8"></script>
	<div style="text-align: center;">
		<h1 style="margin-top: 0em; margin-bottom: 1.5em;">Everyday Photo Carry</h1>
	</div>
	<table>
		<?php
		$CSVFILE = "data.csv";
		if (!is_file($CSVFILE)) {
			$HEADER = "Photo;Item;Serial no.;Notes\nCameral Model;XXXXXX-XXXX;Note goes here";
			file_put_contents($CSVFILE, $HEADER);
		}
		$row = 1;
		if (($handle = fopen($CSVFILE, "r")) !== FALSE) {
			while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) {
				$num = count($data);
				if ($row == 1) {
					echo '<thead><tr>';
				} else {
					echo '<tr>';
				}
				if (empty($data[0])) {
					$value = "&nbsp;";
				} else {
					$value0 = $data[0];
					$value1 = $data[1];
					$value2 = $data[2];
					$value3 = $data[3];
				}
				if ($row == 1) {
					echo '<th style="text-align: center;">' . $value0 . '</th>';
					echo '<th>' . $value1 . '</th>';
					echo '<th>' . $value2 . '</th>';
					echo '<th>' . $value3 . '</th>';
				} else {
					if ($value0 == 'na') {
						echo '<td><a href="img/andi.jpeg" data-featherlight="image"><img src="img/andi.jpeg"/></a></td>';
					} else {
						echo '<td><a href="img/' . $value0 . '" data-featherlight="image"><img src="img/' . $value0 . '"/></a></td>';
					}
					echo '<td class="col0">' . $value1 . '</td>';
					echo '<td class="col1">' . $value2 . '</td>';
					echo '<td class="col2">' . $value3 . '</td>';
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
	<div style="text-align: center;">
		<button style="display: inline;" onclick='window.location.href = "edit.php"'>Edit</button> <button onclick='window.location.href = "upload.php"'>Upload</button>
		<p>Read the <a href='https://gumroad.com/l/linux-photography'>Linux Photography</a> book</p>
	</div>
</body>

</html>