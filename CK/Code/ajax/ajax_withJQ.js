function CallAjax() {
    var url = "index.php"; 
    
    // $.get(url + "?name=" + $("input[type='text']").val() + "&pass=" + $("input[type='pass']").val(), function(data,status){ 
    //     $('#Box_id').html(data); 
    //     console.log(data);  
    // });

    $.post(url, { 
            name: $("input[type='text']").val(), 
            pass: $("input[type='pass']").val()
        }, function(data,status){            
            $('#Box_id').html(data); 
            console.log(data);
        }
    );

    console.log("Click Successfully");
}