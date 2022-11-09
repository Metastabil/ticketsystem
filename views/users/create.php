<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/projects/ticketsystem/shared.php';

$title = LANG['TabTitles']['UsersCreate'];

require_once dirname(__DIR__) . '/templates/header.php';

if (FormHelper::is_post_submitted()) {
    $data = [
        ApplicationHelper::make_string_safe($_POST['email']),
        password_hash($_POST['password'], PASSWORD_DEFAULT)
    ];

    if ($user->create($data)) {
        $_SESSION['success'] = LANG['Notifications']['SaveSuccess'];
    }
    else {
        $_SESSION['error'] = LANG['Notifications']['SaveError'];
    }

    header("Location: " . ApplicationHelper::create_redirect_link('users'));
    exit();
}
?>

<h1 class="default-title"><?= LANG['Users']['Titles']['Create']; ?></h1>

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
        'value' => '',
        'required' => 'required'
    ],
    [
        'type' => 'password',
        'name' => 'password',
        'id' => 'password',
        'title' => LANG['Users']['Attributes']['Password'],
        'placeholder' => LANG['Users']['Attributes']['Password'],
        'maxlength' => '255',
        'class' => '',
        'autocomplete' => 'off',
        'value' => '',
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
        'link' => ApplicationHelper::create_redirect_link('users'),
        'title' => LANG['Actions']['Cancel'],
        'text' => LANG['Actions']['Cancel'],
        'classes' => 'btn btn-cancel'
    ]
];

echo FormHelper::build_form($form, $inputs, $buttons);
?>