<?php
    $mahd = $_POST["mahd"];
    $maphong = $_POST["maphong"];
    $tinhtrang = $_POST["tinhtrang"];

    $conn = new mysqli("localhost", "root", "", "ck_ks");
    $conn->query("update phong set tinhtrang = '$tinhtrang' where maphong = '$maphong'");

    if($tinhtrang == 1) {
        $conn->query("insert into thue(mahd, maphong) values ('$mahd', '$maphong')");
    }
    else {
        $conn->query("delete from thue where mahd = '$mahd' and maphong='$maphong'");
    }

    $conn->close();
?>