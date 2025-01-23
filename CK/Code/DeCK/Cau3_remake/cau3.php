<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Câu 3</title>
        <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    </head>


    <body>
        <h1>thuê xe</h1>
        <span>họ tên khách hàng</span>
        <select name="thuexe_makh" id="thuexe_makh">
            <?php
                 $conn = new mysqli("localhost", "root", "", "ck_xe");
                 $stmt = $conn->prepare("SELECT * FROM khachhang");
                 $stmt->execute();
                 $result = $stmt->get_result();
                 while ($row = $result->fetch_assoc()) {
                     echo "<option value=".$row['makh'].">".$row['tenkh']."</option>";
                 }
                 $stmt->close();
                 $conn->close();
            ?>
        </select>

        <span>Ngày thuê xe</span>
        <input type="number" name="thuexe_ngaythuexe" id="thuexe_ngaythuexe" placeholder="2023">

        <h1>Danh sách các xe chưa thuê</h1>

        <table border="1">
            <tr>
                <th>Số xe</th>
                <th>Tên xe</th>
                <th>Hãng xe</th>
                <th>Năm sản xuất</th>
                <th>Số chỗ</th>
                <th>Đơn giá thuê</th>
                <th>Chọn thuê</th>
            </tr>
            <tbody id="chuathue_table"></tbody>
        </table>

        <h1>Danh sách các xe đang thuê</h1>

        <table border="1">
            <tr>
                <th>Số xe</th>
                <th>Tên xe</th>
                <th>Hãng xe</th>
                <th>Năm sản xuất</th>
                <th>Số chỗ</th>
                <th>Đơn giá thuê</th>
                <th>Chọn thuê</th>
            </tr> 
            <tbody id="dangthue_table" ></tbody>
        </table>
    </body>
</html>

<script>
    function taobangchuathue() {
        var url = "TaoBangChuaThue.php";
        $.post(url, {}, function(data) {
                $("#chuathue_table").html(data);
            });
    }

    taobangchuathue();
</script>

<script>
    $("#thuexe_makh").on("change", function(){
       $("#dangthue_table").html(""); 
    });
</script>

<script>
    $(document).on("click", ".chuathue", function(){
        $soxe = $(this).attr("id");
        
        var url = "capNhatTable.php";
        $.post(url, {
                makh: $("#thuexe_makh").val(),
                ngaythue: $("#thuexe_ngaythuexe").val(),
                soxe: $soxe,
                tinhtrang: 1
            }, function(data) {
                // 
            }
        );

        $parent = $(this).closest("tr");
        // thêm
        $clone = $parent.clone();
        $clone.find('.chuathue')
            .addClass("dathue")
            .removeClass("chuathue")
            .text("Không thuê");

        $("#dangthue_table").append($clone);
        // xoá
        $parent.remove();
    });

    $(document).on("click", ".dathue", function(){
        $soxe = $(this).attr("id");

        var url = "capNhatTable.php";
        $.post(url, {
                makh: $("#thuexe_makh").val(),
                ngaythue: $("#thuexe_ngaythuexe").val(),
                soxe: $soxe,
                tinhtrang: 0
            }, function(data) {
                // 
            }
        );

        $parent = $(this).closest("tr");
        // thêm
        $clone = $parent.clone();
        $clone.find('.dathue')
            .addClass("chuathue")
            .removeClass("dathue")
            .text("Thuê");

        $("#chuathue_table").append($clone);
        // xoá
        $parent.remove();
    });
</script>

