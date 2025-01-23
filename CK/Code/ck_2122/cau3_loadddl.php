<?php
    $conn = new mysqli("localhost", "root", "", "ck_2122");
    $stt = 1;
    $rs = $conn->query("select maddl, tenddl, ddl.mattp, dactrung, tenttp from diemdl as ddl join tinhtp as ttp on ddl.mattp = ttp.mattp");
    while($r = $rs->fetch_assoc()) {
        $maddl = $r["maddl"];
        $tenddl = $r["tenddl"];
        $mattp = $r["mattp"];
        $dactrung = $r["dactrung"];
        $tenttp = $r["tenttp"];

        echo "<tr>
                <td>$stt</td>
                <td>$maddl</td>
                <td>$tenddl</td>
                <td>$tenttp</td>
                <td>$dactrung</td>
                <td>
                    <input type='button' value='delete' onclick='xoa(\"$maddl\")'>
                    <input type='button' value='view' onclick='view(\"$maddl\", \"$tenddl\",\"$mattp\",\"$dactrung\")'>
                </td>
            </tr>";

        $stt++;
    }
    $conn->close();
?>