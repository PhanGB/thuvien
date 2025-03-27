<style>
#frmdoipass { border: 2px solid darkcyan; width: 900px; 
    font-size: 1.2em; margin: 0 auto 15px auto; 
    box-shadow: 2px 2px darkcyan ; border-radius: 5px; }
#frmdoipass > div { padding: 10px}
#frmdoipass .txt { width: 100%; padding: 10px; border: 1px solid darkcyan;  outline: none;} 
#frmdoipass button { height: 35px; width: 150px; border: 1px solid darkcyan; }
.caption { margin:0 ; font-size: 24px;; background: darkcyan; padding: 6px; color:white}
.loi { color: red; margin-top:0; font-weight: 600;}

</style>
<form id="frmdoipass" method="post" action="">
<h2 class="caption"> Đổi mật khẩu</h2>
<div>Email <input type="email" disabled class="txt" name="email" 
     value="<?php if (isset($_SESSION['email'])) echo $_SESSION['email']?>"> 
     <span class="loi"> <?php if (isset($loi['email'])) echo $loi['email'];?> </span>
</div>
<div>Mật khẩu cũ 
    <input type="password" class="txt" name="mat_khau_cu" 
     value="<?php if (isset($_POST['mat_khau_cu'])) echo $_POST['mat_khau_cu']?>"
     > 
     <span class="loi"> 
       <?php if (isset($loi['mat_khau_cu'])) echo $loi['mat_khau_cu'];?> 
     </span> 
</div>
<div>Mật khẩu mới <input type="password" class="txt" name="mat_khau_moi_1" 
     value="<?php if (isset($_POST['mat_khau_moi_1'])) echo $_POST['mat_khau_moi_1']?>"> 
     <span class="loi"> 
       <?php if (isset($loi['mat_khau_moi_1'])) echo $loi['mat_khau_moi_1'];?> 
     </span> 
</div>
<div>Nhập lại mật khẩu mới <input type="password" class="txt" name="mat_khau_moi_2" 
     value="<?php if (isset($_POST['mat_khau_moi_2'])) echo $_POST['mat_khau_moi_2']?>"> 
     <span class="loi"> 
       <?php if (isset($loi['mat_khau_moi_2'])) echo $loi['mat_khau_moi_2'];?> 
     </span> 
</div>
<div> <button type="submit">Cập nhật mật khẩu mới</button> </div>
</form>
