<?php

if((isset($_REQUEST["android_request"])) && ($_REQUEST["android_request"] == "true")){
    require_once  __DIR__.DIRECTORY_SEPARATOR.'ExchangeAndroidClasses\AndroidController.php';
    $androidController = new \ExchangeAndroidClasses\AndroidController();
    $androidController->executeRequest($_REQUEST);
    exit();
}
