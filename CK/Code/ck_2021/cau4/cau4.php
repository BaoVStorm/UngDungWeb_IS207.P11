<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Câu 4</title>
        <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    </head>
    <body>
        <form method="post">
            <h1>Thanh toán</h1>
            ngày nhận xe
            <input type="date" name="cau4_ngay" id="cau4_ngay"> <br>
            số xe
            <select name="cau4_soxe" id="cau4_soxe">
            </select> <br>
            
            thành tiền
            <input type="number" name="cau4_thanhtien" id="cau4_thanhtien" readonly>

            <table border = 1>
                <tr>
                    <th>Tên công việc</th>
                    <th>Đơn giá</th>
                    <th>Chức năng</th>
                </tr>
                <tbody id="cau4_table"></tbody>
            </table>

            <button>Thanh toán</button>
        </form>
    </body>
</html>

<script>
    function taocombobox_soxe() {
        var url = "taocombobox_soxe.php";
        $.post(url, {
                ngay: $("#cau4_ngay").val()
            }, function(data){
                $("#cau4_soxe").html(data);
                listcongviec();
            }
        );
    }

    $("#cau4_ngay").on("change", function() {
        taocombobox_soxe();
    });

    taocombobox_soxe();
</script>

<script>
    function listcongviec(){
        var url = "listcongviec.php";
        $.post(url, {
                soxe: $("#cau4_soxe").val(),
                ngaynhan: $("#cau4_ngay").val()
            }, function(data) {
                $("#cau4_table").html(data);
                tongtien();
            }
        );
    }
    
    $("#cau4_soxe").on("change", function(){
        listcongviec();
    });
</script>

<script>
    function xoa(macv) {
        url = "xoacongviec.php";
        $.post(url, {
                macv: macv,
                soxe: $("#cau4_soxe").val(),
                ngaynhan: $("#cau4_ngay").val()
            }, function(data){
                listcongviec();
            }
        );
    }

    function tongtien() {
        var tong=0;
        $(".tien").each(function() {
            tong += parseInt($(this).text());
        });

        $("#cau4_thanhtien").val(tong);
    }
    tongtien();
</script>

<?php
    if($_SERVER["REQUEST_METHOD"]=="POST") {
        $soxe = $_POST["cau4_soxe"];
        $thanhtien = $_POST["cau4_thanhtien"];
        $ngaynhan = $_POST["cau4_ngay"];

        $conn = new mysqli("localhost", "root", "", "ck_2021");
        $conn->query("update baoduong set ngaytra = now(), thanhtien = '$thanhtien' where soxe='$soxe' and ngaynhan ='$ngaynhan'");
        $conn->close();
    }
?>
