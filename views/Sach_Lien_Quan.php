<?php if ($lienquan_arr!=null) { ?>
<div class="lien_quan">
  <h2> Sách liên quan</h2>
  <div id="data">
    <?php foreach($lienquan_arr as $row) {  ?>
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
        </div>
    <?php } ?>
  </div>
</div>
<?php } ?>
