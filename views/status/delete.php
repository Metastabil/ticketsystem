<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/projects/ticketsystem/shared.php';

if ($status->delete(intval($_GET['id']))) {
    $_SESSION['success'] = LANG['Notifications']['DeleteSuccess'];
}
else {
    $_SESSION['error'] = LANG['Notifications']['DeleteError'];
}

header("Location: " . ApplicationHelper::create_redirect_link('status'));
exit();