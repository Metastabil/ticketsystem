<?php
class ApplicationHelper {
    public static function base_url() {
        return 'http://' . $_SERVER['SERVER_NAME'] . '/projects/ticketsystem/';
    }

    public static function create_redirect_link(string $destination) {
        $base_url = self::base_url();

        return $base_url . $destination;
    }

    public static function make_string_safe(string $string) {
        return htmlspecialchars(trim(strip_tags($string)));
    }

    public static function redirect_if_not_authenticated() {
        if (!isset($_SESSION['user'])) {
            header("Location: " . self::create_redirect_link('login'));
        }
    }

    public static function redirerct_to_error() {
        header("Location: " . self::create_redirect_link('error'));
    }
}