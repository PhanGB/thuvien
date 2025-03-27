<style>
#frmsach { 
  border: 2px solid darkcyan; 
  width: 900px; 
  display: grid; grid-template-columns: 50% 50%; 
  font-size: 1.2em; margin: 0 auto 15px auto; 
  box-shadow: 2px 2px darkcyan ; border-radius: 5px; }
#frmsach > div { padding: 10px}
#frmsach .txt { width: 100%; padding: 7px; border: 1px solid darkcyan;  outline: none;} 
#frmsach button { height: 35px; width: 150px; border: 1px solid darkcyan; }
.caption { font-size: 24px; padding: 5px ; font-weight: 600; text-align: center;}
.loi { color: red; font-weight: 600; font-style: italic;}


</style>
<h2 class="caption"> Trang thêm sách</h2>
<form id="frmsach" method="post" action="">
<div>Tên sách <input type="text" class="txt" name="ten" 
     value="<?php if (isset($_POST['ten'])) echo $_POST['ten']?>"> 
    <span class="loi"> <?php if (isset($loi['ten'])) echo $loi['ten'];?> </span>
</div>
<div>Hình <input type="text" class="txt" name="hinh" 
     value="<?php if (isset($_POST['hinh'])) echo $_POST['hinh']?>"> 
    <span class="loi"> <?php if (isset($loi['hinh'])) echo $loi['hinh'];?> </span>
</div>
<div> Giá <input type="number" class="txt" name="gia" 
    value="<?php if (isset($_POST['gia'])) echo $_POST['gia']?>"> 
    <span class="loi"> <?php if (isset($loi['gia'])) echo $loi['gia'];?> </span> 
</div>
<div> Ngày <input type="date" class="txt" name="ngay_cap_nhat" 
    value="<?php if (isset($_POST['ngay_cap_nhat'])) echo $_POST['ngay_cap_nhat']?>"> 
    <span class="loi"> 
       <?php if (isset($loi['ngay_cap_nhat'])) echo $loi['ngay_cap_nhat'];?> 
    </span>
</div>
<div>Năm xuất bản <input type="number" class="txt" name="nam_xuat_ban" 
     value="<?php if (isset($_POST['nam_xuat_ban'])) echo $_POST['nam_xuat_ban']?>">
     <span class="loi"> <?php if (isset($loi['nam_xuat_ban'])) echo $loi['nam_xuat_ban'];?> </span>
</div>
<div>Lượt xem <input type="number" class="txt" name="luot_xem" 
   value="<?php if (isset($_POST['luot_xem'])) echo $_POST['luot_xem']; else echo '0';?>"> 
   <span class="loi"> <?php if (isset($loi['luot_xem'])) echo $loi['luot_xem'];?> </span>
</div>
<div> Loại 
  <select class="txt" name="id_loai">
    <?php foreach($loai_arr as $loai) { ?>
      <option value="<?php echo $loai['id']?>"> <?php echo $loai['ten']?> </option>    
    <?php } ?>
  </select> 
</div>
<div> Tác giả 
  <select class="txt" name="id_tg">
    <?php foreach($tacgia_arr as $tacgia) { ?>
     <option value="<?php echo $tacgia['id']?>"> <?php echo $tacgia['ten']?> </option>    
    <?php } ?>
  </select> 
</div>
<div> Nhà xuất bản 
    <select class="txt" name="id_nxb">
        <?php foreach($nxb_arr as $nxb) { ?>
           <option value="<?php echo $nxb['id']?>"> <?php echo $nxb['ten']?> </option>    
        <?php } ?>
    </select> 
</div>
<div> Trạng thái
    <div class="txt" style="padding:5px">
        <input type="radio" name="an_hien" value="0" > Ẩn 
        <input type="radio" name="an_hien" value="1" checked> Hiện
    </div>
</div>
<div> <button type="submit">Thêm sách </button> </div>
</form>
