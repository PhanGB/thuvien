<style>
#chitiet #row1{ display: grid; grid-template-columns: 30% 70%;}
#chitiet #left img { width:100%; margin-top:10px ; height: 400px; }
#chitiet #row1 h1 { font-size: 1.5em;  margin: 10px;}
#chitiet #row1 p { margin: 15px 10px; font-size: 1.2em;}
#chitiet #row1 button { width: 180px; height: 35px}
#chitiet #row1  span { width: 120px; display: inline-block;}
#chitiet #row1  input { width: 130px; padding: 4px; outline:none}

.lien_quan h2 {  padding: 10px }
.lien_quan #data { display: grid; grid-template-columns: 16.5% 16.5% 16.5% 16.5% 16.5% 16.5%}
.lien_quan #data .sp { border: 1px solid darkcyan; text-align: center; font-size: 1.2em;}
.lien_quan #data .sp > * { margin: 10px}
.lien_quan #data .sp  h3.ten { font-size: 0.9em;  color:darkslateblue; height: 40px;} 
.lien_quan #data .sp  p.gia { font-size: 0.9em; font-weight:600;} 
.lien_quan #data .sp  img { min-width: 80%;max-width: 90%; height:200px}


</style>
<div id="chitiet">
<div id="row1">
    <div id="left">
    <img src="<?php 
      if ( substr($row['hinh'],0, 4)=="http") echo $row['hinh'];
      else echo PUBLIC_URL.$row['hinh'];?>" />
    </div>
    <div id=right">       
      <h1><?php echo $row['ten'];?></h1>
      <p> <span>Giá</span>:<?php echo number_format($row['gia'],0,"", ".");?> VNĐ</p>
      <p> <span>Loại</span>: <?php echo $row['ten_loai']?> </p>
      <p> <span>Tác giả</span>: <?php echo $row['ten_tac_gia']?> </p>
      <p> <span>Nhà xuất bản</span>: <?php echo $row['ten_nxb']?> </p>
      <p> <span>Năm xuất bản</span>: <?php echo $row['nam_xuat_ban']?> </p>
      <p> <span>Lượt xem</span>: <?php echo $row['luot_xem']?> </p>
      <p> <span>Cập nhật</span>: <?=date('d/m/Y', strtotime($row['ngay_cap_nhat']))?> </p>
      <p> <button class="btn" >Chọn sách</button> </p>
      <p> <button><a href="index.php?page=sach_da_chon" >Xem sách đã chọn</a></button></p>
    </div>
</div>
<hr>
<div id="row2"> <?php include "Sach_Lien_Quan.php";?> </div>
<div id="row3"> 
    <?php 
        if (isset($_SESSION['id_user'])==true) { 
          include "List_Binh_Luan.php";
          include "Form_Binh_Luan.php";
        }
        else "<p>Mời bạn <a href='index.php?page=dang_nhap'>đăng nhập</a> để bình luận</p>"
    ?>   
</div>
</div>
