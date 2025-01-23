<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Câu 1</title>
        <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    </head>
    <body>
        <h1>Thêm khách hàng</h1>
        <form method="post">
            mã khách hàng 
            <input type="text" name="cau1_makh" id="cau1_makh" placeholder="KH01"><br>
            họ tên khách hàng
            <input type="text" name="cau1_tenkh" id="cau1_tenkh" placeholder="Trần Anh Hùng"><br>
            Địa chỉ
            <input type="text" name="cau1_diachi" id="cau1_diachi" placeholder="ABC"><br>
            Điện thoại
            <input type="tel" name="cau1_dt" id="cau1_dt" placeholder="09xxxxxxx"><br>
            <button>Thêm</button>
        </form>
    </body>
</html>

<?php
    if($_SERVER["REQUEST_METHOD"] == "POST") {
        $conn = new mysqli("localhost", "root", "", "ck_2021");

        $makh = $_POST["cau1_makh"];
        $tenkh = $_POST["cau1_tenkh"];
        $diachi = $_POST["cau1_diachi"];
        $dt = $_POST["cau1_dt"];
        $conn->query("insert into khachhang (makh, hotenkh, diachi, dienthoai) values ('$makh', '$tenkh', '$diachi', '$dt')");
        $conn->close();
    }
?>
