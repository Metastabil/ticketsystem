<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/projects/ticketsystem/shared.php';

$title = LANG['TabTitles']['UsersShow'];

require_once dirname(__DIR__) . '/templates/header.php';

$user_array = $user->get(intval($_GET['id']));
$is_administrator_options[] = ['value' => 0, 'text' => LANG['DefaultSelectOptions']['No']];
$is_administrator_options[1] = ['value' => 1, 'text' => LANG['DefaultSelectOptions']['Yes']];
?>

<h1 class="default-title"><?= LANG['Users']['Titles']['Show']; ?></h1>

<form action="<?= ApplicationHelper::create_redirect_link('users/edit/' . $user_array['id']); ?>" method="post" class="default-form">
    <?= FormHelper::build_input(['type' => 'text', 'name' => 'first-name', 'ids' => 'first-name', 'title' => LANG['Users']['Attributes']['FirstName'], 'placeholder' => LANG['Users']['Attributes']['FirstName'], 'maxlength' => 255, 'autocomplete' => 'off', 'value' => $user_array['first_name'], 'disabled' => 'disabled']); ?>
    <?= FormHelper::build_input(['type' => 'text', 'name' => 'last-name', 'ids' => 'last-name', 'title' => LANG['Users']['Attributes']['LastName'], 'placeholder' => LANG['Users']['Attributes']['LastName'], 'maxlength' => 255, 'autocomplete' => 'off', 'value' => $user_array['last_name'], 'disabled' => 'disabled']); ?>
    <?= FormHelper::build_input(['type' => 'email', 'name' => 'email', 'ids' => 'email', 'title' => LANG['Users']['Attributes']['Email'], 'placeholder' => LANG['Users']['Attributes']['Email'], 'maxlength' => 255, 'autocomplete' => 'off', 'value' => $user_array['email'], 'disabled' => 'disabled']); ?>
    <?= FormHelper::build_select(['name' => 'is-administrator', 'ids' => 'is-administrator', 'options' => $is_administrator_options, 'selected' => $user_array['is_administrator'], 'disabled' => 'disabled']); ?>
    <div class="default-button-row">
        <?= FormHelper::build_button(['type' => 'link', 'link' => ApplicationHelper::create_redirect_link('users'), 'title' => LANG['Actions']['Back'], 'text' => LANG['Actions']['Back'], 'classes' => 'btn btn-save']); ?>
    </div>
</form>

<?php
require_once dirname(__DIR__) . '/templates/footer.php';
?>