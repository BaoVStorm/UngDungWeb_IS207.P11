<?php
    $soxe = $_POST["soxe"];
    $makh = $_POST["makh"];
    $ngaythue = $_POST["ngaythue"];
    $tinhtrang = $_POST["tinhtrang"];

    $conn = new mysqli("localhost", "root", "", "ck_xe");
    $conn->query("update xe set tinhtrang = '$tinhtrang' where soxe = '$soxe'");

    if($tinhtrang == 1) {
        // theme vaof bang thue
        $conn->query("insert into thue(makh, soxe, ngaythue) values ('$makh', '$soxe', '$ngaythue')"); 
    }
    else {
        $conn->query("delete from thue where makh = '$makh' and soxe='$soxe' and ngaythue='$ngaythue'");
    }
?>