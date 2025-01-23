<?php
    $makh = $_POST["makh"];
    
    $conn = new mysqli("localhost", "root", "", "ck_ks");
    $rs = $conn->query("select * from hoadon where makh = '$makh'");
    while($r=$rs->fetch_assoc()) {
        $mahd = $r["MAHD"];
        echo "<option value='$mahd'>$mahd</option>";
    }
    $conn->close();
?>