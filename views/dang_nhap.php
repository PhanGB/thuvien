<style>
#frmdn { border: 2px solid darkcyan; width: 900px; font-size: 1.2em; 
    margin: 0 auto 15px auto;  box-shadow: 2px 2px darkcyan ; border-radius: 5px; }
#frmdn > div { padding: 10px}
#frmdn .txt { width: 100%; padding: 10px; border: 1px solid darkcyan;  outline: none;} 
#frmdn button { height: 35px; width: 150px; border: 1px solid darkcyan; }
.caption { margin:0 ; font-size: 24px;; background: darkcyan; padding: 6px; color:white}
.loi { color: red; margin-top:0; font-weight: 600;}

</style>

<form id="frmdn" method="post" action="">
<h2 class="caption"> Trang thành viên đăng nhập</h2>
<div>Email <input type="email" class="txt" name="email" 
          value="<?php if (isset($_POST['email'])) echo $_POST['email']?>"> 
    <span class="loi"> 
       <?php if (isset($loi['email'])) echo $loi['email'];?> 
    </span>
</div>
<div> Mật khẩu <input type="password" class="txt" name="mat_khau" 
         value="<?php if (isset($_POST['mat_khau'])) echo $_POST['mat_khau']?>"> 
      <span class="loi"> 
        <?php if (isset($loi['mat_khau'])) echo $loi['mat_khau'];?> 
      </span> 
</div>
<div> <button type="submit">Đăng nhập</button> </div>
</form>
