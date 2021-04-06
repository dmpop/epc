<?php
require_once('protect.php');
error_reporting(E_ERROR);
?>

<html lang='en'>
<!-- Author: Dmitri Popov, dmpop@linux.com
         License: GPLv3 https://www.gnu.org/licenses/gpl-3.0.txt -->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">

    <title>Everyday Photo Carry</title>
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
            width: 90%;
            max-width: 95%;
            height: 75%;
        }
    </style>
</head>

<body>
    <div style="text-align: center;">
        <h1 style="margin-top: 0em; margin-bottom: 1em;">Everyday Photo Carry</h1>
        <button style="margin-bottom: 2em;" onclick='window.location.href = "index.php"'>Back</button>
    </div>
    <?php
    function Read()
    {
        $CSVFILE = "data.csv";
        echo file_get_contents($CSVFILE);
    }
    function Write()
    {
        $CSVFILE = "data.csv";
        $fp = fopen($CSVFILE, "w");
        $data = $_POST["text"];
        fwrite($fp, $data);
        fclose($fp);
    }
    ?>
    <?php
    if (isset($_POST["save"])) {
        Write();
    };
    ?>
    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
        <textarea name="text"><?php Read(); ?></textarea>
        <br />
        <div style="text-align: center;">
            <button type="submit" name="save">Save</button>
    </form>
    <?php
    if (isset($_POST["save"])) {
        echo '<script language="javascript">';
        echo 'alert("Changes have been saved.")';
        echo '</script>';
    };
    ?>
    <p>Read the <a href="https://gumroad.com/l/linux-photography">Linux Photography</a> book</p>
    </div>
</body>

</html>