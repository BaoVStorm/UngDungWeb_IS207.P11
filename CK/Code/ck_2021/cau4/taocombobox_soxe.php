<?php
    $ngay = $_POST["ngay"];
    $conn = new mysqli("localhost", "root", "", "ck_2021");
    $rs = $conn->query("select soxe from baoduong where ngaynhan = '$ngay'");
    while($r=$rs->fetch_assoc()) {
        $soxe=$r["soxe"];
        echo "<option value='$soxe'>$soxe</option>";
    }
    $conn->close();
?>