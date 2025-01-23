<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Câu 3</title>
        <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    </head>
    <body>
        <form>
            <span>từ ngày</span>
            <input type="number" id="cau5_tungay" name="cau5_tungay" placeholder="2023">
            <span>Đến ngày</span>
            <input type="number" id="cau5_denngay" name="cau5_denngay" placeholder="2025">
            <br><br>
            <span>Họ tên khách hàng</span>
            <select name="cau5_hotenkh" id="cau5_hotenkh">
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
        </form>

        <table border=1 id="cau5_table"></table>
    </body>
</html>

<script>
    function ChangeTable() {
        var url = "ListThueFromTo.php";

        $.post(url, { 
                makh: $("#cau5_hotenkh").val(),
                tungay: $("#cau5_tungay").val(),
                denngay: $("#cau5_denngay").val()
            }, function(data, status){            
                $('#cau5_table').html(data);
            }
        );

        console.log("successfully");
    }

    $("#cau5_hotenkh").on("change", function() {
        ChangeTable();
    });

    ChangeTable();

</script>
