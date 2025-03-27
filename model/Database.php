<?php
class Database {
  private $conn;
  function __construct(){
    try {
        $str = "mysql:host=".DB_HOST."; dbname=". DB_NAME."; charset=utf8";
        $this->conn = new PDO($str, DB_USER , DB_PASS);
    }
    catch(Exception $e ){
        die("Lỗi kết nối database : " . $e->getMessage());
    }
  }
  function Sach_Moi($soluong){
    $sql="SELECT * from sach WHERE an_hien=1 ORDER By ngay_cap_nhat desc limit 0,$soluong";
    $kq = $this->conn -> query($sql);
    return $kq->fetchAll(PDO::FETCH_ASSOC);
   } 
   function Sach_Xem_Nhieu($soluong) {
     $sql = "SELECT * from sach WHERE an_hien = 1 ORDER By luot_xem desc limit 0,$soluong";
     $kq =  $this->conn -> query($sql);
     return $kq->fetchAll(PDO::FETCH_ASSOC);
   }
   function Tang_So_Lan_Xem($id){
    $sql = " UPDATE  sach SET luot_xem = luot_xem+1  WHERE sach.id= ?";
    $stmt =  $this->conn -> prepare($sql);
    $stmt->execute( [ $id ] );
   }
   function Chi_Tiet( $id = 0 ) {
    $sql = " SELECT sach.*, loai_sach.ten as ten_loai , 
             tac_gia.ten as ten_tac_gia, nha_xuat_ban.ten as ten_nxb
             FROM  sach, loai_sach, tac_gia, nha_xuat_ban
             WHERE sach.id= ? AND sach.id_loai = loai_sach.id 
             AND sach.id_tg = tac_gia.id AND sach.id_nxb = nha_xuat_ban.id";
    $stmt =  $this->conn -> prepare($sql);
    $stmt->execute( [ $id ] );
    return $stmt->fetch(PDO::FETCH_ASSOC);
  } 
  function Sach_Lien_Quan( $id = 0 , $soluong = 5) {
    $sql = "SELECT * FROM sach WHERE an_hien = 1 
            AND id_loai in (select id_loai from sach WHERE id= $id) AND  id <> $id 
            ORDER By ngay_cap_nhat desc limit 0, $soluong";
    $kq =  $this->conn -> query($sql);
    return $kq->fetchAll(PDO::FETCH_ASSOC);
  }
  function Binh_Luan_Cua_Sach( $id = 0 ) {
    $sql = "SELECT binh_luan.*, users.ho_ten  
            FROM binh_luan , users
            WHERE binh_luan.id_user= users.id AND  binh_luan.an_hien=1 AND binh_luan.id_sach = $id 
            ORDER By binh_luan.thoi_diem DESC";
    $stmt = $this->conn -> prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }
  
  function Sach_Trong_Loai( $id_loai , $page_size = 6 , $page_num = 1 ) {   
    $start = ( $page_num - 1 ) * $page_size;
    $sql = "SELECT * FROM sach WHERE an_hien=1 AND id_loai = $id_loai 
            ORDER By ngay_cap_nhat DESC limit $start, $page_size";
    $stmt = $this->conn -> prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  } 
  function Sach_Trong_Loai_Dem($id_loai){
    $sql="Select count(*) as dem from sach WHERE an_hien = 1 AND id_loai = $id_loai";
    $kq =  $this->conn -> query($sql);
    $data = $kq->fetch(PDO::FETCH_ASSOC);
    return $data['dem'];
  } 
  function Lay_Ten_Loai( $id_loai) {   
    $sql ="SELECT * FROM loai_sach WHERE id= $id_loai";
    $kq =  $this->conn -> query( $sql );
    $row = $kq->fetch(PDO::FETCH_ASSOC);
    if ($row==null) return "Không có";
    return $row['ten'];
  } 
  function Tim_Kiem($tu_khoa, $page_size=6, $page_num=1){   
    $start = ( $page_num - 1 ) * $page_size;
    $sql = "SELECT * FROM sach WHERE an_hien=1 AND ten like ?
            ORDER By ngay_cap_nhat DESC limit $start, $page_size";
    $stmt = $this->conn -> prepare($sql);
    $stmt->execute( [ "%".$tu_khoa."%"] );
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  } 
  function Tim_Kiem_Dem($tu_khoa){   
    $sql="Select count(*) as dem from sach WHERE an_hien=1 AND ten like ?";
    $stmt =  $this->conn -> prepare($sql);
    $stmt->execute( [ "%".$tu_khoa."%"] );
    $data = $stmt->fetch(PDO::FETCH_ASSOC);
    return $data['dem'];
  } 
  function Dang_Ky($user){
    $sql = "INSERT INTO users SET ho_ten=:ho_ten, email=:email, mat_khau=:mat_khau";
    $stmt =  $this->conn ->prepare($sql);
    $stmt->bindParam(":ho_ten", $user['ho_ten'], PDO::PARAM_STR);
    $stmt->bindParam(":email", $user['email'], PDO::PARAM_STR);
    $mat_khau = $user['mat_khau'] ;
    $mk_mahoa = password_hash( $mat_khau , PASSWORD_BCRYPT);
    $stmt->bindParam(":mat_khau", $mk_mahoa, PDO::PARAM_STR);
    $stmt->execute();
  }
  function Check_Email( $email){ // 0 - không có email, 1 có email
    $stmt = $this->conn->prepare("SELECT count(*) as dem FROM users WHERE email=?");
    $stmt->execute( [ $email ] );
    $data = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($data['dem'] == 0 ) return 0 ; //không có email 
    else return 1; // có email
  }
  function Validate_DK($user){
    $loi = [];
    if ($user['ho_ten']=="") $loi['ho_ten']= "Chưa nhập họ tên";
    if ($user['email']=="") $loi['email']= "Chưa nhập email";
    else if (filter_var($user['email'], FILTER_VALIDATE_EMAIL)==false) 
    $loi['email']= "Nhập email chưa đúng";
    else if ($this->Check_Email($user['email'])==1)
    $loi['email']= "Email bạn nhập đã có người dùng";
    if (trim($user['mat_khau'])=="") $loi['mat_khau']= "Chưa nhập mật khẩu";
    else if ( strlen($user['mat_khau'])<6) $loi['mat_khau'] = "Mật khẩu quá ngắn";
    if (trim($user['mat_khau'])!=trim($user['mat_khau_nhap_lai']))
    $loi['mat_khau_nhap_lai']= "Mật khẩu nhập 2 lần không giống nhau";
    return $loi; 
  }
  function Check_User_Pass($email, $mat_khau){
    $stmt = $this->conn->prepare("SELECT * FROM users WHERE email=?");
    $stmt->execute( [$email] );
    $dem = $stmt->rowCount(); 
    if ($dem ==0 ) return 0; //"Email không tồn tại";
    $user = $stmt->fetch();
    $mk_mahoa = $user['mat_khau']; 
    if (password_verify($mat_khau, $mk_mahoa) ==false) 
      return 1 ;  //"Mật khẩu không đúng";
    else return $user; // toàn bộ thông tin user 
  }
  function Bai_Viet( $page_size = 6 , $page_num = 1 ) {   
    $start = ( $page_num - 1 ) * $page_size;
    $sql = "SELECT * FROM bai_viet WHERE an_hien=1 
            ORDER By ngay DESC limit $start, $page_size";
    $stmt = $this->conn -> prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  } 
  function Bai_Viet_Dem(){
    $sql="SELECT count(*) as dem FROM bai_viet WHERE an_hien=1 ";
    $kq =  $this->conn -> query($sql);
    $data = $kq->fetch(PDO::FETCH_ASSOC);
    return $data['dem'];
  }
  function Lay_1_Bai_Viet( $id = 0 ) {
    $sql = "SELECT * FROM  bai_viet WHERE id= ? ";
    $stmt = $this->conn -> prepare($sql);
    $stmt->execute( [ $id ] );
    return $stmt->fetch(PDO::FETCH_ASSOC);
  } 
  function Lay_Loai( ) { 
    $sql = "Select * from loai_sach WHERE an_hien =1 ORDER By thu_tu ASC";
    $kq =  $this->conn -> query($sql);
    return $kq->fetchAll(PDO::FETCH_ASSOC);
  } 
  function Lay_Tinh( ) { 
    $sql = "Select * from province ORDER By name ASC";
    $kq =  $this->conn -> query($sql);
    return $kq->fetchAll(PDO::FETCH_ASSOC);
  }  
  function Lay_Huyen_Trong_Tinh( $id_tinh) { 
    $sql = "Select * from district WHERE province_id=$id_tinh ORDER By name ASC";
    $kq =  $this->conn -> query($sql);
    return $kq->fetchAll(PDO::FETCH_ASSOC);
  }  
  function Check_Login(){ return isset($_SESSION['email']);  }
  function Validate_DoiPass($email, $pass_old, $pass_new1, $pass_new2){
    $loi = [];
    $kq = $this->Check_User_Pass($email, $pass_old);
    if ($pass_old=="") $loi['mat_khau_cu']= "Mật khẩu cũ chưa nhập";
    else if ($kq==1) $loi['mat_khau_cu']= "Mật khẩu cũ không đúng";  
    if ($pass_new1=="") $loi['mat_khau_moi_1']= "Chưa nhập mật khẩu mới";
    else if ( strlen($pass_new1)<6) $loi['mat_khau_moi_1'] = "Mật khẩu mới quá ngắn";
    if ($pass_new1!=$pass_new2) $loi['mat_khau_moi_2']= "Mật khẩu 2 lần không giống nhau";
    return $loi; 
  }
  function Cap_Nhat_Pass_Moi($email, $pass_new){
    $mk_mahoa = password_hash( $pass_new , PASSWORD_BCRYPT);
    $stmt = $this->conn->prepare("UPDATE users set mat_khau = ? WHERE email=?");
    $stmt->execute( [ $mk_mahoa , $email ] );
  }
  function Validate_QuenPass($email){
    $loi = [];
    if ($email=="") $loi['email'] ="Chưa nhập email";  
    else if (filter_var($email, FILTER_VALIDATE_EMAIL)==false) 
    $loi['email']="Email không đúng";
    else if ($this->Check_Email( $email) ==0) $loi['email'] ="Email không tồn tại";
    return $loi; 
  }
  function Validate_Binh_Luan($data){
    $loi = [];
    if ($data['noi_dung']=="") $loi['noi_dung'] ="Chưa nhập bình luận bạn ơi";  
    return $loi; 
  }
  function Kich_Hoat( $email){ // 0 - không có email, 1 có email
    $stmt = $this->conn->prepare("UPDATE users SET active = now() WHERE email=? ");
    $stmt->execute( [ $email ] );
  }
  
  function Gui_Mail_Kich_Hoat($user){
    require "PHPMailer-master/src/PHPMailer.php"; 
    require "PHPMailer-master/src/SMTP.php"; 
    require 'PHPMailer-master/src/Exception.php'; 
    $mail = new PHPMailer\PHPMailer\PHPMailer(true);
    try {
      $mail->SMTPDebug = 0;  // 0,1,2: chế độ debug
      $mail->isSMTP();  
      $mail->CharSet  = "utf-8";
      $mail->Host = 'smtp.gmail.com'; //địa chỉ server
      $mail->SMTPAuth = true; 
      $tennguoigui = 'Long'; //Nhập tên người gửi
      $mail->Username='longastec@gmail.com';
      $mail->Password = 'rgtnlkaupoblthhr'; // mật khẩu ứng dụng rgtn lkau pobl thhr 
      $mail->SMTPSecure = 'ssl';    
      $mail->Port = 465;              
      $mail->setFrom('longastec@gmail.com'); 
      $mail->addAddress($user['email']); //mail người nhận  
      $mail->isHTML(true);  
      $mail->Subject = 'Mail kích hoạt tài khoản '; 
      $email = $user['email'];
      $noidung ="<h3>Cảm ơn bạn đã đăng ký thành viên</h3>
      <p>Mời bạn nhắp vào đây để kích hoat tài khoản <br/>
      <a href='http://localhost/thuvien/index.php?page=kich_hoat&email=$email'>Kích hoạt tài khoản</a>
      </p>";
      $mail->Body = $noidung; //nội dung thư
      $mail->smtpConnect( array("ssl" => array(
          "verify_peer" => false,
          "verify_peer_name" => false,
          "allow_self_signed" => true
      )));
      $mail->send();
      echo 'Đã gửi mail xong';
    } catch (Exception $e) { echo 'Mail không gửi được. Lỗi: ', $mail->ErrorInfo; }
  }
  
  function Luu_Binh_Luan($data){
    $sql = "INSERT INTO binh_luan SET id_user=:id_user, id_sach=:id_sach, noi_dung=:noi_dung";
    $stmt =  $this->conn ->prepare($sql);
    $id_user =  $_SESSION['id_user'];
    $stmt->bindParam(":id_user", $id_user, PDO::PARAM_INT);
    $stmt->bindParam(":id_sach", nl2br($data['id_sach'] ), PDO::PARAM_STR);
    $stmt->bindParam(":noi_dung", nl2br($data['noi_dung'] ), PDO::PARAM_STR);
    $stmt->execute();
  }
  function Gui_Mail_Pass_Moi($email, $pass_moi){
    require "PHPMailer-master/src/PHPMailer.php"; 
    require "PHPMailer-master/src/SMTP.php"; 
    require 'PHPMailer-master/src/Exception.php'; 
    $mail = new PHPMailer\PHPMailer\PHPMailer(true);
    try {
      $mail->SMTPDebug = 0;  // 0,1,2: chế độ debug
      $mail->isSMTP();  
      $mail->CharSet  = "utf-8";
      $mail->Host = 'smtp.gmail.com'; //địa chỉ server
      $mail->SMTPAuth = true; 
      $tennguoigui = 'Long'; //Nhập tên người gửi
      $mail->Username='longastec@gmail.com';
      $mail->Password = 'rgtnlkaupoblthhr'; // mật khẩu ứng dụng rgtn lkau pobl thhr 
      $mail->SMTPSecure = 'ssl';   //tsl 
      $mail->Port = 465;         //587      
      $mail->setFrom('longastec@gmail.com'); 
      $mail->addAddress($email); //mail người nhận  
      $mail->isHTML(true);  
      $mail->Subject = 'Gửi mật khẩu mới '; 
      $noidung ="<h3>Cập nhật mật khẩu mới</h3><p>Đây là mật khẩu mới $pass_moi </p>";
      $mail->Body = $noidung; //nội dung thư
      $mail->smtpConnect( array("ssl" => array(
          "verify_peer" => false,
          "verify_peer_name" => false,
          "allow_self_signed" => true
      )));
      $mail->send();
      echo 'Đã gửi mail xong';
    } catch (Exception $e) { echo 'Mail không gửi được. Lỗi: ', $mail->ErrorInfo; }
  }
  
  

  function List_Loai( ) { 
    $sql = "Select * from loai_sach ORDER By id desc";
    $kq =  $this->conn -> query($sql);
    return $kq->fetchAll(PDO::FETCH_ASSOC);
  } 
  
  function Them_Loai($loai){
    $sql = "INSERT INTO loai_sach SET ten=:ten, thu_tu=:thu_tu, an_hien=:an_hien";
    $stmt =  $this->conn ->prepare($sql);
    $stmt->bindParam(":ten", $loai['ten'], PDO::PARAM_STR);
    $stmt->bindParam(":thu_tu", $loai['thu_tu'], PDO::PARAM_INT);
    $stmt->bindParam(":an_hien", $loai['an_hien'], PDO::PARAM_BOOL);
    $stmt->execute();
  }
  function Validate_Loai($loai){
    $loi = [];
    if ($loai['ten']=="") $loi['ten'] ="Chưa nhập tên loại";
    if ($loai['thu_tu']<=0) $loi['thu_tu'] ="Thứ tự  >0 nhé ";
    return $loi; 
  }

  //SỬA LOẠI
  function Lay_1_Loai($id = 0){
    $kq =  $this->conn -> query("Select * from loai_sach WHERE id= $id");
    return $kq->fetch(PDO::FETCH_ASSOC);
  } 
  function Sua_Loai($id, $loai){
    $sql="UPDATE loai_sach SET ten=:ten, thu_tu=:thu_tu,an_hien=:an_hien WHERE id=:id";
    $stmt =  $this->conn ->prepare($sql);
    $stmt->bindParam(":ten", $loai['ten'], PDO::PARAM_STR);
    $stmt->bindParam(":thu_tu", $loai['thu_tu'], PDO::PARAM_INT);
    $stmt->bindParam(":an_hien", $loai['an_hien'], PDO::PARAM_BOOL);
    $stmt->bindParam(":id", $id, PDO::PARAM_INT);
    $stmt->execute();
  }
  function Xoa_Loai($id){
  $sql = "DELETE FROM loai_sach WHERE id=:id";
  $stmt =  $this->conn ->prepare($sql);
  $stmt->bindParam(":id", $id, PDO::PARAM_INT);
  $stmt->execute();
}

function List_Sach( $page_num = 1, $page_size = 6 ){
  $start = ($page_num - 1) * $page_size;
  $sql="SELECT sach.*, tac_gia.ten as ten_tac_gia, nha_xuat_ban.ten as ten_nxb 
  FROM sach, tac_gia, nha_xuat_ban
  WHERE  sach.id_tg = tac_gia.id AND sach.id_nxb = nha_xuat_ban.id
  ORDER By sach.id desc limit $start, $page_size";
  $kq =  $this->conn -> query($sql);
  return $kq->fetchAll(PDO::FETCH_ASSOC);
}
function List_Sach_Dem(){   
  $sql = "SELECT count(*) as dem 
  FROM sach, tac_gia, nha_xuat_ban
  WHERE  sach.id_tg = tac_gia.id AND sach.id_nxb = nha_xuat_ban.id";
  $kq =  $this->conn -> query($sql);
  $data = $kq->fetch(PDO::FETCH_ASSOC);
  return $data['dem'];
} 

//thêm sách
function Them_Sach( $data ){
  $sql = "INSERT INTO sach SET ten=:ten, gia=:gia, hinh=:hinh, luot_xem=:luot_xem, 
    nam_xuat_ban=:nam_xb, ngay_cap_nhat=:ngay, an_hien=:an_hien, 
    id_loai=:id_loai, id_tg =:id_tg, id_nxb=:id_nxb, id_user=1";
  $stmt =  $this->conn ->prepare($sql);
  $stmt->bindParam(":ten", $data['ten'] , PDO::PARAM_STR);
  $stmt->bindParam(":gia", $data['gia'] , PDO::PARAM_INT);
  $stmt->bindParam(":hinh", $data['hinh'] , PDO::PARAM_STR);
  $stmt->bindParam(":luot_xem", $data['luot_xem'] , PDO::PARAM_INT);
  $stmt->bindParam(":nam_xb", $data['nam_xuat_ban'] , PDO::PARAM_INT);
  $stmt->bindParam(":ngay", $data['ngay_cap_nhat'] , PDO::PARAM_STR);
  $stmt->bindParam(":an_hien", $data['an_hien'] , PDO::PARAM_BOOL);
  $stmt->bindParam(":id_loai", $data['id_loai'] , PDO::PARAM_INT);
  $stmt->bindParam(":id_tg", $data['id_tg'] , PDO::PARAM_INT);
  $stmt->bindParam(":id_nxb", $data['id_nxb'] , PDO::PARAM_INT);
  $stmt->execute();
}
function Lay_List_Loai(){
  $sql = "SELECT * FROM loai_sach  ORDER By thu_tu asc";
  $kq = $this->conn->query($sql);
  return $kq->fetchAll(PDO::FETCH_ASSOC);
}
function Lay_List_Tac_Gia(){
  $sql = "SELECT * FROM tac_gia  ORDER By ten asc";
  $kq = $this->conn->query($sql);
  return $kq->fetchAll(PDO::FETCH_ASSOC);
}
function Lay_List_NXB(){
  $sql = "SELECT * FROM nha_xuat_ban  ORDER By ten asc";
  $kq = $this->conn->query($sql);
  return $kq->fetchAll(PDO::FETCH_ASSOC);
}
function Validate_Sach($sach){
  $loi = [];
  if ($sach['ten']=="") $loi['ten'] ="Chưa nhập tên sách";
  if ($sach['gia']<=0) $loi['gia'] ="Nhập giá, >0 nhé ";
  if ($sach['ngay_cap_nhat']=="") $loi['ngay_cap_nhat'] ="Nhập ngày nhé ";
  if ($sach['nam_xuat_ban']<=0) $loi['nam_xuat_ban'] ="Nhập năm xuất bản vào, >0 nhé ";
  return $loi; 
}

//sửa sách
function Sua_Sach($id, $data){
  $sql = "UPDATE sach SET ten=:ten, gia=:gia, hinh=:hinh, luot_xem=:luot_xem, 
  nam_xuat_ban=:nam_xb, ngay_cap_nhat=:ngay, an_hien=:an_hien, 
  id_loai=:id_loai, id_tg =:id_tg, id_nxb=:id_nxb WHERE id=:id";
  $stmt =  $this->conn ->prepare($sql);
  $stmt->bindParam(":ten", $data['ten'] , PDO::PARAM_STR);
  $stmt->bindParam(":gia", $data['gia'] , PDO::PARAM_INT);
  $stmt->bindParam(":hinh", $data['hinh'] , PDO::PARAM_STR);
  $stmt->bindParam(":luot_xem", $data['luot_xem'] , PDO::PARAM_INT);
  $stmt->bindParam(":nam_xb", $data['nam_xuat_ban'] , PDO::PARAM_INT);
  $stmt->bindParam(":ngay", $data['ngay_cap_nhat'] , PDO::PARAM_STR);
  $stmt->bindParam(":an_hien", $data['an_hien'] , PDO::PARAM_BOOL);
  $stmt->bindParam(":id_loai", $data['id_loai'] , PDO::PARAM_INT);
  $stmt->bindParam(":id_tg", $data['id_tg'] , PDO::PARAM_INT);
  $stmt->bindParam(":id_nxb", $data['id_nxb'] , PDO::PARAM_INT);
  $stmt->bindParam(":id", $id, PDO::PARAM_INT);
  $stmt->execute();
}
function Lay_1_Sach($id=0){
  $kq =  $this->conn -> query("Select * from sach WHERE id= $id");
  return $kq->fetch(PDO::FETCH_ASSOC);
} 

function Xoa_Sach($id){
  $sql = "DELETE FROM sach WHERE id=:id";
  $stmt =  $this->conn ->prepare($sql);
  $stmt->bindParam(":id", $id, PDO::PARAM_INT);
  $stmt->execute();
}

function Validate_LienHe($lienhe){
  $loi = [];
  if ($lienhe['ho_ten']=="") $loi['ho_ten']= "Chưa nhập họ tên";
  if ($lienhe['email']=="") $loi['email']= "Chưa nhập email";
  else if (filter_var($lienhe['email'], FILTER_VALIDATE_EMAIL)==false) 
  $loi['email']= "Nhập email chưa đúng";
  if (trim($lienhe['noi_dung'])=="") $loi['noi_dung']= "Chưa nhập nội dung bạn ơi";
  return $loi; 
}
function Gui_Mail_Lien_He($lienhe){
  require "PHPMailer-master/src/PHPMailer.php"; 
  require "PHPMailer-master/src/SMTP.php"; 
  require 'PHPMailer-master/src/Exception.php'; 
  $mail = new PHPMailer\PHPMailer\PHPMailer(true);
  try {
    $mail->SMTPDebug = 0;  // 0,1,2: chế độ debug
    $mail->isSMTP();  
    $mail->CharSet  = "utf-8";
    $mail->Host = 'smtp.gmail.com'; //địa chỉ server
    $mail->SMTPAuth = true; 
    $tennguoigui = 'Long'; //Nhập tên người gửi
    $mail->Username='longastec@gmail.com';
    $mail->Password = 'rgtnlkaupoblthhr'; // mật khẩu ứng dụng rgtn lkau pobl thhr 
    $mail->SMTPSecure = 'ssl';    
    $mail->Port = 465;              
    $mail->setFrom('longastec@gmail.com'); 
    $mail->addAddress("thaylongweb@gmail.com"); //mail người nhận  
    $mail->isHTML(true);  
    $mail->Subject = 'Khách hàng liên hệ '; 

    $noidung = "<h3>Chào Ban quản trị! Có khách hàng liên hệ đây</h3>";
    $noidung.= "<p>Họ tên:  " . $lienhe['ho_ten'] ."</p>";
    $noidung.= "<p>Email:  ". $lienhe['email'] . " </p>";
    $noidung.= "<p>Nội dung liên hệ:<br> ". $lienhe['noi_dung'] . "</p>";
    $mail->Body = nl2br($noidung); //nội dung thư
    $mail->smtpConnect( array("ssl" => array(
        "verify_peer" => false,
        "verify_peer_name" => false,
        "allow_self_signed" => true
    )));
    $mail->send();
    echo 'Đã gửi mail xong';
  } catch (Exception $e) { echo 'Mail không gửi được. Lỗi: ', $mail->ErrorInfo; }

}





 }//class Database
