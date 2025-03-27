<style>
#cart {position: absolute;  right:10px; bottom: 10px; }
#cart a { color: yellow; font-weight: 600;}
#cart a:hover { text-decoration: underline;}

</style>
<form id="frmsearch" method="get" >
  <input name="page" value="tim_kiem" type="hidden">   
  <input name="tu_khoa" type="text" placeholder="Từ khóa"
  value="<?php if (isset($_GET['tu_khoa'])) echo $_GET['tu_khoa'] ?>">
  <button type="submit">Tìm</button>
</form>
<div id="userinfo">
  <?php if (isset($_SESSION['ho_ten'])==true) echo "Chào ". $_SESSION['ho_ten'];
        else echo "Chào các bạn";
  ?>
</div>
<h2>Thư viện Hạnh Phúc </h2>
<div id="cart">
  <a href="index.php?page=cart">Sách đã chọn</a>
</div>
