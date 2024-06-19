$(document).ready(function()
{
  $('.delete_product_button').click(function (e)
  {
    e.preventDefault();
    var product_id = $(this).val();
    swal({
      title: "Are you sure?",
      text: "Once deleted, you will not be able to recover this product!",
      icon: "warning",
      buttons: true,
      dangerMode: true,
    })
    .then((willDelete) => {
      if (willDelete) {
        $.ajax({
          method: "POST",
          url: "products.php",
          data: {
            'product_id':product_id,
            'delete_product_button' : true
          },
          success: function(response)
          {
            if(response == 200)
            {
              swal("Success!","Product deleted Succesfully","success");
              $("#products_table").load(location.href + " #products_table");
            }
            else if(response == 500)
            {
              swal("Error!","Something went wrong","error");
            }
          }
        });
      } else {
        swal("Product is safe!");
      }
    });
  });
  
});

