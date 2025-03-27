<?php
require_once "model/Database.php";
class SiteController{
    public $loai_arr = [];
    function __construct(){
        $db = new Database();
        $this->loai_arr = $db->Lay_Loai();
    }
    function test(){
        $db = new Database();
        $titlePage = "Test";
        $tinh_arr = $db->Lay_Tinh();
        $mainview = "test.php";
        include "views/layout.php";
    }
    function huyen_trong_tinh(){
        $db = new Database();
        if (isset($_GET['id'])==false) die("Thiếu id tỉnh rồi");
        $id = $_GET['id'];
        $huyen_arr = $db->Lay_Huyen_Trong_Tinh($id);
        include "views/huyen_trong_tinh.php";
    }
    function index() {
        $db = new Database();
        $moi_arr = $db->Sach_Moi(8);
        $xemnhieu_arr = $db->Sach_Xem_Nhieu(8);
        $titlePage = "Thư viện sách hay";
        $mainview = "home.php";
        include "views/layout.php";
    }
    function chi_tiet(){
        if (isset($_GET['id'])==false) die("Thiếu id sách rồi");
        $id = $_GET['id'];
        $db = new Database;
        $loi = [];
        if ( $_SERVER['REQUEST_METHOD']=="POST") {
            $loi = $db->Validate_Binh_Luan($_POST);
            if ($loi==[]){
                $db->Luu_Binh_Luan($_POST);
                header("location:" . $_SERVER['REQUEST_URI']);
                exit();
            }
            
        } //if
        $db->Tang_So_Lan_Xem($id);
        $row = $db->Chi_Tiet($id);
        if ($row==null) die("Không tồn tại sách $id ");
        $lienquan_arr = $db->Sach_Lien_Quan($id, 6);
        $binhluan_arr = $db->Binh_Luan_Cua_Sach($id);
        $titlePage = $row['ten'];
        $mainview = "views/chi_tiet.php";
        include "views/layout.php";
    }//chi_tiet
    function sach_trong_loai(){
        if (isset($_GET['id'])==false) die("Thiếu id loại rồi");
        $id = $_GET['id']; 
        $db = new Database;
        $page_size = 4;  
        $page_num = 1; 
        if (isset($_GET['page_num'])==true) $page_num = $_GET['page_num']; 
        $data_arr = $db->Sach_Trong_Loai($id, $page_size, $page_num);    
        $so_record = $db->Sach_Trong_Loai_Dem($id);
        $so_trang = ceil($so_record/$page_size);          
        $ten_loai = $db->Lay_Ten_Loai($id);
        $titlePage = "Sách trong loại $ten_loai";
        $mainview = "views/sach_trong_loai.php";
        include "views/layout.php";
    }
    function tim_kiem(){
        if (isset($_GET['tu_khoa'])==false) die("Thiếu tu_khoa rồi");
        $tu_khoa = $_GET['tu_khoa']; 
        $page_size = 4;   
        $page_num = 1; 
        if (isset($_GET['page_num'])==true) $page_num = $_GET['page_num'];
        $db = new Database;
        $data_arr = $db->Tim_Kiem($tu_khoa, $page_size, $page_num);        
        $so_record = $db->Tim_Kiem_Dem($tu_khoa);
        $so_trang = ceil($so_record/$page_size);
        $titlePage = "Tìm kiếm theo từ khóa $tu_khoa";
        $mainview = "views/tim_kiem.php";
        include "views/layout.php";
    }
    function dang_ky(){
        $db = new Database;
        $loi = [];
        if ( $_SERVER['REQUEST_METHOD']=="POST"){  
            $loi = $db->Validate_DK($_POST);
            if ($loi==[]){ 
                $db->Dang_Ky($_POST);
                $str = "Cảm ơn đã đăng ký. Mời Bạn check mail để kích hoạt tài khoản";        
                $_SESSION['thong_bao'] = $str;
                //Gửi mail
                $db->Gui_Mail_Kich_Hoat($_POST);
                header("Location:index.php?page=thong_bao");
                exit();
            }
        }      
        $titlePage = "Đăng ký thành viên";
        $mainview = "views/dang_ky.php";
        include "views/layout.php";
    }
    function kich_hoat(){
        if (isset($_GET['email'])==false) die("Thiếu email rồi");
        $email = $_GET['email'];
        $db = new Database;
        $kq = $db->Check_Email($email); // 0 - không có email, 1 có email
        if ( $kq == 0 ) die("Không tồn tại $email");
        $db->Kich_Hoat($email);
        $_SESSION['thong_bao'] = "Đã kích hoạt xong. Mời bạn <a href='index.php?page=dang_nhap'>đăng nhập</a>";
        header("location: index.php?page=thong_bao");
    }
    
    function dang_nhap(){
        $db = new Database(); 
        $loi = [];
        if ( $_SERVER['REQUEST_METHOD']=="POST" ){       
            $kq = $db->Check_User_Pass($_POST['email'], $_POST['mat_khau']); //0, 1 $user
            if ( $kq == 0 )  $loi['email'] = "Email không tồn tại"; 
            else if ( $kq==1 ) $loi['mat_khau'] = "Mật khẩu không đúng";
            else if ( $kq['active']==null ) $loi['email'] = "Email chưa kích hoạt bạn ơi";
            else {
                $_SESSION['id_user'] = $kq['id'];
                $_SESSION['ho_ten'] = $kq['ho_ten'];
                $_SESSION['email'] = $kq['email'];
                $_SESSION['role'] = $kq['role'];
                if (isset($_SESSION['back'])==true) {
                    $b = $_SESSION['back']; 
                    unset($_SESSION['back']);
                    header("location: ". $b);
                    exit();}
                else {
                    if ($kq['role']!=1) header("location:index.php");
                    else header("Location:admin.php");
                }
                exit();
            }
        } //method post
        $titlePage = "Đăng nhập";
        $mainview = "views/dang_nhap.php";
        include "views/layout.php";
    }
    function thoat(){
        session_destroy();
        header("location: index.php");
    }
    
    public function thong_bao(){
        $titlePage = "Thông báo";
        $mainview = "views/thong_bao.php";
        include "views/layout.php";
    }
    
    function bai_viet(){
        $db = new Database;
        $page_size = 3; $page_num = 1; 
        if (isset($_GET['page_num'])==true) $page_num = $_GET['page_num']; 
        $data_arr = $db->Bai_Viet( $page_size, $page_num);    
        $so_record = $db->Bai_Viet_Dem();
        $so_trang = ceil($so_record/$page_size);          
        $titlePage = "Bài viết";
        $mainview = "views/bai_viet.php";
        include "views/layout.php";
    }
    function bv(){
        if (isset($_GET['id'])==false) die("Thiếu id bài viết rồi");
        $id = $_GET['id'];
        $db = new Database;
        $row = $db->Lay_1_Bai_Viet($id);
        if ($row==null) die("Không tồn tại bài viết $id ");
        $titlePage = $row['tieu_de'];
        $mainview = "views/chi_tiet_bai_viet.php";
        include "views/layout.php";
    }//bv
    function doi_pass(){       
        $db = new Database();
        if ($db-> Check_Login()==false ){
            $_SESSION['back'] = $_SERVER['REQUEST_URI'];
            header("location:index.php?page=dang_nhap"); exit();            
        } 
        $loi = [];
        if ( $_SERVER['REQUEST_METHOD']=="POST" ){
            $email = $_SESSION['email'];
            $pass_old = $_POST['mat_khau_cu'];
            $pass_new1 = $_POST['mat_khau_moi_1'];
            $pass_new2 = $_POST['mat_khau_moi_2'];
            $loi = $db->Validate_DoiPass($email, $pass_old, $pass_new1, $pass_new2);
            if ($loi==[]) {                
                $db->Cap_Nhat_Pass_Moi($email,  $pass_new1);
                $_SESSION['thong_bao'] = "Đã cập nhật mật khẩu mới của user";
                header("location:index.php?page=thong_bao"); 
                exit();
            }
        } //method post
        $titlePage = "Đổi mật khẩu";
        $mainview = "views/doi_pass.php";
        include "views/layout.php";
    }
    function quen_pass(){
        $db = new Database();
        $loi = [];
        if ( $_SERVER['REQUEST_METHOD'] == "POST" ){
            $email = $_POST['email'];
            $loi = $db->Validate_QuenPass($email);
            if ($loi==[]){
                $pass_moi = substr(md5(mt_rand()), 0, 8);
                $db->Cap_Nhat_Pass_Moi($email, $pass_moi);
                $db->Gui_Mail_Pass_Moi($email, $pass_moi);              
                $_SESSION['thong_bao'] = "Đã cập nhật và gửi mật khẩu mới đến email của bạn =" . $pass_moi;
                header("location:index.php?page=thong_bao"); 
                exit();
            }
        } //method post
        $titlePage = "Quên mật khẩu";
        $mainview = "views/quen_pass.php";
        include "views/layout.php";
    }
    function add_to_cart(){
        /* $_SESSION['cart'] = [   $id => $so_luong
                3 => 2,
                15 => 1,
                24 => 5 
            ] */
        if (isset($_GET['id'])==false) die("Thiếu id sách rồi");
        $id = $_GET['id'];
        if ($id<=0 ) die("Sách không tồn tại");
        $so_luong = 1; 
        if (isset($_GET['so_luong'])==true) $so_luong = $_GET['so_luong'];
        if ($so_luong<=0) $so_luong = 1;
    
        if (isset($_SESSION['cart'][$id])==true) $_SESSION['cart'][$id]+= $so_luong;
        else  $_SESSION['cart'][$id] = $so_luong;
    
        $data = [ 'ket_qua' => "" , "so_sach" => array_sum($_SESSION['cart'])];
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($data);
    }
    function cart(){
        $db = new Database();
        $cart_arr = [];
        $titlePage = "Sách đã chọn";       
        if (isset($_SESSION['cart'])==true) $cart_arr = $_SESSION['cart'];
        if ($cart_arr ==[]) {
            $_SESSION['thong_bao']="Bạn chưa chọn sách nào.<br>Mời bạn chọn sách nhé";
            header("location:index.php?page=thong_bao");
            exit();
        }
        else $mainview = "views/cart.php";
        include "views/layout.php";
    }
    function chinh_so_luong(){
        if (isset($_GET['id'])==false) die("Thiếu id sách rồi");
        $id = $_GET['id'];
        if (isset($_GET['so_luong'])==false) die("Thiếu so_luong rồi");
        $so_luong = $_GET['so_luong'];
        $cart_arr = [];     
        if (isset($_SESSION['cart'])==true) $cart_arr = $_SESSION['cart'];
        if ($cart_arr ==[]) {
            $_SESSION['thong_bao']="Bạn chưa chọn sách nào.<br>Mời bạn chọn sách nhé";
            header("location:index.php?page=thong_bao"); 
            exit();
        }
        $_SESSION['cart'][$id]= $so_luong;
        header("location:index.php?page=cart");
    }
    function xoa_sp_trong_cart(){
        if (isset($_GET['id'])==false) die("Thiếu id sách rồi");
        $id = $_GET['id'];
        $cart_arr = [];     
        if (isset($_SESSION['cart'])==true) $cart_arr = $_SESSION['cart'];
        if ($cart_arr ==[]) {
            $_SESSION['thong_bao']="Bạn chưa chọn sách nào.<br>Mời bạn chọn sách nhé";
            header("location:index.php?page=thong_bao");
            exit();
        }
        foreach ( $cart_arr as $id_sp => $so_luong ){
            if ($id_sp ==$id) {
                unset($_SESSION['cart'][$id]);
                header("location:index.php?page=cart");
                exit();
            }
        }
    }
    function lien_he(){
        $db = new Database();
        if ($_SERVER['REQUEST_METHOD']=="POST"){
            $loi = $db->Validate_LienHe($_POST);
            if ($loi==[]){
                $db->Gui_Mail_Lien_He($_POST);
                //echo "Đã gửi xong";
                $_SESSION['thong_bao'] = "Đã gửi thông tin liên hệ của bạn đến ban quản trị website";
                header("location:index.php?page=thong_bao");
                exit();
            }   
        }
        $titlePage ="Trang liên hệ";
        $mainview = "views/lien_he.php";
        include "views/layout.php";
    } 
    function gioi_thieu(){
        $titlePage ="Trang giới thiệu";
        $mainview = "views/gioi-thieu.html";
        include "views/layout.php";
    }
    
} //class SiteController
