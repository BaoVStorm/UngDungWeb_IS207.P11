<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Câu 1</title>
        <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    
        <style>
            form{
                display: flex;
                flex-direction: column;
                width: 150px;
                gap: 5px;
            }

            form input{
                padding: 5px;
            }
        </style>
    </head>
    <body>
        <h1>Thêm xe (NO Ajax)</h1>
        <form method="POST">
            <span>Mã xe</span>
            <input type="text" placeholder="51E-xxx.xx" name="cau1_maxe" id="cau1_maxe">
            <span>Tên Xe</span>
            <input type="text" placeholder="Forester" name="cau1_tenxe" id="cau1_tenxe">
            <span>Hãng xe</span>
            <input type="text" placeholder="Subaru" name="cau1_hangxe">
            <span>Số chỗ</span>
            <input type="number" placeholder="5" name="cau1_socho">
            <span>Năm Sản Xuất</span>
            <input type="number" placeholder="2022" name="cau1_namsx">
            <span>Đơn giá thuê</span>
            <input type="number" placeholder="1000000" name="cau1_dgthue">

            <button>Thêm</button>
        </form>
    </body>
</html>
 
<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $conn = new mysqli("localhost", "root", "", "ck_xe");

        $stmt = $conn->prepare("INSERT INTO xe (soxe, tenxe, hangxe, socho, namsx, dgthue, tinhtrang) VALUES (?, ?, ?, ?, ?, ?, 0)");
        $stmt->bind_param("issiid", $_POST['cau1_maxe'], $_POST['cau1_tenxe'], $_POST['cau1_hangxe'], $_POST['cau1_socho'], $_POST['cau1_namsx'], $_POST['cau1_dgthue']);
        
        $stmt->execute();
        $stmt->close();
        $conn->close();
    }
?>