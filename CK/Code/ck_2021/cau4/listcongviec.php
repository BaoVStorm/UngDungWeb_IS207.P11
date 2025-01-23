<?php
    $soxe = $_POST["soxe"];
    $ngaynhan = $_POST["ngaynhan"];
    $conn = new mysqli("localhost", "root", "", "ck_2021");
    $rs=$conn->query("select * from congviec as cv join ct_bd on cv.macv=ct_bd.macv join baoduong as bd on bd.mabd=ct_bd.mabd where soxe = '$soxe' and ngaynhan = '$ngaynhan'");
    while($r=$rs->fetch_assoc()) {
        $tencv = $r["TENCV"];
        $macv = $r["MACV"];
        $dongia = $r["DONGIA"];
        
        echo "<tr>
                <td>$tencv</td>
                <td class = 'tien'>$dongia</td>
                <td><input type='button' onclick='xoa(\"$macv\")' value ='Xoá'></td>
            </tr>";
    }
    $conn->close();
?>