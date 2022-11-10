<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/projects/ticketsystem/shared.php';

if (FormHelper::is_post_submitted()) {
    $data = [
        ApplicationHelper::make_string_safe($_POST['name']),
        intval($_GET['id'])
    ];

    if ($status->update($data)) {
        $_SESSION['success'] = LANG['Notifications']['SaveSuccess'];
    }
    else {
        $_SESSION['error'] = LANG['Notifications']['SaveError'];
    }

    header("Location: " . ApplicationHelper::create_redirect_link('status'));
    exit();
}

$title = LANG['TabTitles']['StatusEdit'];

require_once dirname(__DIR__) . '/templates/header.php';

$status_array = $status->get_by_id(intval($_GET['id']));
?>

    <h1 class="default-title"><?= LANG['Status']['Titles']['Edit']; ?></h1>

<?php
$form = [
    'action' => ApplicationHelper::create_redirect_link('status/edit/' . intval($_GET['id'])),
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
        'required' => 'required'
    ]
];

$buttons = [
    [
        'type' => 'button',
        'name' => '',
        'link' => '',
        'title' => LANG['Actions']['Save'],
        'text' => LANG['Actions']['Save'],
        'classes' => 'btn btn-save'
    ],
    [
        'type' => 'link',
        'name' => '',
        'link' => ApplicationHelper::create_redirect_link('status'),
        'title' => LANG['Actions']['Cancel'],
        'text' => LANG['Actions']['Cancel'],
        'classes' => 'btn btn-cancel'
    ]
];

echo FormHelper::build_form($form, $inputs, $buttons);
?>