<?php

$row = 1;
if (($handle = fopen("epc.csv", "r")) !== FALSE) {
    
    echo '<html lang="en">';
    echo '<head>';
    echo '<meta charset="utf-8">';
    echo '<meta name="viewport" content="width=device-width, initial-scale=1">';
    echo '<link href="favicon.png" rel="icon" type="image/png" />';
    echo '<link rel="stylesheet" href="https://unpkg.com/purecss@1.0.0/build/pure-min.css" integrity="sha384-nn4HPE8lTHyVtfCBi5yW9d20FjT8BJwUXyWZT9InLYax14RDjBj46LmSztkmNP9w" crossorigin="anonymous">';
    echo '<link rel="stylesheet" type="text/css" href="styles.css">';
    echo '<link href="http://fonts.googleapis.com/css?family=Lato" rel="stylesheet" type=text/css"">';
    echo '<title>Everyday Photo Carry</title>';
    echo '</head>';
    echo '<body>';
    echo '<div id="content">';
    echo '<h1>Everyday Photo Carry</h1>';
    echo '<table class="pure-table pure-table-horizontal">';
    
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
            echo '<td>' . $value0 . '</td>';
            echo '<td class="col1">' . $value1 . '</td>';
            echo '<td class="col2">' . $value2 . '</td>';
        }
        // }
        
        if ($row == 1) {
            echo '</tr></thead><tbody>';
        } else {
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
