<?php
session_start();


if (isset($_SESSION['email'])==false){
    $_SESSION['thong_bao'] = "Bạn chưa đăng nhập mà. 
    <p><a href='index.php?page=dang_nhap'>Đăng nhập</a></p>";
    $_SESSION['back'] = $_SERVER['REQUEST_URI'];
    header("location:index.php?page=thong_bao"); 
    exit();
}
if ($_SESSION['role']!=1){
    $_SESSION['thong_bao'] = "Bạn cần đăng nhập với quyền admin. 
    <p><a href='index.php?page=dang_nhap'>Đăng nhập</a></p>";
    $_SESSION['back'] = $_SERVER['REQUEST_URI'];
    header("location:index.php?page=thong_bao"); 
    exit();
}




require_once "config.php";
require_once "controller/AdminController.php";
$controller = new AdminController();
$page = isset($_GET['page'])? $_GET['page']: "index";
if (method_exists($controller, $page)==true) 
$controller->$page();
else  echo '<h1>Không tồn tại trang này</h1>';
