<?php
    $macv = $_POST["macv"];
    $soxe = $_POST["soxe"];    
    $ngaynhan = $_POST["ngaynhan"];

    $conn = new mysqli("localhost", "root", "", "ck_2021");
    $conn->query("delete ct_bd from ct_bd join baoduong as bd on bd.mabd=ct_bd.mabd where macv ='$macv' and soxe = '$soxe' and ngaynhan = '$ngaynhan'");
    $conn->close();
?>