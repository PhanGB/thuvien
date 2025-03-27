<style>
    #frmquenpass { border: 2px solid darkcyan; width: 900px; 
        font-size: 1.2em; margin: 0 auto 15px auto; 
        box-shadow: 2px 2px darkcyan ; border-radius: 5px; }
    #frmquenpass > div { padding: 10px}
    #frmquenpass .txt { width: 100%; padding: 10px; border: 1px solid darkcyan;  outline: none;} 
    #frmquenpass button { height: 35px; width: 150px; border: 1px solid darkcyan; }
    .caption { margin:0 ; font-size: 24px;; background: darkcyan; padding: 6px; color:white}
    .loi { color: red; margin-top:0; font-weight: 600;}
</style>
<form id="frmquenpass" method="post" action="">
<h2 class="caption"> Quên mật khẩu</h2>
<div> Email <input  class="txt" name="email"> 
    <span class="loi"> 
       <?php if (isset($loi['email'])) echo $loi['email'];?> 
    </span>
</div>
<div> <button type="submit">Gửi nhật khẩu</button> </div>
</form>
