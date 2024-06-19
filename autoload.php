<?
spl_autoload_register(function($class) {
    include DIR . strtolower($class) . '.php';
});
