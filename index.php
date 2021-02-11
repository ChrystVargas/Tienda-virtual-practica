<?php
session_start();

require_once 'autoload.php';
require_once 'config/db.php';
require_once 'config/parameters.php';
require_once 'helpers/utils.php';
require_once 'views/layout/header.php';
require_once 'views/layout/sidebar.php';

function show_error(){
    $error = new ErrorController();
    $error->index();
}

if (isset($_GET['controller']) && isset($_GET['action'])) {
    $nombreControlador = $_GET['controller'].'Controller';
    $action = $_GET['action'];

    if (class_exists($nombreControlador)) {
        $controlador = new $nombreControlador();

        if (method_exists($controlador, $action)) {
            $controlador->$action();
        } else {
            show_error();
        }        
    } else {
        show_error();
    }
} else if (!isset($_GET['controller']) && !isset($_GET['action'])) {
    $nombreControlador = controller_default;
    $action = action_default;
    $controlador = new $nombreControlador();
    $controlador->$action();    
} else {
    show_error();
}

require_once 'views/layout/footer.php';
?>