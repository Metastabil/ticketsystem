<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/projects/ticketsystem/shared.php';

if (FormHelper::is_form_submitted()) {
    $data = [
        password_hash($_POST['password'], PASSWORD_DEFAULT),
        intval($_GET['id'])
    ];

    if ($user->update_password($data)) {
        $_SESSION['success'] = LANG['Notifications']['SaveSuccess'];
    }
    else {
        $_SESSION['error'] = LANG['Notifications']['SaveError'];
    }

    header("Location: " . ApplicationHelper::create_redirect_link('users'));
    exit();
}

$title = LANG['TabTitles']['UsersPassword'];
$is_administrator_options[] = ['value' => 0, 'text' => LANG['DefaultSelectOptions']['No']];
$is_administrator_options[1] = ['value' => 1, 'text' => LANG['DefaultSelectOptions']['Yes']];
$user_array = $user->get(intval($_GET['id']));

require_once dirname(__DIR__) . '/templates/header.php';
?>

<h1 class="default-title"><?= LANG['Users']['Titles']['Password']; ?></h1>

<form action="<?= ApplicationHelper::create_redirect_link('users/password/' . $user_array['id']); ?>" method="post" class="default-form">
    <?= FormHelper::build_input(['type' => 'password', 'name' => 'password', 'ids' => 'password', 'title' => LANG['Users']['Attributes']['Password'], 'placeholder' => LANG['Users']['Attributes']['Password'], 'maxlength' => 255, 'autocomplete' => 'off']); ?>
    <div class="default-button-row">
        <?= FormHelper::build_button(['type' => 'button', 'name' => LANG['Actions']['Save'], 'title' => LANG['Actions']['Save'], 'text' => LANG['Actions']['Save'], 'classes' => 'btn btn-save']); ?>
        <?= FormHelper::build_button(['type' => 'link', 'link' => ApplicationHelper::create_redirect_link('users'), 'title' => LANG['Actions']['Cancel'], 'text' => LANG['Actions']['Cancel'], 'classes' => 'btn btn-cancel']); ?>
    </div>
</form>

<?php
require_once dirname(__DIR__) . '/templates/footer.php';
?>