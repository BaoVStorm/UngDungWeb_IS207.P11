<?php
    echo "<h1><i>Truy Cập thành công file index.php</i></h1>"; 
    if (isset($_POST['name'])){ 
        echo "<h3>Đăng nhập thành công với GET</h3>"; 
        $username = $_POST['name']; 
        $pass = $_POST['pass']; 
        
        $str =""; 
        $str .= '<table border="1" cellspacing="0" cellpadding = "10">'; 
        $str .= '<tr><th>Username</th><th>Password</th></tr>'; 
        $str .= '<tr><td>'. $username . '</td><td>' . $pass . '</td></tr></table>'; 
        echo $str; 

    }
?>