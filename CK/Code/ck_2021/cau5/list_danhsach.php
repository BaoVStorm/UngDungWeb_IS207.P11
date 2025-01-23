<?php
    $sl = $_POST["sl"];

    $conn = new mysqli("localhost", "root", "", "ck_2021");
    $rs=$conn->query("select hotenkh, xe.soxe, count(mabd) as sl from baoduong as bd join xe on xe.soxe = bd.soxe join khachhang as kh on kh.makh = xe.makh group by hotenkh, soxe having count(mabd) > '$sl'");
    while($r=$rs->fetch_assoc()) {
        $tencv = $r["hotenkh"];
        $macv = $r["soxe"];
        $dongia = $r["sl"];
        
        echo "<tr>
                <td>$tencv</td>
                <td>$macv</td>
                <td>$dongia</td>  
            </tr>";
        
    }
    $conn->close();
?>