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

        <table id="thuexe_table" border="1"> </table>
    </body>
</html>

<!-- Tạo bảng -->
<script>
    function taoBang() {
        var url = "TaoBang.php"; 

        $.post(url, { 
            makh: $("#thuexe_makh").val()
        }, function(data,status){            
                $('#thuexe_table').html(data); 
                console.log("Create table")
            }
        );
    }

    // Tiến hành tạo bảng
    taoBang();
</script>

<!-- Reset lại bảng khi chọn combobox -->
<script>
    $("#thuexe_makh").on("change", function() {
        taoBang()
    });
</script>

<!-- Thao tác thêm và xoá trên bảng thuê xe-->
<script>
    function EditThueXe(MaXe, TinhTrang) {
        var url = "EditThueXe.php"; 
    
        $.post(url, { 
            maxe: MaXe, 
            tinhtrang: TinhTrang,
            makh: $("#thuexe_makh").val(),
            ngthue: $("#thuexe_ngaythuexe").val()
        }, function(data,status){            
                console.log("Thao tác chỉnh sửa bảng thành công");

                // Tiến hành cập nhật lại bảng
                taoBang();
            }
        );

        // hoặc taoBang();
    }
</script>