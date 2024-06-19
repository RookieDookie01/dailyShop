$(document).ready(function()
{
    $('.addToCartBtn').click(function (e)
    {
        e.preventDefault();
        
        var product_id = $(this).val();
        var product_size = $("select").val();
        //alert(product_size);
        
        $.post("handlecart.php", {
            suggestion: product_id
        }, function(data, status){
            $("#test").html(data);
        });
        // $.ajax({
        //     method: "post",
        //     url: "handlecart.php",
        //     data: {
        //         "product_id": product_id,
        //         "scope": "add"
        //     },
        //     success: function(response)
        //     {
        //         if(response == 201)
        //         {
        //         alert("Product added to cart");
        //         }
        //         else if(response == 401)
        //         {
        //         alert("Login to continue");
        //         }
        //         else if(response == 500)
        //         {
        //         alert("Something went wrong");
        //         }
        //     }
        // });
    });
});