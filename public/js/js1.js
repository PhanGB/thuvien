function add_to_cart(id){
    let url = "index.php?page=add_to_cart&id=" + id;
    fetch(url).then (response => response.text()).then (data => {
        console.log(data);
        let obj =JSON.parse(data);
        if (obj.ket_qua=="") {
            ele = document.querySelector("#cart a");
            if (ele!=null) ele.innerText = "Sách đã chọn ("+ obj.so_sach + ")";
            alert("Đã ghi nhận sản phẩm");
        }
        else {
            alert("Lỗi : " +obj.ketqua);
        }
    })
}

