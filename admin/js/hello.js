
function Hello(){
    $(document).ready(function(){
        $(document).on("click",'input#test',function(){
        var userName = $("input#username_txt").val();
        var passWord = $("input#password_txt").val();
        // console.log(userName + " " + passWord);   
        ///var url = "include/verifyAdmin.php";
        $.ajax({
            url:"include/verifyAdmin.php", 
            data: {user: userName,pwd:passWord}, 
            cache: false,
            method: "POST", 
            success:function(result){
                console.log(result);
                if(result == "Login Successfull"){
                    window.location = "main.php";
                }else{
                    $("div#errorModal").modal();
                    $("div#errorModal p#errorText").html(result);  
                }
                
                
        
            },
            error: function(xhr){
                alert("An error occured: " + xhr.status + " " + xhr.statusText);
            }
    
            });
         });

         

    });

}

Hello();