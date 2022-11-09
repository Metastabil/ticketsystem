<?php
$path = 'http://' . $_SERVER['HTTP_HOST'] . '/projects/ticketsystem/';
$css_path = $path . 'assets/css/error.css';
$favicon_path = $path . 'assets/images/favicon.png';
?>

<!DOCTYPE HTML>
<html lang="en">
    <head>
        <title>Error | Tickets</title>
        <meta charset="utf-8" />
        <link rel="icon" type="image/png" href="<?= $favicon_path; ?>" />
        <link rel="stylesheet" type="text/css" href="<?= $css_path; ?>" />
    </head>
    <body>
        <h1>Ops! Something went wrong.</h1>
    </body>
</html>