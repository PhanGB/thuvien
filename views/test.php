<form>
    <p>
        <select id="tinh" onchange="hienhuyentrongtinh()">
            <?php foreach($tinh_arr as $tinh){ ?>
                <option value="<?php echo $tinh['province_id']?>"> 
                    <?php echo $tinh['name']?> 
                </option>
            <?php } ?> 
        </select>
    </p>
    <p>
        <select id="huyen">
            
        </select>
    </p>
</form>
<script>
function hienhuyentrongtinh(){
    id_tinh = event.target.value;
    //alert(id_tinh);

    fetch("http://localhost/thuvien/index.php?page=huyen_trong_tinh&id=" + id_tinh)
    .then (res => res.text())
    .then (data =>{
        console.log(data);
        document.querySelector("#huyen").innerHTML = data;
    })


}
</script>