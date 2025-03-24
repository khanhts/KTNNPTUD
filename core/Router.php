<?php
class Router {
    public static function route($url) {
        if ($url == "" || $url == "index") {
            require_once "../app/controllers/SinhVienController.php";
            $controller = new SinhVienController();
            $controller->index();
        } elseif ($url == "add") {
            require_once "../app/controllers/SinhVienController.php";
            $controller = new SinhVienController();
            $controller->add();
        }
        elseif ($url == "edit" && isset($_GET['id'])) {
            require_once "../app/controllers/SinhVienController.php";
            $controller = new SinhVienController();
            $controller->edit($_GET['id']);
        }
        else {
            echo "404 - Page Not Found";
        }
    }
}
?>