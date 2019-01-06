<html lang='en'>
          <!-- Author: Dmitri Popov, dmpop@linux.com
          License: GPLv3 https://www.gnu.org/licenses/gpl-3.0.txt -->
    <head>
	<meta charset="utf-8">
	<title>Everyday Photo Carry</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="shortcut icon" href="favicon.png" />
	<link rel="stylesheet" href="https://unpkg.com/purecss@1.0.0/build/pure-min.css" integrity="sha384-nn4HPE8lTHyVtfCBi5yW9d20FjT8BJwUXyWZT9InLYax14RDjBj46LmSztkmNP9w" crossorigin="anonymous">
	<link href="http://fonts.googleapis.com/css?family=Lato" rel="stylesheet" type="text/css">
	<style>
	 #content {
             margin: 0px auto;
             text-align: center;
	     font: 15px "Lato", sans-serif;
         }
	 p {
	     font: 15px "Lato", sans-serif;
	 }
	 h1 {
	     font-family: "Lato", sans-serif; font-weight: 700; letter-spacing: 3px;
	     color: #68b5d1;
	 }
	 textarea {
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
