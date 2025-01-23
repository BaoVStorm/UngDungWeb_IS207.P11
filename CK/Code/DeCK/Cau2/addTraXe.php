<?php
    $conn = new mysqli("localhost", "root", "", "ck_xe");

    $makh = $_POST["makh"];
    $soxe = $_POST["soxe"];
    $ngaythue = (int) $_POST["ngaythue"];
    $ngaytra = (int) $_POST["ngaytra"];

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

    // echo "makh: ".$makh.", soxe: ".$soxe.", ngaythue: ".$ngaythue.",ngaytra: ".$ngaytra.", dgthue: ".$giathue;
?>