<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Câu 2</title>
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
        <h1>Thông tin trả xe</h1>
        
        <form method="POST">
            <span>Họ tên khách hàng</span>
            <select name="traxe_hotenkh" id="traxe_hotenkh">
                <?php
                    $conn = new mysqli("localhost", "root", "", "ck_xe");
                    $stmt = $conn->prepare("SELECT * FROM khachhang");
                    $stmt->execute();
                    $result = $stmt->get_result();
                    while ($row = $result->fetch_assoc()) {
                        echo "<option value=".$row['makh'].">".$row['tenkh']."</option>";
                    }
                    $stmt->close();
                    $conn->close();
                ?>
            </select>

            <span>Số xe</span>
            <input type="number" id="traxe_soxe" placeholder="51H-xxx.xx" name="traxe_soxe" value="11">

            <span>Ngày thuê</span>
            <input type="number" id="traxe_ngaythue" placeholder="2023" name="traxe_ngaythue" value="10">

            <span>Ngày trả</span>
            <input type="number" id="traxe_ngaytra" placeholder="2023" name="traxe_ngaytra">

            <button>Trả xe</button>
        </form>
    </body>
</html>

<?php
   if($_SERVER["REQUEST_METHOD"] == "POST") {
        $conn = new mysqli("localhost", "root", "", "ck_xe");

        $makh = $_POST["traxe_hotenkh"];
        $soxe = $_POST["traxe_soxe"];
        $ngaythue = (int) $_POST["traxe_ngaythue"];
        $ngaytra = (int) $_POST["traxe_ngaytra"];

        // kết nối csdl để lấy giá thuê
        $dgthue = 0;
        $stmt = $conn->prepare("SELECT dgthue FROM xe WHERE soxe = ?");
        $stmt->bind_param("i", $soxe);
        $stmt->execute();
        $result = $stmt->get_result();
        while ($row = $result->fetch_assoc()) {
            $dgthue = $row["dgthue"];
        }
        $stmt->close();

        // sửa bảng thuê
        $giathue = max($ngaytra - $ngaythue, 1) * $dgthue;
        $stmt = $conn->prepare("UPDATE thue SET ngaytra = ?, giathue = ? WHERE makh = ? and soxe = ? and ngaythue = ?");
        $stmt->bind_param("idiii", $ngaytra, $giathue, $makh, $soxe, $ngaythue);
        $stmt->execute();
        $stmt->close();
        $conn->close();
    }
?>