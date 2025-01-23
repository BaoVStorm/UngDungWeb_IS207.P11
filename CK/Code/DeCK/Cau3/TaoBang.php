<?php
    $XeChuaThue = array();
    $XeDaThue = array();

    $conn = new mysqli("localhost", "root", "", "ck_xe");
    $stmt = $conn->prepare("SELECT * FROM xe");
    $stmt->execute();
    $result = $stmt->get_result();
    while ($row = $result->fetch_assoc()) {
        if($row["TinhTrang"] == 0)
            $XeChuaThue[] = $row;
    }
    $stmt->close();


    $stmt = $conn->prepare("SELECT * FROM xe join thue on xe.soxe = thue.soxe where xe.tinhtrang = 1 and thue.makh = ?");

    $makh = $_POST["makh"];
    $stmt->bind_param("i", $makh);
    $stmt->execute();
    $result = $stmt->get_result();
    while ($row = $result->fetch_assoc()) {
        $XeDaThue[] = $row;
    }
    $conn->close();


    $html_table = "
        <tr>
            <th>Số xe</th>
            <th>Tên xe</th>
            <th>Hãng xe</th>
            <th>Năm sản xuất</th>
            <th>Số chỗ</th>
            <th>Đơn giá thuê</th>
            <th>Chọn thuê</th>
        </tr>";
        
    foreach ($XeChuaThue as $xe) {
        $html_table .= "
        <tr>
            <td>".$xe["SoXe"]."</td>
            <td>".$xe["TenXe"]."</td>
            <td>".$xe["HangXe"]."</td>
            <td>".$xe["NamSX"]."</td>
            <td>".$xe["SoCho"]."</td>
            <td>".$xe["DGThue"].'</td>
            
            <td><input type="button" value="Thuê" onclick="EditThueXe('.$xe["SoXe"].', 1)"></td>
        </tr>
        ';
    }
    
    $html_table .= '
        <tr >
            <td colspan="7">danh sách các xe đang thuê</td>
        </tr>
    ';

    foreach ($XeDaThue as $xe) {
        $html_table .= '
        <tr>
            <td>'.$xe["SoXe"].'</td>
            <td>'.$xe["TenXe"].'</td>
            <td>'.$xe["HangXe"].'</td>
            <td>'.$xe["NamSX"].'</td>
            <td>'.$xe["SoCho"].'</td>
            <td>'.$xe["DGThue"].'</td>
            
            <td><input type="button" value="Không Thuê" onclick="EditThueXe('.$xe["SoXe"].', 0)"></td>
        </tr>
        ';
    }

    echo $html_table;
?>