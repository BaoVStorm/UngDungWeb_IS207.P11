<?php
    $tinhtrang = $_POST["tinhtrang"];
    $soxe = $_POST["maxe"];
    $makh = $_POST["makh"];
    $ngthue = $_POST["ngthue"];

    $conn->query("UPDATE xe SET tinhtrang = $tinhtrang WHERE soxe = '$soxe'");  
    
    if($tinhtrang == 1) {
        // thêm makh, soxe và ngthue vào bảng thue
        $stmt = $conn->query("INSERT INTO thue (makh, soxe, ngaythue) VALUES ('$makh', '$soxe', '$ngthue')");
    }
    else {
        // xoá với makh và soxe trong bản thue
        $stmt = $conn->query("DELETE FROM thue WHERE makh = '$makh' AND soxe = '$soxe'");
    }
?>