<?php
class Router {
    public static function route($url) {

        $controller = $_GET['controller'] ?? 'sinhVien';
        $action = $_GET['action'] ?? 'index';

        $controllerFile = "../app/controllers/" . ucfirst($controller) . "Controller.php";

        if (file_exists($controllerFile)) {
            require_once $controllerFile;
            $controllerClass = ucfirst($controller) . "Controller";
            $controllerInstance = new $controllerClass();

            if (method_exists($controllerInstance, $action)) {
                $controllerInstance->$action();
            } else {
                echo "404 - Action Not Found";
            }
        } else {
            echo "404 - Controller Not Found";
        }
    }
}
?>