<style>
.list_bai_viet h2 {  padding: 10px }
.list_bai_viet #data { display: grid; grid-template-columns: 32%  32% 32% }
.list_bai_viet #data .bv { border: 1px solid darkcyan; text-align: center; font-size: 1.2em;}
.list_bai_viet #data .bv > * { margin: 10px}
.list_bai_viet #data .bv  h3.tieu_de { font-size: 1.2em;  color:darkslateblue; height: 40px;} 
.list_bai_viet #data .bv  p.mo_ta_ngan { font-size: 1.1em; line-height: 160%; text-align: justify;
  height: 240px; overflow: hidden; padding: 10px; } 
.list_bai_viet #data .bv  img { width: 96%; height:230px}
#pagination { margin: 20px; text-align: center;}
#pagination a { text-decoration: none; background: darkcyan;  color:white; font-weight: 600;
 margin: 10px;line-height:45px; border-radius:50%; width:45px; height:45px; display:inline-block;}

</style>
<div class="list_bai_viet">
  <h2> Bài viết </h2>
  <div id="data">
    <?php foreach($data_arr as $row) {  ?>
        <div class="bv">
            <img src="<?php if ( substr($row['hinh'],0, 4)=="http") echo $row['hinh'];
            else echo PUBLIC_URL.$row['hinh']; ?>" />
            <h3 class="tieu_de">
              <a href="index.php?page=bv&id=<?php echo $row['id']?>">
                <?php echo $row['tieu_de'];?>
              </a>
            </h3>
            <p class="mo_ta_ngan"> <?php echo $row['mo_ta_ngan']; ?> </p>
        </div>
    <?php } ?>
  </div>
  <div id="pagination">
  <?php $from = $page_num - 3;  $to = $page_num + 3;
        if ( $from <= 0) $from = 1;       
        if ( $to >= $so_trang ) $to = $so_trang;       
        for ($i = $from ; $i<=$to ; $i++){
        echo "<a href='index.php?page=bai_viet&page_num=$i'> $i </a>";
        }
    ?>
  </div>
</div>
