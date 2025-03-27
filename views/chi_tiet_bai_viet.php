<style>
#chitiet_bai_viet { font-size: 1.3em; line-height: 150%; text-align: justify; }
#chitiet_bai_viet h1 { font-size: 1.5em; margin:20px 0; }
#chitiet_bai_viet .ngay {font-style:italic; float:right;font-size:0.8em;font-weight:400}
#chitiet_bai_viet h2 { font-size: 1.2em; margin:10px 0; line-height: 150%; font-weight: 600; margin:20px 0}
#chitiet_bai_viet #noi_dung > * {  margin: 15px 0; }
#chitiet_bai_viet #noi_dung img { display: inline-block; }

</style>
<div id="chitiet_bai_viet">
  <h1> <?php echo $row['tieu_de'];?>
  <span class="ngay">Cập nhật: <?php echo date('d/m/Y',strtotime($row['ngay']))?></span>
  </h1>
  <h2> <?php echo $row['mo_ta_ngan']?> </h2>
  <div id="noi_dung"> <?php echo $row['noi_dung']?> </div>
</div>
