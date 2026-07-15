<?php
namespace app\service;

class AuthService

{
    public function validation_login(array $datas_login): bool|array {
        $sanitized = $this->sanitize_datas_login($datas_login);
        if (!$sanitized) {
            return false;
        }

        return $sanitized;
    }
    private function sanitize_datas_login(array $datas)  {
     
        foreach ($datas as $value) {
            if (!$value) {
                return false;
            }
        }
        if (!filter_var($datas['email'], FILTER_VALIDATE_EMAIL)) {
            return false;
        }
        $arrayFieldsAndValues = [
            'email' => filter_var($datas['email'], FILTER_SANITIZE_EMAIL),
            'password' => filter_var($datas['password'], FILTER_SANITIZE_SPECIAL_CHARS)
        ];

        return $arrayFieldsAndValues;
    }

    public function createRegisterUser(array $datas_Register_Login): bool|array {
        $sanitized = $this->sanitize_datas_register($datas_Register_Login);
        if (!$sanitized) {
            return false;
        }

        return $sanitized;
    }
    private function sanitize_datas_register(array $array_Datas_Register_Login) {
        if (empty($array_Datas_Register_Login)) {
            return false;
        }
        if (!filter_var($array_Datas_Register_Login['email'], FILTER_VALIDATE_EMAIL)) {
            return false;
        }
        $arrayFieldsAndValues = [
            'name' => filter_var($array_Datas_Register_Login['name'], FILTER_SANITIZE_SPECIAL_CHARS),
            'email' => filter_var($array_Datas_Register_Login['email'], FILTER_SANITIZE_EMAIL),
            'password' => filter_var($array_Datas_Register_Login['password'], FILTER_SANITIZE_SPECIAL_CHARS)
        ];

        return $arrayFieldsAndValues;
    }
}