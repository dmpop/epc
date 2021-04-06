<?php
/* Your password */
$password = 'c0wpat33';

/* Redirects here after login */
$redirect_after_login = 'index.php';

/* Set timezone to UTC */

date_default_timezone_set('UTC');

/* Will not ask password again for */
$remember_password = strtotime('+30 days'); // 30 days

if (isset($_POST['password']) && $_POST['password'] == $password) {
    setcookie("password", $password, $remember_password);
    header('Location: ' . $redirect_after_login);
    exit;
}
?>
<!DOCTYPE html>
<html>
    <head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<head>
	    
	    <meta name="viewport" content="width=device-width">
	    <link rel="shortcut icon" href="favicon.png" />
	    <link rel="stylesheet" href="css/classless.css">
	    <title>Everyday Photo Carry</title>
	</head>
    </head>
    <body>
        <form method="POST">
	    Password:  <input type="password" name="password">
        </form>
    </body>
</html>
