<?php
class LanguageHelper {
    public static function language(string $language) {
        return self::parse_language_json($language);
    }

    public static function parse_language_json(string $language) {
        if ($language === 'en') {
            $file_path = $path = $_SERVER['DOCUMENT_ROOT'] . '/projects/ticketsystem/language/en.json';

            return json_decode(file_get_contents($file_path), true);
        }
        elseif ($language === 'de') {
            $file_path = $path = $_SERVER['DOCUMENT_ROOT'] . '/projects/ticketsystem/language/de.json';

            return json_decode(file_get_contents($file_path), true);
        }
        else {
            $file_path = $path = $_SERVER['DOCUMENT_ROOT'] . '/projects/ticketsystem/language/en.json';

            return json_decode(file_get_contents($file_path), true);
        }
    }

    public static function check_if_language_set() {
        if (!isset($_SESSION['language'])) {
            $_SESSION['language'] = 'en';
        }
    }

    public static function check_if_language_change() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $_SESSION['language'] = (isset($_POST['language-select'])) ? $_POST['language-select'] : $_SESSION['language'];
        }
    }
}