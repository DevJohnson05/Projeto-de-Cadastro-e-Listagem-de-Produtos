<?php

namespace app\service;

class SessionService
{
     static public function startSession() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }
    static public function login(object $user) {
        self::startSession();
        $_SESSION['user'] = [
            'id' => $user->id,
            'username' => $user->name
        ];
    }
    static public function is_authenticated() {
        self::startSession();
        if (!isset($_SESSION['user']['id'])) {
            return false;
        }
        return true;
    }


    static public function setSessionData(string $key, mixed $value) {
        $_SESSION['user'][$key] = $value;
    }

    static public function getSessionData(string $key) {
        self::startSession();
        return $_SESSION['user'][$key] ?? null;
    }

    static public function logout() {
        self::startSession();
        session_destroy();
    }
}
