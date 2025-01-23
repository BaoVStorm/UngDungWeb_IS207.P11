<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Câu 4</title>
        <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    </head>
    <body>
        <form method="post">
            Mã điểm du lịch
            <input type="text" name="cau4_maddl" id="cau4_madll" value="<?=$_GET["maddl"]?>"> <br>
            Tên điểm du lịch
            <input type="text" name="cau4_tenddl" id="cau4_tenddl" value="<?=$_GET["tenddl"]?>"> <br>
            Tên thành phố
            <select name="cau4_matp" id="cau4_matp">
            <?php
                $conn = new mysqli("localhost", "root", "", "ck_2122");
                $rs = $conn->query("select mattp, tenttp from tinhtp");
                while($r=$rs->fetch_assoc()) {
                    $mattp = $r["mattp"];
                    $tenttp = $r["tenttp"];
                    if($_GET["mattp"] == $mattp)
                        echo "<option value='$mattp' selected>$tenttp</option>";
                    else
                        echo "<option value='$mattp'>$tenttp </option>";
                }
                $conn->close();
            ?>
            </select> <br>
            Đặc trưng
            <input type="text" name="cau4_dactrung" id="cau4_dactrung" value="<?=$_GET["dactrung"]?>"> <br>
            <button type="submit">Update</button>
        </form>
    </body>
</html>


<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $maddl = $_POST["cau4_maddl"];
        $tenddl = $_POST["cau4_tenddl"];
        $mattp = $_POST["cau4_matp"];
        $dactrung = $_POST["cau4_dactrung"];

        $conn = new mysqli("localhost", "root", "", "ck_2122");
        $conn->query("update diemdl set tenddl = '$tenddl', mattp = '$mattp', dactrung = '$dactrung' where maddl = '$maddl'");
        $conn->close();
    }
?>