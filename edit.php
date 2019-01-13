<html lang='en'>
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
	 textarea {
	     font-size: 15px;
	     width:90%;
	     max-width:75%;
	     height:75%;
	 }
	</style>
    </head>
    <body>
	<div id="content">
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
	</div>
    </body>
</html>
