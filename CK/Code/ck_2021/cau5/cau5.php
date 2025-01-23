<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Câu 5</title>
        <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    </head>
    <body>
        <input type="number" id="cau5_sl">
        <table border = 1>
            <tr>
                <th>họ tên khách hàng</th>
                <th>số xe</th>
                <th>số lần bảo dưỡng</th>
                <tbody id="cau5_table"></tbody>
            </tr>
        </table>
    </body>
</html>

<script>
    $("#cau5_sl").keydown("Enter", function() {
        var url = "list_danhsach.php";
        $.post(url, {
                sl: $("#cau5_sl").val()
            }, function(data) {
                $("#cau5_table").html(data);
            }
        );
    });
</script>
