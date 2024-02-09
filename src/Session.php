<?php

namespace TreptowKolleg\Api;

use JetBrains\PhpStorm\NoReturn;

class Session
{


    public function __construct()
    {
        if(session_status() !== PHP_SESSION_ACTIVE ) {
            session_start();
        }
    }

    /**
     * Zerstört die aktuelle Sitzung und alle enthaltenen Session-Elemente.
     */
    #[NoReturn]
    public function destroy(string $redirectUrl)
    {
        session_destroy();
        header("Location: $redirectUrl", true, 302);
        exit;
    }

    /**
     * Setzt ein neues Element.
     * @param string $key Schlüssel des Elements
     * @param mixed $value Wert des Elements
     */
    public function set(string $key, $value)
    {
        $_SESSION[$key] = $value;
    }

    /**
     * Fügt ein neues Element hinzu.
     * @param mixed $value Wert des Elements
     * @param string|null $key optionaler Schlüssel des Elements
     */
    public function add($value, string $key = null)
    {
        if($key) {
            $_SESSION[$key][] = $value;
        } else {
            $_SESSION[] = $value;
        }
    }

    /**
     * Gibt Element aus Array zurück. Element wird nicht-zerstörend gelesen.
     * @param string $key Schlüssel des Elements
     * @return mixed Element
     */
    public function get(string $key)
    {
        return array_key_exists($key, $_SESSION) ? $_SESSION[$key] : false;
    }

    /**
     * Gibt erstes Element aus Array zurück. Element wird zerstörend gelesen.
     * @param string $key Schlüssel des Elements
     * @return mixed Element
     */
    public function shift(string $key)
    {
        if(array_key_exists($key, $_SESSION) and is_array($_SESSION[$key])) {
            return array_shift($_SESSION[$key]);
        }
        return false;
    }

    /**
     * Gibt letztes Element aus Array zurück. Element wird zerstörend gelesen.
     * @param string $key Schlüssel des Elements
     * @return mixed Element
     */
    public function pop(string $key)
    {
        if(array_key_exists($key, $_SESSION) and is_array($_SESSION[$key])) {
            return array_pop($_SESSION[$key]);
        }
        return false;
    }

    /**
     * Entfernt Element aus Array, ohne es zu lesen.
     * @param string $key Schlüssel des Elements
     */
    public function remove(string $key)
    {
       if(array_key_exists($key, $_SESSION)) {
           unset($_SESSION[$key]) ;
       }
    }

}
