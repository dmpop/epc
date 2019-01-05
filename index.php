<html lang="en">
    <head>
	<meta charset="utf-8">
	<title>Everyday Photo Carry</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="shortcut icon" type="image/PNG" href="favicon.png">
	<link rel="stylesheet" href="https://unpkg.com/purecss@1.0.0/build/pure-min.css" integrity="sha384-nn4HPE8lTHyVtfCBi5yW9d20FjT8BJwUXyWZT9InLYax14RDjBj46LmSztkmNP9w" crossorigin="anonymous">
	<link href="http://fonts.googleapis.com/css?family=Lato" rel="stylesheet" type="text/css">
	<style>
	 #content {
             margin: 0px auto;
             text-align: center;
         }
	 p {
	     font: 15px 'Lato', sans-serif;
	 }
	 h1 {
	     font-family: 'Lato', sans-serif; font-weight: 700; letter-spacing: 3px;
	     color: #cc6600;
	 }
	 img {
	     width:100%;
	     max-width:800px;
	     border-radius: 9px;
	 }
	 table {
	     font: 15px 'Lato', sans-serif;
	     border-spacing: 5px;
	     margin: 0px auto;
	     text-align: left;
	     width:100%;
	     max-width:800px;
	 }
	 th {
	     font-weight: 600;
	 }
	 td {
	     text-align: left;
	 }
	 td.col1 {
	     letter-spacing: 2px;
	     font-weight: 600;
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
	    <p><button onclick="sortTable()" >Sort</button></p>
	    <table id="theTable" class="pure-table pure-table-horizontal">
		<?php
		$CSVFILE = "epc.csv";
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
			    echo '<th>' . $value0 . '</th>';
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
	 function sortTable() {
	     var table, rows, switching, i, x, y, shouldSwitch;
	     table = document.getElementById('theTable');
	     switching = true;
	     while (switching) {
		 switching = false;
		 rows = table.rows;
		 for (i = 1; i < (rows.length - 1); i++) {
		     shouldSwitch = false;
		     x = rows[i].getElementsByTagName('TD')[0];
		     y = rows[i + 1].getElementsByTagName('TD')[0];
			 if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
			     shouldSwitch = true;
			     break;
			 }
		 }
		 if (shouldSwitch) {
		     rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
		     switching = true;
		 }
	     }
	 }
	</script>
    </body>
</html>
