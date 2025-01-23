<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Câu 2</title>
        <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    </head>
    <body>
        <h1>Thêm thông tin xe khách hàng</h1>
        <form method="post">
            họ tên khách hàng
            <select name="cau2_makh" id="cau2_makh">
                <?php
                    $conn = new mysqli("localhost", "root", "", "ck_2021");
                    $rs = $conn->query("select * from khachhang");
                    while($r = $rs->fetch_assoc()) {
                        $makh = $r["MAKH"];
                        $tenkh = $r["HOTENKH"];
                        echo "<option value='$makh'>$tenkh</option>";
                    }
                    $conn->close();
                ?>
            </select> <br>
            số xe 
            <input type="text" name="cau2_soxe" id="cau2_soxe" placeholder="51H-XXX.XX"> <br>
            hãng xe
            <select name="cau2_hangxe" id="cau2_hangxe" size="3">
                <option value="TOYOTA">TOYOTA</option>        
                <option value="BMW">BMW</option>        
                <option value="Audi">Audi</option>        
                <option value="Mescerdes">Mescerdes</option>        
            </select> <br>
            năm sản xuất
            <input type="number" name="cau2_namsx" id="cau2_namsx" placeholder="2023"> <br>
            <button>Thêm</button>
        </form>       
    </body>
</html>

<?php
    if($_SERVER["REQUEST_METHOD"]=="POST") {
        $makh = $_POST["cau2_makh"];
        $soxe = $_POST["cau2_soxe"];
        $hangxe = $_POST["cau2_hangxe"];
        $namsx = $_POST["cau2_namsx"];

        $conn = new mysqli("localhost", "root", "", "ck_2021");
        $conn->query("insert into xe(soxe, hangxe, namsx, makh) values ('$soxe', '$hangxe', '$namsx', '$makh')");
        $conn->close();
    }
?>
