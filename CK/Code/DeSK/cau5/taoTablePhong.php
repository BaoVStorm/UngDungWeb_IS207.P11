<?php
    $mahd = $_POST["mahd"];
    $stt = 1;
    $conn = new mysqli("localhost", "root", "", "ck_ks");
    $rs = $conn->query("select thue.maphong, loaiphong from thue join phong on thue.maphong = phong.maphong where mahd = '$mahd'");
    while($r = $rs->fetch_assoc()) {
        $maphong = $r["maphong"];
        $loaiphong = $r["loaiphong"];
        echo "<tr>
                <td>$stt</td>
                <td>$maphong</td>
                <td>$loaiphong</td>
            </tr>";
        $stt++;
    }
    $conn->close();
?>