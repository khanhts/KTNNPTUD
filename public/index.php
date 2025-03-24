<?php
require_once "../core/Router.php";

$page = $_GET['page'] ?? "";
Router::route($page);
?>