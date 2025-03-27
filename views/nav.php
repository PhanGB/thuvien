<ul> <li> <a href="index.php">Trang chủ</a> </li>
     <?php foreach($this->loai_arr as $row_loai) {  ?>
     <li> <a href="index.php?page=sach_trong_loai&id=<?=$row_loai['id']?>">
           <?=$row_loai['ten']?> 
          </a> 
     </li>
     <?php } ?>

     <li> <a href="index.php?page=lien_he">Liên hệ</a> </li>
     <?php if (isset($_SESSION['ho_ten']) == false) { ?>
     <li> <a href="index.php?page=dang_ky">Đăng ký</a> </li>
     <li> <a href="index.php?page=dang_nhap">Đăng nhập</a> </li>
     <li> <a href="index.php?page=quen_pass">Quên pass</a> </li>
     <?php } else { ?>
      <li> <a href="index.php?page=doi_pass">Đổi pass</a> </li>
      <li> <a href="index.php?page=thoat">Thoát</a> </li>
     <?php } ?>
     <li> <a href="index.php?page=gioi_thieu">Giới thiệu</a> </li>
</ul>
