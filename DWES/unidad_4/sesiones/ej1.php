<?php
session_start();
//  Counter is increased when you reload the page and if 5 seconds have passed since the last time you reload the page the page its restarted

if (isset($_SESSION['counter'])) {
    if (time() - $_SESSION['counter'] > 5) {
        $_SESSION['counter'] = time();
        $_SESSION['counter2'] = 0;
    } else {
        $_SESSION['counter2']++;
    }
} else {
    $_SESSION['counter'] = time();
    $_SESSION['counter2'] = 0;
}

echo "Counter: " . $_SESSION['counter2'] . "<br>";


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
</body>

</html>