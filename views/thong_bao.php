<div id="thong_bao">
    <?php 
    if (isset($_SESSION['thong_bao'])){
        echo  $_SESSION['thong_bao'];
        unset($_SESSION['thong_bao']);
    } else echo "Không có gì để thông báo";
    ?>
</div>
