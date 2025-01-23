<?php
    $soxe = $_POST["soxe"];
    $conn = new mysqli("localhost", "root", "", "ck_2021");
    $rs = $conn->query("select hotenkh from khachhang join xe on khachhang.makh = xe.makh where soxe = '$soxe'");
    $r = $rs->fetch_assoc();
    echo $r["hotenkh"];
    $conn->close();
?>