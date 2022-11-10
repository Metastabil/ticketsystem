<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/projects/ticketsystem/shared.php';

$title = LANG['TabTitles']['UsersEdit'];

require_once dirname(__DIR__) . '/templates/header.php';

$users_array = $user->get_by_id(intval($_GET['id']));
?>

<h1 class="default-title"><?= LANG['Users']['Titles']['Edit']; ?></h1>

<?php
$form = [
    'action' => ApplicationHelper::create_redirect_link('users/create'),
    'method' => 'post',
    'classes' => 'default-form'
];

$inputs = [
    [
        'type' => 'email',
        'name' => 'email',
        'id' => 'email',
        'title' => LANG['Users']['Attributes']['Email'],
        'placeholder' => LANG['Users']['Attributes']['Email'],
        'maxlength' => '255',
        'class' => '',
        'autocomplete' => 'off',
        'value' => $users_array['Email'],
        'required' => 'required',
        'disabled' => 'disabled'
    ]
];

$buttons = [
    [
        'type' => 'link',
        'name' => '',
        'link' => ApplicationHelper::create_redirect_link('users'),
        'title' => LANG['Actions']['Back'],
        'text' => LANG['Actions']['Back'],
        'classes' => 'btn btn-save'
    ]
];

echo FormHelper::build_form($form, $inputs, $buttons);
?>
