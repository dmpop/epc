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
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/kognise/water.css@latest/dist/dark.min.css">
	<link href="//cdn.jsdelivr.net/npm/featherlight@1.7.14/release/featherlight.min.css" type="text/css" rel="stylesheet" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<style>
	 h1 {
	     letter-spacing: 3px;
	     color: #99ccff;
	 }
	 img {
	     width:100px;
	     max-width:800px;
	     border-radius: 9px;
	 }
	 table {
	     border-spacing: 5px;
	     margin: 0px auto;
	     text-align: left;
	     width:100%;
	     max-width:800px;
	 }
	 .sortable {
	     cursor: pointer;
	 }
	 td.col1 {
	     letter-spacing: 2px;
	     text-align: left;
	     color: #3399ff;
	 }
	 td.col2 {
	     font-style: italic;
	 }
	</style>
    </head>
    <body>
	<script src="//code.jquery.com/jquery-latest.js"></script>
	<script src="//cdn.jsdelivr.net/npm/featherlight@1.7.14/release/featherlight.min.js" type="text/javascript" charset="utf-8"></script>
	<h1>Everyday Photo Carry</h1>
	<table id="theTable" class="pure-table pure-table-horizontal">
	    <?php
	    $CSVFILE = "data.csv";
	    if(!is_file($CSVFILE))
	    {
		$HEADER = "Photo;Item;Serial no.;Notes\nandi.jpeg;Cameral Model;XXXXXX-XXXX;Note goes here";
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
			echo '<th>' . $value0 . '</th>';
			echo '<th>' . $value1 . '</th>';
			echo '<th>' . $value2 . '</th>';
			echo '<th>' . $value3 . '</th>';
		    } else {
			if ($value0=='na'){
			    echo '<td><a href="img/andi.jpeg" data-featherlight="image"><img src="img/andi.jpeg"/></a></td>';
			} else {
			    echo '<td><a href="img/'.$value0.'" data-featherlight="image"><img src="img/'.$value0.'"/></a></td>';
			}
			echo '<td>'.$value1.'</td>';
    			echo '<td class="col1">'.$value2.'</td>';
    			echo '<td class="col2">'.$value3.'</td>';
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
        <form method='GET' action='edit.php'>
	    <p><button type='submit'>Edit</button></p>
        </form>
	<p>Read the <a href='https://gumroad.com/l/linux-photography'>Linux Photography</a> book</p>
    </body>
</html>
