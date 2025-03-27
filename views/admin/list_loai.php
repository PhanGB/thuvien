<style>
#list_loai {border: 1px solid darkcyan;  font-size: 1.2em; width: 100% }
#list_loai caption { font-size: 24px; padding: 5px ; font-weight: 600;}
#list_loai td, #list_loai th { border: 1px solid darkcyan; padding: 8px; margin:0} 
#list_loai .nut { width: 200px; text-align: center; }
#list_loai .btnsua {  width: 60px; height: 30px; background: #0069d9; color:white; 
    border: none; outline:none; }
#list_loai .btnxoa {  width: 60px; height: 30px ; background: #c82333; color:white; 
    border: none; outline:none;}

</style>
<table id="list_loai">
    <caption>DANH SÁCH LOẠI</caption>
    <tr> <th>id</th><th>Tên loại</th> <th>Thứ tự</th><th>Ẩn hiện</th><th>Sửa Xóa</th></tr>
    <?php foreach($data_arr as $row) { ?>
    <tr>
        <td><?php echo $row['id']?> </td>
        <td><?php echo $row['ten']?> </td>
        <td><?php echo $row['thu_tu']?> </td>
        <td><?php echo ($row['an_hien'] == 0) ? "Đang ẩn":"Đang hiện" ?> </td>
        <td class="nut">
         <a href="admin.php?page=sua_loai&id=<?php echo $row['id']?>"> 
             <button class="btnsua"> Sửa </button> </a>
         <a href="admin.php?page=xoa_loai&id=<?php echo $row['id']?>" 
         onclick="return confirm('Xóa hả')"> 
            <button class="btnxoa"> Xóa </button> 
         </a>
        </td>
    </tr>    
    <?php } ?>
    </tr>
</table>
