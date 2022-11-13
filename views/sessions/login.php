<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/projects/ticketsystem/shared.php';

$title = LANG['TabTitles']['Login'];
$error = '';

if (FormHelper::is_form_submitted()) {
    $data = [
        'email' => $_POST['email'],
        'password' => $_POST['password']
    ];

    if ($user->check_credentials($data)) {
        header("Location: " . ApplicationHelper::create_redirect_link('users'));
        exit();
    }
    else {
        $error = LANG['Notifications']['WrongCredentials'];

        print($error);
    }
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
                <?= FormHelper::build_input(['type' => 'email', 'name' => 'email', 'ids' => 'email', 'title' => LANG['Users']['Attributes']['Email'], 'placeholder' => LANG['Users']['Attributes']['Email'], 'maxlength' => 255, 'autocomplete' => 'off', 'required' => 'required']); ?>
                <?= FormHelper::build_input(['type' => 'password', 'name' => 'password', 'ids' => 'password', 'title' => LANG['Users']['Attributes']['Password'], 'placeholder' => LANG['Users']['Attributes']['Password'], 'required' => 'required']); ?>
                <div class="button-row">
                    <?= FormHelper::build_button(['type' => 'button', 'title' => LANG['Actions']['Login'], 'text' => LANG['Actions']['Login'], 'classes' => 'btn btn-save']); ?>
                </div>
            </form>
        </div>
    </body>
</html>
