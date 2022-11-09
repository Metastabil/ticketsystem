<?php
session_start();

$path = $_SERVER['DOCUMENT_ROOT'] . '/projects/ticketsystem/';

/* Classes */
require_once $path . 'classes/Database.class.php';
require_once $path . 'classes/User.class.php';

/* Helpers */
require_once $path . 'helpers/Application.helper.php';
require_once $path . 'helpers/Language.helper.php';
require_once $path . 'helpers/Form.helper.php';

/* Variables */
LANG = LanguageHelper::language('en');
$database_class = new Database();
$connection = $database_class->connect('development');
$user = new User($connection);
$title = LANG['TabTitles']['Login'];

if (FormHelper::is_post_submitted()) {
    $data = [
        'email' => ApplicationHelper::make_string_safe($_POST['email']),
        'password' => $_POST['password']
    ];

    var_dump(!$user->check_credentials($data));
    exit();

    if (!$user->check_credentials($data)) {
       $_SESSION['error'] = LANG['Notifications']['WrongCredentials'];
       // header("Location: " . ApplicationHelper::create_redirect_link('login'));
    }
    else {
        // header("Location: " . ApplicationHelper::create_redirect_link('users'));
    }

    print_r($_SESSION);
}
?>

<!DOCTYPE HTML>
<html lang="en">
    <head>
        <title><?= $title; ?></title>
        <meta charset="utf-8" />
        <link rel="icon" type="image/png" href="<?= ApplicationHelper::base_url(); ?>assets/images/favicon.png" />
        <link rel="stylesheet" type="text/css" href="<?= ApplicationHelper::base_url(); ?>assets/css/sessions.css" />
    </head>
    <body>
        <div id="content">
            <h1><?= LANG['Sessions']['Titles']['Login']; ?></h1>
            <form action="<?= ApplicationHelper::create_redirect_link('login'); ?>" method="post">
                <input type="email" name="email" id="email" title="<?= LANG['Users']['Attributes']['Email']; ?>" placeholder="<?= LANG['Users']['Attributes']['Email']; ?>" maxlength="255" required="required" autocomplete="off" />
                <input type="password" name="password" id="password" title="<?= LANG['Users']['Attributes']['Password']; ?>" placeholder="<?= LANG['Users']['Attributes']['Password']; ?>" maxlength="255" required="required" />
                <button title="<?= LANG['Actions']['Login']; ?>">
                    <?= LANG['Actions']['Login']; ?>
                </button>
            </form>
        </div>
    </body>
</html>
