<style>
#list_sach {border: 1px solid darkcyan; width: 100%; font-size: 1.2em }
#list_sach td, #list_sach th { border: 1px solid darkcyan; padding: 8px} 
#list_sach caption { font-size: 24px; padding: 5px ; font-weight: 600;}
#list_sach .hinh { width: 160px}
#list_sach .ten_sp { width: auto }
#list_sach .thongtin { width: 220px ; text-align: center;} 
#list_sach .nut { width: 150px }
#list_sach .hinh img { max-width: 100%; height: 120px}
#list_sach .thongtin p { margin: 10px}
#list_sach .ten_sp * { margin: 10px}
#list_sach .btnsua {  width: 80%; height: 40px; background: #0069d9; color:white; 
    border: none; outline:none; margin: 10px}
#list_sach .btnxoa {  width: 80%; height: 40px ; background: #c82333; color:white; 
    border: none; outline:none; margin: 10px}
#pagination { margin: 20px; text-align: center;}
#pagination a { text-decoration: none; background: darkcyan;  color:white; 
    font-weight: 600; margin: 10px; line-height: 45px; border-radius: 50%; 
    width: 45px; height: 45px; display: inline-block;}
#pagination span {  background: orange;  color:white; 
    font-weight: 600; margin: 10px; line-height: 45px; border-radius: 50%; 
    width: 45px; height: 45px; display: inline-block;}
</style>
<table id="list_sach" cellspacing="0">
    <caption>DANH SÁCH CÁC SÁCH</caption>
    <tr> <th>Tên sách</th> <th>Thông tin</th><th>Sửa Xóa</th> </tr>
    <?php foreach($data_arr as $row) { ?>
    <tr>
        <td class="ten_sp">
            <img align="left" class="hinh" src="<?php 
            if ( substr($row['hinh'],0, 4)=="http") echo $row['hinh'];
            else echo PUBLIC_URL.$row['hinh'];?>" />
            <h4> <?php echo $row['ten']?> </h4>
            <p>Giá: <?php echo number_format($row['gia'], 0, "","."); ?> VNĐ </p>
            <p>Năm xuất bản: <?php echo $row['nam_xuat_ban'];?></p>
            <p>Tác giả: <?php echo $row['ten_tac_gia'];?></p>
            <p>Nhà xuất bản: <?php echo $row['ten_nxb'];?></p>
        </td>
        <td class="thongtin"> 
            <p title="Đây là ngày cập nhật">
                <?php echo  date('d/m/Y', strtotime($row['ngay_cap_nhat']))  ?> 
            </p>
            <p title="Đây là trạng thái ẩn hiện của sách">
               <?php echo $row['an_hien']==0 ? "Đang ẩn":"Đang hiện"?> 
            </p>
            <p>Xem: <?php echo $row['luot_xem'];?></p>
        </td>
        <td class="nut">
            <a href="admin.php?page=sua_sach&id=<?php echo $row['id']?>">
                <button class="btnsua"> Sửa </button>
            </a>
            <a href="admin.php?page=xoa_sach&id=<?php echo $row['id']?>" 
            onclick="return confirm('Xóa thật không bạn yêu ơi')"
            >
                <button class="btnxoa"> Xóa </button>
            </a>
        </td>
    </tr>    
    <?php } ?>
    <tr id="pagination"> <td colspan="3">
    <?php
        $from = $page_num - 3;   //13
        $to = $page_num + 3;  //17
        if ( $from <= 0) $from = 1;       
        if ( $to >= $so_trang ) $to = $so_trang;    
        $page_prev = $page_num -1; 
        $page_next = $page_num + 1; 
        if ($page_num > 1) {
            echo "<a href='admin.php?page=list_sach'> << </a>";
            echo "<a href='admin.php?page=list_sach&page_num=$page_prev'> < </a>";
        }
        for ($i = $from ; $i<=$to ; $i++){
            if ($i ==$page_num) {
                echo "<span> $i </span>";
            }else {
                echo "<a href='admin.php?page=list_sach&page_num=$i'> $i </a>";
            }
        }
        if ($page_num < $so_trang){
            echo "<a href='admin.php?page=list_sach&page_num=$page_next'> >  </a>";
            echo "<a href='admin.php?page=list_sach&page_num=$so_trang'> >>  </a>";
        }
    ?>
    </td></tr>
</table>
