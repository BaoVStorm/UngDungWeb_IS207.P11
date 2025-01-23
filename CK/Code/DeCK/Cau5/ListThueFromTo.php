<?php
    echo "
        <tr>
            <th>STT</th>
            <th>Số xe</th>
            <th>Tên xe</th>
            <th>Giá thuê</th>
        </tr>";
    
    $conn = new mysqli("localhost", "root", "", "ck_xe");
    $stmt = $conn->prepare("SELECT thue.soxe, tenxe, giathue FROM thue join xe on thue.soxe = xe.soxe WHERE makh = ? and ? <= ngaytra and ngaytra <= ?");
    
    $stt = 1;
    $makh = $_POST["makh"];
    $tungay = $_POST["tungay"];
    $denngay = $_POST["denngay"];
    $stmt->bind_param("iii", $makh, $tungay, $denngay);
    $stmt->execute();
    $result = $stmt->get_result();
    while ($row = $result->fetch_assoc()) {
        echo "
        <tr>
            <th>".$stt."</th>
            <th>".$row["soxe"]."</th>
            <th>".$row["tenxe"]."</th>
            <th>".$row["giathue"]."</th>
        </tr>";
        $stt++;
    }
    $stmt->close();
    $conn->close();
?>

