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
        <button class="button button-outline" style="display: inline; margin-bottom: 2em;" onclick='window.location.href = "index.php?bag=<?php echo file_get_contents(".bag"); ?>"'>Back</button> <button style="margin-bottom: 2em;" onclick='window.location.href = "edit.php"'>Edit</button>
    </div>
    <div style="margin: 0 auto; max-width: 800px;">
        <?php
        $csvfile = $_GET["bag"];
        $handle = fopen($csvfile, "r");
        $row = (int) $_GET["item"];
        for ($i = 1; $data = fgetcsv($handle, 1000, ";"); $i++) {
            if ($i === $row) {
                $value0 = $data[0];
                $value1 = $data[1];
                $value2 = $data[2];
                $value3 = $data[3];
                $value4 = $data[4];
                $value5 = $data[5];
                $fmt = numfmt_create($locale, NumberFormatter::CURRENCY);
                echo '<h2 class=text-center" style="margin-top: 1em; margin-bottom: 1em;">' . $value1 . '</h2>';
                echo '<img style="border-radius: 7px; margin-top: 0.5em;" src="img/' . $value0 . '" />';
                echo '<hr style="margin-top: 2em;">';
                echo '<div><span style="color: gray;">Serial number:</span> <strong>' . $value2 . '</strong></div>';
                echo '<div><span style="color: gray;">Price:</span> <strong>' . numfmt_format_currency($fmt, $value3, $currency) . '</strong></div>';
                echo '<span style="color: gray;">Note:</span><em>' . $value5 . '</em>';
                echo '</div>';
            }
        }
        ?>
    </div>
    <hr style="margin-top: 1.5em; margin-bottom: 1.5em;">
    <div style="text-align: center;"><?php echo $footer ?></div>
    </div>
</body>

</html>