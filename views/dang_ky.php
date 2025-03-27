<style>

#frmdk { 
    border: 2px solid darkcyan; width: 900px; 
    font-size: 1.2em; margin: 0 auto 15px auto; 
    box-shadow: 2px 2px darkcyan ; border-radius: 5px;
}
#frmdk > div { padding: 10px}
#frmdk .txt { width: 100%; padding: 10px; border: 1px solid darkcyan;  outline: none;} 
#frmdk button { height: 35px; width: 150px; border: 1px solid darkcyan; }
.caption { margin:0 ; font-size: 24px;; background: darkcyan; padding: 6px; color:white}
#frmdk .loi { color: red; font-weight: 600; font-style: italic;}

</style>
<form id="frmdk" method="post" action="">
<h2 class="caption"> Trang đăng ký thành viên</h2>
<div>Họ tên <input type="text" class="txt" name="ho_ten" 
     value="<?php if (isset($_POST['ho_ten'])) echo $_POST['ho_ten']?>"> 
    <span class="loi"> 
       <?php if (isset($loi['ho_ten'])) echo $loi['ho_ten'];?> 
    </span>
</div>
<div>Email <input type="text" class="txt" name="email" 
    value="<?php if (isset($_POST['email'])) echo $_POST['email']?>"> 
    <span class="loi"> 
       <?php if (isset($loi['email'])) echo $loi['email'];?> 
    </span>
</div>
<div>Mật khẩu <input type="password" class="txt" name="mat_khau" 
     value="<?php if (isset($_POST['mat_khau'])) echo $_POST['mat_khau']?>"> 
    <span class="loi"> 
       <?php if (isset($loi['mat_khau'])) echo $loi['mat_khau'];?> 
    </span> 
</div>
<div> Nhập lại mật khẩu <input type="password" class="txt" name="mat_khau_nhap_lai" 
    value="<?php if (isset($_POST['mat_khau_nhap_lai'])) echo $_POST['mat_khau_nhap_lai']?>"> 
    <span class="loi"> 
       <?php if (isset($loi['mat_khau_nhap_lai'])) echo $loi['mat_khau_nhap_lai'];?> 
    </span> 
</div>
<div> <button type="submit">Đăng ký</button> </div>
</form>
