$(document).ready(function(){
    
    $("#api-key-btn").click(function(event){
        var confirm_key = confirm("Confirm API Key generation!");
        if(!confirm_key){
            return;
        }

        $.ajax({
            url: "apikey.php",
            type: 'post',
            success: function(data){
                if (data['success'] === 1) {                    
                    $("#api-key").val(data['message']);
                }else{
                    alert("Something wrong happened. Please try again.");
                }
            }
        });
        document.location.reload(true);
    });
});