<?php
    $conn = new mysqli("localhost", "root", "", "ck_ks");
    $stt = 1;
    $rs = $conn->query("select * from phong");  
    while($r=$rs->fetch_assoc()) {
        echo "<tr>
                <td>".$stt."</td>
                <td>".$r["MAPHONG"]."</td>
                <td>".$r["TENPHONG"]."</td>
                
                <td><button class='chuathem' id='".$r["MAPHONG"]."'>Thêm</button></td>
            </tr>";
        
        $stt ++;
    }
    $conn->close();
?>