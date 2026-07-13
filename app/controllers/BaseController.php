<?php

namespace app\controllers;
use Slim\Views\Twig;
class BaseController
{

    protected function setView(string $name) {
        return $name.ETX_VIEWS;
    }

    protected function getView(){
        try {
            return Twig::create(DIR_VIEWS);
        } catch (\Throwable $e) {
            return $e->getMessage();
        }
    }
}
