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
    <style>
        h1 {
            letter-spacing: 3px;
            color: #99ccff;
        }

        textarea {
            font-size: 15px;
            width: 100%;
            max-width: 95%;
            height: 50%;
        }
    </style>
</head>

<body>
    <div style="text-align: center;">
        <img style="height: 3em;" src="favicon.svg" alt="logo" />
        <h1 style="margin-top: 0em; margin-bottom: 1em; letter-spacing: 3px; color: #cc6600;"><?php echo $title ?></h1>
        <button style="margin-bottom: 2em;" onclick='window.location.href = "index.php"'>Back</button>
        <div class="card" style="margin-top: 2em; margin-bottom: 1.5em;">
            <?php
            $CSVFILE = "data.csv";
            $handle = fopen($CSVFILE, "r");
            $row = (int) $_GET["item"];
            for($i = 1; $data = fgetcsv($handle, 1000, ";"); $i++) {
                if($i === $row) {
                    $value0 = $data[0];
                    $value1 = $data[1];
                    $value2 = $data[2];
                    $value3 = $data[3];
                    $value4 = $data[4];
                    echo '<h2 class=text-center" style="margin-top: 1em; margin-bottom: 1em;">' . $value1 . '</h2>';
                    echo '<div style="text-align: left;">';
                    echo '<img style="width: 100%;  border-radius: 7px; margin-top: 0.5em;" src="img/' . $value0 . '" />';
                    echo '<hr style="margin-top: 2em;">';
                    echo '<p><div style="color: gray;">Serial number:</div>' . $value2 . '</p>';
                    echo '<p><div style="color: gray;">Price (' . $currency . '):</div>' . number_format(floatval($value3), 2) . '</p>';
                    echo '<p><div style="color: gray;">Note:</div>' . $value4 . '</p>';
                    echo '</div>';
                }
            }
            ?>
        </div>
        <p style="font-size: 85%"><?php echo $footer ?></p>
    </div>
</body>

</html>