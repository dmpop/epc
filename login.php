<?php
$config = include('config.php');
$pw_hash = password_hash($password, PASSWORD_DEFAULT);

if ($protect) {
    session_start();
}

if (isset($_POST['password']) && password_verify($_POST['password'], $pw_hash)) {
    $_SESSION["password"] = $pw_hash;
    header('Location: index.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">

    <head>

        <meta name="viewport" content="width=device-width">
        <link rel="shortcut icon" href="favicon.png" />
        <link rel="stylesheet" href="css/milligram.min.css">
        <link rel="stylesheet" href="css/styles.css">
        <title><?php echo $title ?></title>
    </head>
</head>

<body>
    <div style="text-align: center;">
        <img style="height: 3em;" src="favicon.svg" alt="logo" />
        <h1 style="letter-spacing: 3px;"><?php echo $title ?></h1>
        <hr style="margin-top: 1.5em; margin-bottom: 1.5em;">
        <form action="" method="POST">
            <label>Password:</label>
            <input style="width: 15em;" type="password" name="password"><br />
            <button type="submit" name="submit">Log in</button>
        </form>
    </div>
</body>

</html>