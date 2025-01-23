<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Câu 3</title>
        <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    </head>
    <body>
        <table border="1">
            <tr>
                <th>STT</th>
                <th>Mã điểm du lịch</th>
                <th>tên điểm du lịch</th>
                <th>tên thành phố</th>
                <th>đặc trưng</th>
                <th>chức năng</th>
            </tr>
            <tbody id="table_cau3"></tbody>
        </table>
    </body>
</html>

<script>
    function taobang() {
        var url = "cau3_loadddl.php";
        $.post(url, {}, function(data){
            $("#table_cau3").html(data);
        });
    }
    taobang();
</script>

<script>
    function xoa(maddl){
        var url = "cau3_xoaddl.php";
        $.post(url, {maddl: maddl}, function(data){
            taobang();
            console.log(data);
        });
    }
    function view(maddl, tenddl, mattp, dactrung){
        window.location.href = `cau4.php?maddl=${maddl}&tenddl=${tenddl}&mattp=${mattp}&dactrung=${dactrung}`;
    }
</script>