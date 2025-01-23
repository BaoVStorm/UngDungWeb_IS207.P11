<?php
    $conn = new mysqli("localhost", "root", "", "ck_xe");
    $rs = $conn->query("select * from xe where tinhtrang = 0");
    while($r = $rs->fetch_assoc()) {
        $soxe = $r["SoXe"];
        $tenxe = $r["TenXe"];
        $hangxe = $r["HangXe"];
        $namsx = $r["NamSX"];
        $socho = $r["SoCho"];
        $dgthue = $r["DGThue"];
        echo "<tr>
                <td>$soxe</td>
                <td>$tenxe</td>
                <td>$hangxe</td>
                <td>$namsx</td>
                <td>$socho</td>
                <td>$dgthue</td>
                <td><button id='$soxe' class='chuathue'>Thuê</button></td> 
            </tr>";
    }
?>