<?php

class HttpTools
{
    public static function reload() {
        header("Location: " . $_SERVER['REQUEST_URI']);
        exit;
    }

    public static function reloadWithoutParameters() {
        $pos = strpos($_SERVER['REQUEST_URI'], '?');
        if ($pos !== FALSE) {
            $url = substr($_SERVER['REQUEST_URI'], 0, $pos);
        } else {
            $url = $_SERVER['REQUEST_URI'];
        }
        header("Location: " . $url);
        exit;
    }

    /**
     * Funkce, ktera presmeruje uzivatele na jinou stranku.
     *
     * @param string $page
     */
    public static function redirect($page) {
        header("Location: " . FConfigBase::$config['root'] . $page);
        exit;
    }

}

?>
