<?php
    $maddl = $_POST["maddl"];

    $conn = new mysqli("localhost", "root", "", "ck_2122");
    $conn->query("delete from chitiet where maddl = '$maddl'");
    $conn->query("delete from diemdl where maddl = '$maddl'");
    $conn->close();
?>