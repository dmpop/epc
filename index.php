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
		<hr style="margin-top: 1.5em; margin-bottom: 1.5em;">
		<table id="theTable">
			<?php
			if (!extension_loaded('intl')) {
				die("<div>⚠️ The PHP intl extension is missing</div>");
			}
			if (!file_exists("img")) {
				mkdir("img", 0755, true);
			}
			if (!file_exists("bags")) {
				mkdir("bags", 0755, true);
				$header = "Photo; Item; Serial no.; Price(€); Type; Notes;\nphoto.jpeg; Cameral Model; XXXXXX-XXXX; 1000; Camera; Note goes here;";
				file_put_contents("bags/Default.csv", $header);
			}
			?>
			<select style="width: 20em;" name="" onchange="javascript:location.href = this.value;">
				<option selected="selected" value='Label'>Choose bag</option>";
				<?php
				$files = glob("bags/*.csv");
				setlocale(LC_ALL, 'C.UTF-8');
				foreach ($files as $file) {
					$option = basename($file, ".csv");
					echo "<option value='?bag=" . str_replace('\'', '&apos;', $option) . "'>" . $option . "</option>";
				}
				?>
			</select>
			<?php
			if (isset($_GET["bag"])) {
				$csvfile = "bags/" . $_GET["bag"] . ".csv";
				file_put_contents(".bag", $_GET["bag"]);
				echo "<h2 style='margin-top: 0.5em;'>" . $_GET["bag"] . "</h2>";
				$sum = 0;
				$row = 1;
				if (($handle = fopen($csvfile, "r")) !== FALSE) {
					while (($data = fgetcsv($handle, 0, ";")) !== FALSE) {
						if ($row == 1) {
							echo '<thead>
				<tr>';
						} else {
							echo '
				<tr>';
						}
						$value0 = $data[0];
						$value1 = $data[1];
						$value2 = $data[2];
						$value3 = $data[3];
						$sum += floatval($value3);
						$fmt = numfmt_create($locale, NumberFormatter::CURRENCY);
						$value4 = $data[4];
						if ($row == 1) {
							echo '<th class="sortable" onclick="sortTable(0)">' . $value1 . '</th>';
							echo '<th>' . $value2 . '</th>';
							echo '<th style="text-align: right;">' . $value3 . '</th>';
							echo '<th style="text-align: right;" class="sortable" onclick="sortTable(1)">' . $value4 . '</th>';
						} else {
							echo '<td></a> <a href="view.php?bag=' . $csvfile . '&item=' . $row . '">' . $value1 . '</a></td>';
							echo '<td style="letter-spacing: 2px; text-align: left; color: #c46c6cff;">' . $value2 . '</td>';
							echo '<td style="text-align: right;">' . numfmt_format_currency($fmt, $value3, $currency) . '</td>';
							echo '<td style="text-align: right;">' . $value4 . '</td>';
						}
						if ($row == 1) {
							echo '</tr>
			</thead>
			<tbody>';
						} else {
							echo '</tr>';
						}
						$row++;
					}
					fclose($handle);
				}
			} else {
				exit("<p>Choose a bag from the list above</p>");
			}
			?>
			</tbody>
		</table>
		<script>
			function sortTable(n) {
				var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
				table = document.getElementById("theTable");
				switching = true;
				dir = "asc";
				while (switching) {
					switching = false;
					rows = table.rows;
					for (i = 1; i < (rows.length - 1); i++) {
						shouldSwitch = false;
						x = rows[i].getElementsByTagName("TD")[n];
						y = rows[i + 1].getElementsByTagName("TD")[n];
						if (dir == "asc") {
							if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
								shouldSwitch = true;
								break;
							}
						} else if (dir == "desc") {
							if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
								shouldSwitch = true;
								break;
							}
						}
					}
					if (shouldSwitch) {
						rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
						switching = true;
						switchcount++;
					} else {
						if (switchcount == 0 && dir == "asc") {
							dir = "desc";
							switching = true;
						}
					}
				}
			}
		</script>
		<?php
		echo "<p style='text-align: center;'> Total: <strong>" . numfmt_format_currency($fmt, $sum, $currency) . "</strong></p>";
		?>
		<div style="margin-top: 1.5em;">
			<button class="button" style="display: inline;" onclick='window.location.href = "edit.php?bag=<?php echo $csvfile ?>"'>Edit</button> <button class="button button-outline" onclick='window.location.href = "upload.php"'>Upload</button>
			<hr style="margin-top: 1.5em; margin-bottom: 1.5em;">
			<div><?php echo $footer ?></div>
		</div>
</body>

</html>