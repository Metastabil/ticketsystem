<?php
require_once __DIR__ . '/config.php';

session_start();

/* Classes */
require_once CLASSES_PATH . 'Database.class.php';
require_once CLASSES_PATH . 'User.class.php';
require_once CLASSES_PATH . 'Group.class.php';
require_once CLASSES_PATH . 'Status.class.php';

/* Helpers */
require_once HELPERS_PATH . 'Application.helper.php';
require_once HELPERS_PATH . 'Language.helper.php';
require_once HELPERS_PATH . 'Form.helper.php';

/* Call Helper Functions */
// ApplicationHelper::redirect_if_not_authenticated();
LanguageHelper::check_if_language_set();
LanguageHelper::check_if_language_change();

/* Constants */
define("LANG", LanguageHelper::language($_SESSION['language']));

/* Variables */
$database_class = new Database();
$connection = $database_class->connect();
$user = new User($connection);
$status = new Status($connection);