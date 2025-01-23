<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Câu 3</title>
        <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    </head>
    <body>
        <form method="post">
            <h1>thêm bảo dưỡng</h1>
            Số xe
            <input type="text" placeholder="51K-XXX.XX" name="cau3_soxe" id="cau3_soxe"> <br>
            Họ tên khách hàng 
            <input  type="text" placeholder="Trần Anh Hùng" name="cau3_tenkh" id="cau3_tenkh" readonly> <br>
            Mã bảo dưỡng
            <input type="text" placeholder="BD001" name="cau3_mabd" id="cau3_mabd"> <br>
            số KM 
            <input type="number" placeholder="20000" name="cau3_sokm" id="cau3_sokm"> <br>
            nội dung
            <input type="text" placeholder="Bảo dưỡng 20000" name="cau3_nd" id="cau_nd"> <br>
            <button>Thêm</button>
        </form> 
    </body>
</html>

<script>
    $("#cau3_soxe").on("change", function(){
        var url = "chinhsuahotenkh.php";
        $.post(url, {
                soxe: $("#cau3_soxe").val()
            }, function(data, status){
                 $("#cau3_tenkh").val(data);
            }
        );
    });
</script>

<?php
    if($_SERVER["REQUEST_METHOD"] == "POST") {
        $soxe = $_POST["cau3_soxe"];
        $mabd = $_POST["cau3_mabd"];
        $sokm = $_POST["cau3_sokm"];
        $nd = $_POST["cau3_nd"];

        $conn = new mysqli("localhost", "root", "", "ck_2021");
        $conn->query("insert into baoduong(mabd, ngaynhan, ngaytra, sokm, noidung, soxe, thanhtien) values ('$mabd', now(), null, '$sokm', '$nd', '$soxe', null)");
        $conn->close();
    }
?>
