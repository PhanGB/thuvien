<?php
session_start();
require_once "config.php";
require_once "controller/SiteController.php";
$controller = new SiteController();
$page = isset($_GET['page'])? $_GET['page'] : "index";
if (method_exists($controller, $page)==true) 
   $controller->$page();
else
   echo '<h1>Không tồn tại trang này</h1>';
