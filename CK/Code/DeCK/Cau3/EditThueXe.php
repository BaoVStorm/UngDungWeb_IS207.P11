<?php
    $conn = new mysqli("localhost", "root", "", "ck_xe");

    $stmt = $conn->prepare("UPDATE xe SET tinhtrang = ? WHERE soxe = ?");  
    
    // $conn->query($)

    $tinhtrang = $_POST["tinhtrang"];
    $soxe = $_POST["maxe"];
    $stmt->bind_param("ii", $tinhtrang, $soxe);
    
    $stmt->execute();
    $stmt->close();

    $makh = $_POST["makh"];
    $ngthue = $_POST["ngthue"];

    if($tinhtrang == 1) {
        // thêm makh, soxe và ngthue vào bảng thue
        $stmt = $conn->prepare("INSERT INTO thue (makh, soxe, ngaythue) VALUES (?, ?, ?)");
        $stmt->bind_param("iii", $makh, $soxe, $ngthue);
        $stmt->execute();
        $stmt->close();
    }
    else {
        // xoá với makh và soxe trong bản thue
        $stmt = $conn->prepare("DELETE FROM thue WHERE makh = ? AND soxe = ?");
        $stmt->bind_param("ii", $makh, $soxe);
        $stmt->execute();
        $stmt->close();
    }

    $conn->close();
?>