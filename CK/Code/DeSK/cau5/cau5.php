<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Câu 5</title>
        <script src="https://code.jquery.com/jquery-3.7.1.js"></script>

    </head>
    <body>
        Tên khách hàng
        <select name="cau5_makh" id="cau5_makh">
            <?php
                $conn = new mysqli("localhost", "root", "", "ck_ks");
                $rs = $conn->query("select * from khachhang");
                while($r = $rs->fetch_assoc()) {
                    $makh = $r["MAKH"];
                    $tenkh = $r["TENKH"];
                    echo "<option value='$makh'>$tenkh</option>";
                }            
            ?>
        </select>
        <br>
        Mã hoá đơn
        <select name="cau5_mahd" id="cau5_mahd"></select>
        <br>
        Danh sách các phòng trong hoá đơn

        <table border="1">
            <tr>
                <th>STT</th>
                <th>Mã phòng</th>
                <th>Loại phòng</th>
            </tr>
            <tbody id="phong_Table"></tbody>
        </table>
    </body>
</html>

<script>
    function taocomboboxhoadon() {
        var url = "taoComboboxHoaDon.php";
        $.post(url, {
                makh: $("#cau5_makh").val()
            }, function(data){
                $("#cau5_mahd").html(data);
                taotablephong();
            }
        );
    }

    $("#cau5_makh").on("change", function(){
        taocomboboxhoadon();
    });
    taocomboboxhoadon();
</script>

<script>
    function taotablephong() {
        var url = "taoTablePhong.php";
        $.post(url, {
                mahd: $("#cau5_mahd").val()
            }, function(data){
                $("#phong_Table").html(data);
            }
        );
    }
    $("#cau5_mahd").on("change", function(){
        taotablephong();
    })
</script>