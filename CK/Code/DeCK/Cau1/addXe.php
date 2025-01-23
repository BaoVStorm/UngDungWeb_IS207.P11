<?php
    $conn = new mysqli("localhost", "root", "", "ck_xe"); 

    
    
    $SoXe = $_POST["maxe"];
    $TenXe = $_POST["tenxe"];
    $HangXe = $_POST["hangxe"];
    $SoCho = $_POST["socho"];
    $NamSanXuat = $_POST["namsx"];
    $DonGT = $_POST["dongt"];

    $stmt = $conn->prepare("INSERT INTO xe (soxe, tenxe, hangxe, socho, namsx, dgthue, tinhtrang) VALUES (?, ?, ?, ?, ?, ?, 0)");
    $stmt->bind_param("issiid", $SoXe, $TenXe, $HangXe, $SoCho, $NamSanXuat, $DonGT);
    
    $stmt->execute(); 
    
    $stmt->close();
    $conn->close();
?>
