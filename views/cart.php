<style>
.cart h2 {  padding: 10px }
.cart .sach { border: 1px solid darkcyan; font-size: 1.1em; padding: 10px 0;
    display:grid ;grid-template-columns: 70px auto 180px 120px 200px 70px ;}
.cart h3.ten { color:darkslateblue; margin: 0} 
.cart p.gia { text-align: center; }
.cart p.tien { text-align: right; }
.cart input.so_luong { width: 80% ; padding: 5px; text-align:center;}
.cart .sach button { background: lightsalmon; color: white; padding: 5px 10px;
     border: none; float: right; margin-right: 10px }

</style>
<div class="cart">
    <h2> Sách đã chọn</h2>
    <div id="data">
        <?php foreach ( $cart_arr as $id => $so_luong ){ $sach = $db->Chi_Tiet($id); ?>
        <div class="sach">
            <div><?=$id ?> </div>
            <h3 class="ten">
                <a href="index.php?page=chi_tiet&id=<?=$id?>"> <?=$sach['ten']?> </a>
            </h3>
            <p class="gia"><?=number_format($sach['gia'],0,"", ".")?> VNĐ</p>
            <p> <input type="number" min="1" max="100" class="so_luong" value="<?=$so_luong?>" 
                onkeyup="chinh_sl(<?=$id?>)" onchange="chinh_sl(<?=$id?>)" >        
            </p>
            <p class="tien"><?=number_format($sach['gia']*$so_luong, 0, "", ".")?> VNĐ</p>
            <p> <a href="index.php?page=xoa_sp_trong_cart&id=<?=$id?>">
                   <button> X </button> 
                </a> 
            </p>
        </div>
        <?php } ?>
    </div>
</div>
<script>
function chinh_sl(id){
    so_luong = event.target.value;
    url=`index.php?page=chinh_so_luong&id=${id}&so_luong=${so_luong}`;
    document.location= url;
}
</script>
