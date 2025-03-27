<?php
require_once "model/Database.php"; 
class AdminController {
    function index(){
        $titlePage = "Trang chủ admin";
        $mainview = "views/admin/dashboard.php";
        require_once "views/admin/layoutadmin.php";
    }
    
    function List_Sach(){
        $page_size = 2; 
        $page_num = 1; 
        if (isset($_GET['page_num'])==true) $page_num = $_GET['page_num']; 
        $db = new Database();
        $data_arr = $db->List_Sach($page_num, $page_size);    
        $so_record = $db->List_Sach_Dem();
        $so_trang = ceil($so_record/$page_size);    
        $titlePage ="Trang danh sách các sách";
        $mainview = "views/admin/list_sach.php";
        include "views/admin/layoutAdmin.php";
    }
    function Them_Sach(){
        $db = new Database;  
        $loai_arr = $db->Lay_List_Loai();
        $tacgia_arr =  $db->Lay_List_Tac_Gia();
        $nxb_arr =  $db->Lay_List_NXB();
        $loi = [];
        if ($_SERVER['REQUEST_METHOD']=="POST") {
            $loi = $db->Validate_Sach($_POST);
            if ($loi==[]){
                $db->Them_Sach($_POST);
                header("location:admin.php?page=list_sach"); 
                exit();
            }
        }
        $titlePage ="Trang thêm sách";
        $mainview=  "views/admin/them_sach.php";
        include "views/admin/layoutAdmin.php";
 }
 function sua_sach(){
    if ( isset($_GET['id']) == false ) die("Thiếu id sách rồi");
    $id = $_GET['id'];
    $db = new Database;
    $loi = [];
    if ( $_SERVER['REQUEST_METHOD']=="POST" ) {
        $loi = $db->Validate_Sach($_POST);
        if ($loi ==[]){
          $db->Sua_Sach($id, $_POST);
          header("location:admin.php?page=list_sach"); 
          exit();
        }
    }
    $sach = $db->Lay_1_Sach($id);
    $loai_arr = $db->Lay_List_Loai();
    $tacgia_arr =  $db->Lay_List_Tac_Gia();
    $nxb_arr =  $db->Lay_List_NXB();
    $titlePage ="Trang sửa sách";
    $mainview=  "views/admin/sua_sach.php";
    include "views/admin/layoutAdmin.php";
}
    
    function xoa_sach(){
        if (isset($_GET['id'])==false) die("Thiếu id sách rồi");
        $id = $_GET['id'];
        $db = new Database;
        $db->Xoa_Sach($id);
        header("location:admin.php?page=list_sach");
    }


    function list_loai() {
        $db = new Database();
        $data_arr = $db->List_loai();
        $titlePage = "Danh sách các loại";
        $mainview = "views/admin/list_loai.php";
        require_once "views/admin/layoutadmin.php";
    }
    
    function them_loai(){
        $db = new Database(); 
        $loi = [];
        if ($_SERVER['REQUEST_METHOD']=="POST") {
            $loi = $db->Validate_Loai($_POST);
            if ($loi == []){
                $db->Them_Loai($_POST);
                header("location:admin.php?page=list_loai"); 
                exit();
            }
        }
        $titlePage ="Trang thêm loại";
        $mainview =  "views/admin/them_loai.php";
        include "views/admin/layoutAdmin.php";
    }
    
    function sua_loai(){
        if (isset($_GET['id'])==false) die("Thiếu id loại rồi");
        $id = $_GET['id'];
        $db = new Database;
        $loi = [];        
        if ($_SERVER['REQUEST_METHOD']=="POST") {
            $loi = $db->Validate_Loai($_POST);
            if ($loi ==[]){
                $db->Sua_Loai($id, $_POST);
                header("location:admin.php?page=list_loai");
                exit();
            }
        }
        $loai = $db->Lay_1_Loai($id);
        $titlePage ="Trang sửa loại";
        $mainview=  "views/admin/sua_loai.php";
        include "views/admin/layoutAdmin.php";
    }  
    
    function xoa_loai(){
        if (isset($_GET['id'])==false) die("Thiếu id loại rồi");
        $id = $_GET['id'];
        $db = new Database;
        $db->Xoa_Loai($id);
        header("location:admin.php?page=list_loai");
    }









}
