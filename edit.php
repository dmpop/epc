<html lang='en'>
          <!-- Author: Dmitri Popov, dmpop@linux.com
          License: GPLv3 https://www.gnu.org/licenses/gpl-3.0.txt -->
    <head>
	<meta charset="utf-8">
	<title>Everyday Photo Carry</title>
	<link rel="shortcut icon" href="favicon.png" />
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/kognise/water.css@latest/dist/dark.min.css">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<style>
	 h1 {
	     letter-spacing: 3px;
	     color: #99ccff;
	 }
	 textarea {
	     font-size: 15px;
	     width:90%;
	     max-width:95%;
	     height:75%;
	 }
	</style>
    </head>
    <body>
	<h1>Everyday Photo Carry</h1>
	<form method="GET" action="index.php">
	    <p><button type="submit">Back</button></p>
        </form>
        <?php
        function Read() {
            $CSVFILE = "data.csv";
            echo file_get_contents($CSVFILE);
        }
        function Write() {
            $CSVFILE = "data.csv";
            $fp = fopen($CSVFILE, "w");
            $data = $_POST["text"];
            fwrite($fp, $data);
            fclose($fp);
        }
        ?>
        <?php
        if ($_POST["submit_check"]){
	    Write();
        };
        ?>
        <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
	    <textarea name="text"><?php Read(); ?></textarea><br /><br />
	    <input type="submit" name="submit" value="Save">
	    <input type="hidden" name="submit_check" value="1">
        </form>
	<?php
        if ($_POST["submit_check"]){
	    echo '<script language="javascript">';
	    echo 'alert("Changes have been saved.")';
	    echo '</script>';
        };
        ?>
        <p>Read the <a href="https://gumroad.com/l/linux-photography">Linux Photography</a> book</p>
    </body>
</html>
