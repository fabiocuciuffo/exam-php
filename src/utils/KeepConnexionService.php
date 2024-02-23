<?php

class KeepConnexionService
{
    public static function keepConnexion()
    {
        session_start();
        if (!isset($_COOKIE['PHPSESSID'])) {
            header("Location: /");
            return;
        }
        if (!isset($_SESSION[$_COOKIE['PHPSESSID']]) && $_SERVER['REQUEST_URI'] === "/") {
            return;
        }
        if (!isset($_SESSION[$_COOKIE['PHPSESSID']]) ||  $_COOKIE['PHPSESSID'] !== $_SESSION[$_COOKIE['PHPSESSID']]) {
            header("Location: /");
            return;
        }
        if (isset($_SESSION[$_COOKIE['PHPSESSID']]) && $_SERVER['REQUEST_URI'] === "/") {
            header("Location: /produits/");
            return;
        }
        return;
    }
}
