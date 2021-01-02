<?php



class session {

    public static function init() {
        session_start();
    }

    public static function set($key, $value) {
        $_SESSION[$key] = $value;
    }

    public static function get($key) {
        if (isset($_SESSION[$key])) {
            return $_SESSION[$key];
        } else {
            return false;
        }
    }

    public static function checksession() {
        self::init();
        if (self::get('login') == false) {
            self::sessiondestroy();
        }
    }

    public static function sessiondestroy() {
        session_destroy();
        header("location:login.php");
    }
    public function unsetSession($name){
        unset($_SESSION[$name]);
    }

}

?>