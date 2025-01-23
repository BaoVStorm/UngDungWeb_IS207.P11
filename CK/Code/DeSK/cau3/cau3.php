<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Câu 3</title>
        <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    
        <style>
        
        </style>
    </head>
    <body>
        Mã hoá đơn
        <?php
            function taoComboBoxKH($id) {
                echo "<select name='$id' id='$id'>";
                $conn = new mysqli("localhost", "root", "", "ck_ks");
                $rs = $conn->query("select * from hoadon");  
                while($r=$rs->fetch_assoc()) {
                    echo "<option value='".$r["MAHD"]."'>".$r['MAHD']."</option>";
                }
                echo "</select>";
            }

            taoComboBoxKH("cau3_mahd");
        ?>

        <h1>Danh sách các phòng còn trống</h1>
        <table border=1>
            <tr>
                <th>STT</th>
                <th>Mã phòng</th>
                <th>Tên phòng</th>
                <th>Chức năng</th>
            </tr>

            <tbody id="cau3_TrongTable"></tbody>
        </table>

        <h1>Danh sách các phòng đã thêm</h1>
        <table border>
            <tr>
                <th>STT</th>
                <th>Mã phòng</th>
                <th>Tên phòng</th>
                <th>Chức năng</th>
            </tr>
            <tbody id="cau3_DaThemTable"></tbody>
        </table>
    </body>
</html>

<script>
    function load_TrongTable() {
        var url="loadTrongTable.php";
        $.post(url, {}, function (data, status) {
            $("#cau3_TrongTable").html(data);
        });
    }

    load_TrongTable();
</script>

<script>
    $("#cau3_mahd").on("change", function(){
        load_TrongTable();
        $("#cau3_DaThemTable").html("");
    });
</script>


<script>

    $(document).on("click", '.chuathem', function() {
        var maphong = $(this).attr("id");
        var tinhtrang = 1;
        
        var url = "cau3_CapNhatTable.php";
        $.post(url, {
                mahd: $("#cau3_mahd").val(),
                maphong: maphong,
                tinhtrang: tinhtrang
            }, function(data, status) {
                // 
            }
        );
       
        $parent = $(this).closest("tr");
        $clone = $parent.clone();
        $clone.find(".chuathem")
            .addClass('dathem')
            .removeClass('chuathem')
            .text("Xoá");

        if($("#cau3_DaThemTable").find("#"+maphong).length <= 0) {
            $("#cau3_DaThemTable").append($clone);
        }
       
    });

    $(document).on("click", '.dathem', function() {
        var maphong = $(this).attr("id");
        var tinhtrang = 0;
        
        var url = "cau3_CapNhatTable.php";
        $.post(url, {
                mahd: $("#cau3_mahd").val(),
                maphong: maphong,
                tinhtrang: tinhtrang
            }, function(data, status) {
                // 
            }
        );
        
        $parent = $(this).closest("tr");
        $parent.remove();
    });
</script>