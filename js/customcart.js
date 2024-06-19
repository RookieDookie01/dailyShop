$(document).ready(function()
{
    $(document).on('click',' .deleteCart', function(){
        var cart_id = $(this).val();
    
        $.ajax({
            method: "POST",
            url: "cart.php",
            data: {
                "cart_id": cart_id,
                "scope": "delete"
            },
            success: function (response){
        
            }
        })
    });
});
