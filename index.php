<html lang="en">
    <!-- Author: Dmitri Popov, dmpop@linux.com
         License: GPLv3 https://www.gnu.org/licenses/gpl-3.0.txt -->
    <head>
	<meta charset="utf-8">
	<title>Everyday Photo Carry</title>
	<link rel="shortcut icon" href="favicon.png" />
	<link rel="stylesheet" href="milligram.min.css">
	<link rel="stylesheet" href="//fonts.googleapis.com/css?family=Roboto:300,300italic,700,700italic">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<style>
	 #content {
             margin: 0px auto;
             text-align: center;
         }
	 h1 {
	     letter-spacing: 3px;
	     color: #cc6600;
	 }
	 img {
	     width:100%;
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
	<div id="content">
	    <h1>Everyday Photo Carry</h1>
	    <table id="theTable" class="pure-table pure-table-horizontal">
		<?php
		$CSVFILE = "data.csv";
		$PHOTO="epc.jpg";
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
			}
			if ($row == 1) {
			    echo '<th class="sortable" onclick="sortTable(0)">' . $value0 . '</th>';
			    echo '<th>' . $value1 . '</th>';
			    echo '<th>' . $value2 . '</th>';
			} else {
			    echo '<td>'.$value0.'</td>';
			    echo '<td class="col1">'.$value1.'</td>';
    			    echo '<td class="col2">'.$value2.'</td>';
			}
			// }
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
	    <?php
	    if (file_exists($PHOTO)) {
	    echo "<br/><img src='epc.jpg'>";
	    }
	    ?>
	    <p>Read the <a href='https://gumroad.com/l/linux-photography'>Linux Photography</a> book</p>
	</div>
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
			     shouldSwitch= true;
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
		     switchcount ++;      
		 } else {
		     if (switchcount == 0 && dir == "asc") {
			 dir = "desc";
			 switching = true;
		     }
		 }
	     }
	 }
	</script>
    </body>
</html>
