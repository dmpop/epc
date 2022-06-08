<?php
error_reporting(E_ERROR);
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
    <link rel="stylesheet" href="css/popup.css">
    <script src="js/popup.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
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
        <h1 style="margin-top: 0em; letter-spacing: 3px;"><?php echo $title ?></h1>
        <hr style="margin-top: 1.5em; margin-bottom: 1.5em;">
        <button class="button button-outline" style="margin-bottom: 1.5em;" onclick='window.location.href = "index.php"'>Back</button>
        <?php
        function Read()
        {
            $csvfile = "data.csv";
            echo file_get_contents($csvfile);
        }
        function Write()
        {
            $csvfile = "data.csv";
            $fp = fopen($csvfile, "w");
            $data = $_POST["text"];
            fwrite($fp, $data);
            fclose($fp);
        }
        ?>
        <?php
        if (isset($_POST["save"])) {
            Write();
            echo "<script>";
            echo 'popup("Changes have been saved");';
            echo "</script>";
        };
        ?>
        <div class="card">
            <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
                <textarea style="margin-top: 1em;" name="text"><?php Read(); ?></textarea>
                <br />
                <button style="margin-top: 1em;" type="submit" name="save">Save</button>
            </form>
        </div>
        <hr style="margin-top: 1.5em; margin-bottom: 1.5em;">
        <div><?php echo $footer ?></div>
    </div>
</body>

</html>