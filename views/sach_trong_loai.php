<style>
.list_sp h2 {  padding: 10px }
.list_sp #data { display: grid; grid-template-columns: 25%  25% 25% 25%}
.list_sp #data .sp { border: 1px solid darkcyan; text-align: center; font-size: 1.2em;}
.list_sp #data .sp > * { margin: 10px}
.list_sp #data .sp h3.ten { font-size: 1.1em;  color:darkslateblue; height: 40px;} 
.list_sp #data .sp p.gia { font-size: 1.1em; font-weight:600;} 
.list_sp #data .sp img { max-width: 90%; height:300px}
.list_sp >#data .sp button { background: darkcyan; color:white; padding:10px 25px;border:none}

#pagination { margin: 20px; text-align: center;}
#pagination a { text-decoration: none; background: darkcyan;  color:white; font-weight: 600;
    margin: 10px; line-height: 45px; border-radius: 50%; 
    width: 45px; height: 45px; display: inline-block;}

</style>
<div class="list_sp">
  <h2> Sách trong loại <?php echo $ten_loai ;?> </h2>
  <div id="data">
    <?php foreach($data_arr as $row) {  ?>
        <div class="sp">
            <img src="<?php 
            if ( substr($row['hinh'],0, 4)=="http") echo $row['hinh'];
            else echo PUBLIC_URL.$row['hinh'];
            ?>" />
            <h3 class="ten">
              <a href="index.php?page=chi_tiet&id=<?php echo $row['id']?>">
                <?php echo $row['ten'];?>
              </a>
            </h3>
            <p class="gia">
              <?php echo number_format($row['gia'],0,"", ".");?> VNĐ                    
            </p>
            <p> <button onclick="add_to_cart(<?=$row['id']?>)">Chọn sách</button> </p>
        </div>
    <?php } ?>
  </div>
  <div id="pagination">
  <?php
        $from = $page_num - 2;  
        $to = $page_num + 2;
        if ( $from <= 0) $from = 1;       
        if ( $to >= $so_trang ) $to = $so_trang;       
        for ($i = $from ; $i<=$to ; $i++){
        echo "<a href='index.php?page=sach_trong_loai&id=$id&page_num=$i'> $i </a>";
        }
    ?>
  </div>
</div>
