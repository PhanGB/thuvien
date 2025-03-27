<style>
#frm_binh_luan { 
    width: 80%; 
    margin:40px auto 40px auto;
}
#frm_binh_luan textarea {
    width: 100%; 
    border:1px solid darkcyan;
    outline:none;
}
#frm_binh_luan button {
    width: 150px;
    height: 35px;
}
</style>
<form method="post" action="" id="frm_binh_luan">
<p> Bình luận của bạn
    <textarea rows="5" name="noi_dung"></textarea>
    <input type="hidden"  name="id_sach" value="<?php echo $id ?>" />
</p> 
<p>
    <button type="submit" > GỬi bình luận</button>
</p>
</form>