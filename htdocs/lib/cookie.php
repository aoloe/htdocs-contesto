<?php
class Cookie {
    public static function factory() {return new Cookie();}
    public function set($name, $value, $time = null) {
        if (is_null($time)) {$time = 157680000;} // + 5 * 365 * 24 * 60 * 60
        setcookie($name, $value, time() + $time);
    }
    public function is($name) {
        return array_key_exists($name, $_COOKIE);
    }
    public function get($name) {
        return array_key_exists($name, $_COOKIE) ? $_COOKIE[$name] : null;
    }
    public function delete($name) {
        setcookie($name, "", time() - 3600);
    }
}

