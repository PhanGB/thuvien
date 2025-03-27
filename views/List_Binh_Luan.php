<style>
#list_binh_luan { 
    width: 80%; 
    margin:20px auto 20px auto;
    border: 1px solid darkcyan;
    padding:20px; 
    font-size: 1.2em
}
#list_binh_luan  .bl {
    border-top: 1px solid darkcyan;
    padding: 10px;
}
</style>
<div id="list_binh_luan">
  <h2> Bình luận của độc giả về sách</h2>
  <div id="data">
    <?php foreach($binhluan_arr as $bl) {  ?>
        <div class="bl">
            <p>     
                <b> <?php echo $bl['ho_ten'] ;?> </b>
                <i> <?php echo date('d/m/Y',  strtotime($bl['thoi_diem']) ) ;?>  </i>
            </p>
            <p> <?php echo $bl['noi_dung'];?>  </p>
        </div>
    <?php }?>
  </div>
</div>