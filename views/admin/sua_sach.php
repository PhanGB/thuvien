<style>
#frmsach { 
    border: 2px solid darkcyan; width: 900px; display: grid; 
    grid-template-columns: 50% 50%; font-size: 1.2em; margin: 0 auto 15px auto; 
    box-shadow: 2px 2px darkcyan ; border-radius: 5px;}
#frmsach > div { padding: 10px}
#frmsach .txt { width: 100%; padding: 7px; border: 1px solid darkcyan;  outline: none;} 
#frmsach button { height: 35px; width: 150px; border: 1px solid darkcyan; }
.caption { font-size: 24px; padding: 5px ; font-weight: 600; text-align:center;}
.loi { color: red; font-weight: 600; font-style: italic;}

</style>
<h2 class="caption"> Trang sửa sách</h2>
<form id="frmsach" method="post" action="">
<div>Tên sách <input type="text" class="txt" name="ten" 
    value="<?php echo $sach['ten']?>">
    <span class="loi"> <?php if (isset($loi['ten'])) echo $loi['ten'];?> </span>
</div>
<div>Hình <input type="text" class="txt" name="hinh" 
    value="<?php echo $sach['hinh']?>"  > 
    <span class="loi"> <?php if (isset($loi['hinh'])) echo $loi['hinh'];?> </span>
</div>
<div> Giá <input type="number" class="txt" name="gia" 
    value="<?php echo $sach['gia']?>" > 
    <span class="loi"> <?php if (isset($loi['gia'])) echo $loi['gia'];?> </span> 
</div>
<div> Ngày <input type="date" class="txt" name="ngay_cap_nhat" 
    value="<?php echo date('Y-m-d', strtotime($sach['ngay_cap_nhat']))?>" > 
    <span class="loi"> 
       <?php if (isset($loi['ngay_cap_nhat'])) echo $loi['ngay_cap_nhat'];?> 
    </span>
</div>
<div>Năm xuất bản <input type="number" class="txt" name="nam_xuat_ban" 
     value="<?php echo $sach['nam_xuat_ban']?>" >
     <span class="loi"> 
        <?php if (isset($loi['nam_xuat_ban'])) echo $loi['nam_xuat_ban'];?> 
     </span>
</div>
<div>Lượt xem <input type="number" class="txt" name="luot_xem" 
    value="<?php echo $sach['luot_xem']?>" > 
    <span class="loi"> <?php if (isset($loi['luot_xem'])) echo $loi['luot_xem'];?> </span>
</div>
<div> Loại
    <select class="txt" name="id_loai">
        <?php foreach($loai_arr as $loai) {  ?>
            <option value="<?= $loai['id']?>"   
                <?php if ($loai['id']==$sach['id_loai']) echo "selected" ?>          
            > 
            <?= $loai['ten']?> 
            </option>    
        <?php } //foreach?>
    </select> 
</div>
<div> Tác giả 
    <select class="txt" name="id_tg">
        <?php foreach($tacgia_arr as $tacgia) { ?>
            <?php if ($tacgia['id'] == $sach['id_tg'] ) { ?>
            <option value="<?=$tacgia['id']?>" selected> <?=$tacgia['ten']?> </option>   
            <?php } else { ?>
                <option value="<?=$tacgia['id']?>"> <?=$tacgia['ten']?> </option>  
            <?php } //if?>
        <?php } //foreach?>
    </select> 
</div>
<div> Nhà xuất bản 
    <select class="txt" name="id_nxb">
        <?php foreach($nxb_arr as $nxb) { ?>
            <?php if ($nxb['id'] == $sach['id_nxb'] ) { ?>
              <option value="<?= $nxb['id']?>" selected> <?= $nxb['ten']?> </option>  
            <?php } else { ?>
              <option value="<?= $nxb['id']?>"> <?= $nxb['ten']?> </option>  
            <?php } //if?>
        <?php } //foreach?>
    </select> 
</div>
<div> Trạng thái
    <div class="txt" style="padding:5px">
       <input type="radio" name="an_hien" value="0" 
           <?php if ($sach['an_hien']==0) echo "checked" ?>
       > Ẩn 
       <input type="radio" name="an_hien" value="1" 
           <?php if ($sach['an_hien']==1) echo "checked" ?> 
       > Hiện
    </div>
</div>
<div> <button type="submit">Sửa sách</button> </div>
</form>
