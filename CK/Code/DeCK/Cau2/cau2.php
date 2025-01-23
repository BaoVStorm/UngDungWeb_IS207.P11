<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Câu 2</title>
        <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    
        <style>
            form{
                display: flex;
                flex-direction: column;
                width: 150px;
                gap: 5px;
            }

            form input{
                padding: 5px;
            }
        </style>
    </head>
    <body>
        <h1>Thông tin trả xe</h1>
        
        <form>
            <span>Họ tên khách hàng</span>
            
                <?php
                    function insertCombobox() {
                        echo '<select name="traxe_hotenkh" id="traxe_hotenkh">';
                        
                        $conn = new mysqli("localhost", "root", "", "ck_xe");
                        $stmt = $conn->prepare("SELECT * FROM khachhang");
                        $stmt->execute();
                        $result = $stmt->get_result();
                        while ($row = $result->fetch_assoc()) {
                            echo "<option value=".$row['makh'].">".$row['tenkh']."</option>";
                        }
                        $stmt->close();
                        $conn->close();

                        echo "</select>";
                    }

                    insertCombobox();
                ?>
            

            <span>Số xe</span>
            <input type="number" id="traxe_soxe" placeholder="51H-xxx.xx" name="traxe_soxe" value="11">
            <!-- gia thue xe voi SoXe: 11 là 800000 -->
             
            <span>Ngày thuê</span>
            <input type="number" id="traxe_ngaythue" placeholder="2023" name="traxe_ngaythue" value="10">

            <span>Ngày trả</span>
            <input type="number" id="traxe_ngaytra" placeholder="2023" name="traxe_ngaytra">

            <input type="button" value="Trả Xe" onclick="addTraXe()">
        </form>
    </body>
</html>

<script>
    function addTraXe() {
        var url = "addTraXe.php";
        $.post(url, {
                makh: $("#traxe_hotenkh").val(),
                soxe: $("#traxe_soxe").val(),
                ngaythue: $("#traxe_ngaythue").val(),
                ngaytra: $("#traxe_ngaytra").val()
            }, function(data, status) {
                // console.log(data);
                console.log("Thực hiện chỉnh sửa trả xe thành công");
            }
        );
    }
</script>