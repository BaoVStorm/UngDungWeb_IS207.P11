<?php
    echo "
        <tr>
            <th>Số xe</th>
            <th>Tên xe</th>
            <th>Hãng xe</th>
            <th>Năm sản xuất</th>
            <th>Số chỗ</th>
            <th>Đơn giá thuê</th>
            <th>Chọn thuê</th>
        </tr>";

    $sql = "SELECT * FROM xe where tinhtrang = 0";
    $rs = $conn->query($sql);

    while ($r = $rs->fetch_assoc()) {
        echo "
        <tr>
            <td>".$r["SoXe"]."</td>
            <td>".$r["TenXe"]."</td>
            <td>".$r["HangXe"]."</td>
            <td>".$r["NamSX"]."</td>
            <td>".$r["SoCho"]."</td>
            <td>".$r["DGThue"].'</td>
            
            <td><input type="button" value="Thuê" onclick="EditThueXe('.$r["SoXe"].', 1)"></td>
        </tr>
        ';
    }

    echo '
        <tr >
            <td colspan="7">danh sách các xe đang thuê</td>
        </tr>';

    $sql1 = "SELECT * FROM xe join thue on xe.soxe = thue.soxe where xe.tinhtrang = 1 and thue.makh = '".$_POST['makh']."'";
    $rs = $conn->query($sql1);

    while ($r = $rs->fetch_assoc()) {
        echo '
        <tr>
            <td>'.$r["SoXe"].'</td>
            <td>'.$r["TenXe"].'</td>
            <td>'.$r["HangXe"].'</td>
            <td>'.$r["NamSX"].'</td>
            <td>'.$r["SoCho"].'</td>
            <td>'.$r["DGThue"].'</td>
            
            <td><input type="button" value="Không Thuê" onclick="EditThueXe('.$r["SoXe"].', 0)"></td>
        </tr>';
    }
?>