<?php
require_once 'config/config.php';
require_once 'helpers/helpers.php';

spl_autoload_register(function ($classname){
    require_once 'libs/' . $classname . '.php';
});