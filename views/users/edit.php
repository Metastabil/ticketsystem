<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/projects/ticketsystem/shared.php';

if (FormHelper::is_form_submitted()) {
    $data = [
        ApplicationHelper::make_string_safe($_POST['first-name']),
        ApplicationHelper::make_string_safe($_POST['last-name']),
        ApplicationHelper::make_string_safe($_POST['email']),
        intval($_POST['is-administrator']),
        intval($_GET['id'])
    ];

    if ($user->update($data)) {
        $_SESSION['success'] = LANG['Notifications']['SaveSuccess'];
    }
    else {
        $_SESSION['error'] = LANG['Notifications']['SaveError'];
    }

    header("Location: " . ApplicationHelper::create_redirect_link('users'));
    exit();
}

$title = LANG['TabTitles']['UsersEdit'];
$is_administrator_options[] = ['value' => 0, 'text' => LANG['DefaultSelectOptions']['No']];
$is_administrator_options[1] = ['value' => 1, 'text' => LANG['DefaultSelectOptions']['Yes']];
$user_array = $user->get(intval($_GET['id']));

require_once dirname(__DIR__) . '/templates/header.php';
?>
<h1 class="default-title"><?= LANG['Users']['Titles']['Create']; ?></h1>

<form action="<?= ApplicationHelper::create_redirect_link('users/edit/' . $user_array['id']); ?>" method="post" class="default-form">
    <?= FormHelper::build_input(['type' => 'text', 'name' => 'first-name', 'ids' => 'first-name', 'title' => LANG['Users']['Attributes']['FirstName'], 'placeholder' => LANG['Users']['Attributes']['FirstName'], 'maxlength' => 255, 'autocomplete' => 'off', 'value' => $user_array['first_name']]); ?>
    <?= FormHelper::build_input(['type' => 'text', 'name' => 'last-name', 'ids' => 'last-name', 'title' => LANG['Users']['Attributes']['LastName'], 'placeholder' => LANG['Users']['Attributes']['LastName'], 'maxlength' => 255, 'autocomplete' => 'off', 'value' => $user_array['last_name']]); ?>
    <?= FormHelper::build_input(['type' => 'email', 'name' => 'email', 'ids' => 'email', 'title' => LANG['Users']['Attributes']['Email'], 'placeholder' => LANG['Users']['Attributes']['Email'], 'maxlength' => 255, 'autocomplete' => 'off', 'value' => $user_array['email']]); ?>
    <?= FormHelper::build_select(['name' => 'is-administrator', 'ids' => 'is-administrator', 'options' => $is_administrator_options, 'selected' => $user_array['is_administrator']]); ?>
    <div class="default-button-row">
        <?= FormHelper::build_button(['type' => 'button', 'name' => LANG['Actions']['Save'], 'title' => LANG['Actions']['Save'], 'text' => LANG['Actions']['Save'], 'classes' => 'btn btn-save']); ?>
        <?= FormHelper::build_button(['type' => 'link', 'link' => ApplicationHelper::create_redirect_link('users'), 'title' => LANG['Actions']['Cancel'], 'text' => LANG['Actions']['Cancel'], 'classes' => 'btn btn-cancel']); ?>
    </div>
</form>

<?php
require_once dirname(__DIR__) . '/templates/footer.php';
?>