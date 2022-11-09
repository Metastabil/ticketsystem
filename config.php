<?php
/*
 * Defines the environment of the project
 * Change it to production when deploying the project
 */
const ENVIRONMENT = 'development';

/*
 * Defines the path to your project.
 * Only edit the second part of PROJECT_PATH and always end with /
 * or the system will crash
 */
define("DOCUMENT_ROOT", $_SERVER['DOCUMENT_ROOT']);
const PROJECT_PATH = DOCUMENT_ROOT . '/projects/ticketsystem/';

/*
 * Defines your database configuration
 * Currently it's not possible to use another database than MySQL
 */
const DATABASE_HOST = 'localhost';
const DATABASE_NAME = 'ticketsystem';
const DATABASE_USER = 'root';
const DATABASE_PASSWORD = '';

/*
 * Defines the paths to classes and helpers
 * Don't edit these or the system may crash
 */
const CLASSES_PATH = PROJECT_PATH . 'classes/';
const HELPERS_PATH = PROJECT_PATH . 'helpers/';