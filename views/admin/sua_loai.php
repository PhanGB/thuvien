<style>
#frmloai { 
    border: 2px solid darkcyan; width: 900px; font-size: 1.2em; margin: 0 auto 15px auto; 
    box-shadow: 2px 2px darkcyan ; border-radius: 5px;
}
#frmloai > div { padding: 10px}
#frmloai .txt { width: 100%; padding: 7px; border: 1px solid darkcyan;  outline: none;} 
#frmloai button { height: 35px; width: 150px; border: 1px solid darkcyan; }
.caption { font-size: 24px; padding: 5px ; font-weight: 600; text-align: 
    center;}
.loi { color: red; font-weight: 600; font-style: italic;}

</style>
<h2 class="caption"> Trang sửa loại</h2>
<form id="frmloai" method="post" action="">
<div>Tên loại <input type="text" class="txt" name="ten" 
     value="<?php echo $loai['ten']?>" /> 
     <span class="loi"> <?php if (isset($loi['ten'])) echo $loi['ten'];?> </span> 
</div>
<div>Thứ tự <input type="number" class="txt" name="thu_tu" 
     value="<?php echo $loai['thu_tu']?>" /> 
     <span class="loi"> <?php if (isset($loi['thu_tu'])) echo $loi['thu_tu'];?> </span> 
</div>
<div>Trạng thái
     <input type="radio" name="an_hien" value="0" 
        <?php if ($loai['an_hien']==0) echo "checked" ?> /> Ẩn 
     <input type="radio" name="an_hien" value="1" 
        <?php if ($loai['an_hien']==1) echo "checked" ?> /> Hiện 
</div>
<div> <button type="submit">Sửa Loại</button> </div>
</form>
