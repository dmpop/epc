<?php

$row = 1;
if (($handle = fopen("epc.csv", "r")) !== FALSE) {
    
    echo '<html lang="en">';
    echo '<head>';
    echo '<meta charset="utf-8">';
    echo '<meta name="viewport" content="width=device-width, initial-scale=1">';
    echo '<link href="favicon.png" rel="icon" type="image/png" />';
    echo '<link rel="stylesheet" type="text/css" href="styles.css">';
    echo '<link href="http://fonts.googleapis.com/css?family=Lato" rel="stylesheet" type=text/css"">';
    echo '</head>';
    echo '<body>';
    echo '<table border="0">';
    echo '<title>Everyday Photo Carry</title>';
    echo '<div id="content">';
    echo '<h1>Everyday Photo Carry</h1>';
    
    while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) {
        $num = count($data);
        if ($row == 1) {
            echo '<thead><tr>';
        }else{
            echo '<tr>';
        }
	
        for ($c=0; $c < $num; $c++) {
            if(empty($data[$c])) {
		$value = "&nbsp;";
            }else{
		$value = $data[$c];
            }
            if ($row == 1) {
                echo '<th>'.$value.'</th>';
            }else{
                echo '<td>'.$value.'</td>';
            }
        }
	
        if ($row == 1) {
            echo '</tr></thead><tbody>';
        }else{
            echo '</tr>';
        }
        $row++;
    }
    
    echo '</tbody></table>';
    echo '</body>';
    echo '</html>';
    fclose($handle);
}
?> 
