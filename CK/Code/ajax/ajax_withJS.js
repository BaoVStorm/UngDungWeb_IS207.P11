function CallAjax() {
    var url = "index.php"; 
    var param = "name=" + $("input[type='text']").val() + "&pass=" + $("input[type='pass']").val(); 
    
    var xmlHttp = new XMLHttpRequest();
        // ---- With POST ----
        xmlHttp.open("POST", url, true); 
        xmlHttp.send(param);
        
        // ---- With GET ----
        // xmlHttp.open("GET", url + "?" + param, true); 
        // xmlHttp.send(null);
    
    xmlHttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded"); 
    
    //Đón dữ liệu từ server trả về 
    xmlHttp.onreadystatechange = function() { 
        if (xmlHttp.readyState == 4 && xmlHttp.status == 200) { 
            $("#Box_id").html("<p>" + xmlHttp.responseText + "</p>"); 
        } 
    } 

    // console.log("Click Successfully");
}