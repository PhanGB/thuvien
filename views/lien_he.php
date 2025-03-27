<style>
#formlienhe { border: 2px solid darkcyan; padding: 0px 20px ;
    margin: 50px auto 50px auto; font-size: 1.2em; width: 75%;}
#formlienhe p { margin-bottom: 15px;}
#formlienhe h2 { text-align: center;}
#formlienhe span { display: block;}
#formlienhe input, #formlienhe  textarea { padding: 10px;border: 1px solid darkcyan ; width:100%; outline:none}
#formlienhe button { width: 150px; height: 35px; border: 1px solid darkcyan;}
.loi { color: red; margin-top:0; font-weight: 600;}

</style>
<form id="formlienhe" method="post" action="">
    <h2>Form liên hệ</h2>
    <p> <span>Họ tên</span> 
        <input type="text" name="ho_ten"
        value="<?php if (isset($_POST['ho_ten'])) echo $_POST['ho_ten']?>" > 
        <b class="loi"> 
          <?php if (isset($loi['ho_ten'])) echo $loi['ho_ten'];?> 
        </b>
    </p>
    <p> <span>Email</span> 
        <input type="email" name="email"
        value="<?php if (isset($_POST['email'])) echo $_POST['email']?>"  > 
        <b class="loi"> 
          <?php if (isset($loi['email'])) echo $loi['email'];?> 
        </b>
    </p>
    <p> <span>Nội dung liên hệ</span>
        <textarea rows="5" name="noi_dung"><?php if (isset($_POST['noi_dung'])) echo $_POST['noi_dung']?></textarea>
        <b class="loi"> 
          <?php if (isset($loi['noi_dung'])) echo $loi['noi_dung'];?> 
        </b>
    </p>
    <p><span> </span> <button  type="submit" name="btn">Gửi liên hệ </button> </p>
</form>
