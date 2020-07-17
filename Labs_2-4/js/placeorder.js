$(document).ready(function() {
    $('#btn-place-order').click(function (event){
        event.preventDefault();
        var name_of_food = $('#name_of_food').val();
        var number_of_units = $('#number_of_units').val();
        var unit_price = $('#unit_price').val();
        var order_status = $('#order_status').val();
        
        $.ajax({
            url: "http://localhost/IAP-Labs/Labs_2-4/api/v1/orders/index.php",
            type: "post",
            data: {name_of_food:name_of_food,number_of_units:number_of_units,unit_price:unit_price,order_status:order_status},
            headers:{
                'Authorization':'Basic FGDeY6WA07JGhLMUTnyXPMLKyrQpj18PQbswzCee1tspAq84jwvNY02YPazI0aLI'
            },
            success:function(data){
                alert(data['message']);
            },
            error:function(){
                alert(data['message']);
                
            }
        });
    });

    $('#btn-get-order').click(function (event){
        event.preventDefault();
        var order_id = $('#order_id').val();
        $.ajax({
            url: "http://localhost/IAP-Labs/Labs_2-4/api/v1/orders/index.php",
            type: "get",
            data: {order_id:order_id},
            success:function(data){
                alert(data['message']);
            },
            error:function(){
                alert(data['message']);
                
            }
        });
    });
   
})