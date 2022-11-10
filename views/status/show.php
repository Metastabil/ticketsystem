<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/projects/ticketsystem/shared.php';

if (strlen($_GET['id']) < 5) {
    ApplicationHelper::redirect_to_error();
}

$title = LANG['TabTitles']['StatusShow'];

require_once dirname(__DIR__) . '/templates/header.php';

$status_array = $status->get_by_id(intval($_GET['id']));
?>

    <h1 class="default-title"><?= LANG['Status']['Titles']['Show']; ?></h1>

<?php
$form = [
    'action' => ApplicationHelper::create_redirect_link('status/create'),
    'method' => 'post',
    'classes' => 'default-form'
];

$inputs = [
    [
        'type' => 'text',
        'name' => 'name',
        'id' => 'name',
        'title' => LANG['Status']['Attributes']['Name'],
        'placeholder' => LANG['Status']['Attributes']['Name'],
        'maxlength' => '255',
        'class' => '',
        'autocomplete' => 'off',
        'value' => $status_array['Name'],
        'required' => 'required',
        'disabled' => 'disabled'
    ]
];

$buttons = [
    [
        'type' => 'link',
        'name' => '',
        'link' => ApplicationHelper::create_redirect_link('status'),
        'title' => LANG['Actions']['Back'],
        'text' => LANG['Actions']['Back'],
        'classes' => 'btn btn-save'
    ]
];

echo FormHelper::build_form($form, $inputs, $buttons);
?>