<?php 
namespace app\ExceptionsApp;

use Exception;

class ExceptionRota extends Exception
{
    public function __construct($message = "Rota não encontrada", $code = 404) {
        parent::__construct($message, $code);
    }
}
?>