<?php
    echo "
        <tr>
            <th>STT</th>
            <th>Họ tên khách hàng</th>
            <th>Số xe</th>
            <th>Tên xe</th>
        </tr>";
    
    $stt = 1;
    $ngaythue = $_POST["ngaythue"];

    $conn = new mysqli("localhost", "root", "", "ck_xe");
    $stmt = $conn->prepare("SELECT tenkh, thue.soxe, xe.tenxe FROM thue join khachhang on thue.makh = khachhang.makh join xe on thue.soxe = xe.soxe WHERE ngaythue = ? and ngaytra is null");

    $stmt->bind_param("i", $ngaythue);
    $stmt->execute();
    $result = $stmt->get_result();
    while ($row = $result->fetch_assoc()) {
        echo "
            <tr>
                <td>".$stt."</td>
                <td>".$row["tenkh"]."</td>
                <td>".$row["soxe"]."</td>
                <td>".$row["tenxe"]."</td>
            </tr>";
        $stt++;
    }
    $stmt->close();
    $conn->close();
?>

