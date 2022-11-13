<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/projects/ticketsystem/shared.php';

unset($_SESSION['user']);
header("Location: " . ApplicationHelper::create_redirect_link('login'));
exit();
?>