<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/projects/ticketsystem/shared.php';

$title = LANG['TabTitles']['UsersIndex'];

require_once dirname(__DIR__) . '/templates/header.php';

$users = $user->get();
?>

<h1 class="default-title"><?= LANG['Users']['Titles']['Index']; ?></h1>

<a href="<?= ApplicationHelper::create_redirect_link('users/create'); ?>" title="<?= LANG['Actions']['Create']; ?>" class="btn btn-create">
    <?= LANG['Actions']['Create']; ?>
</a>

<div class="grid"></div>
