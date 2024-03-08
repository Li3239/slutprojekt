//----------------------
// 老师使用的演示代码，可以删除
//----------------------

// const { json } = require("express/lib/response");
// const parse = require("nodemon/lib/cli/parse");

//alert("Ajax.js is OK");
//alert("Ajax.js is OK! variable : " + ajax_variables.nonce + " ajax_url : " + ajax_variables.ajaxUrl);

function mytheme_getbyajax(searchwords) {
    //jquery.
    // let result = $.ajax({
    $.ajax({
        url: ajax_variables.ajaxUrl,
        data : {
            action: 'mytheme_getbyajax',
            nonce: ajax_variables.nonce,
            search: searchwords // send parameter
        },
        type: "POST",
        dataType: "json",
        success: function(result) {
            let data = JSON.parse(result);
            // alert("Result: " + data.stad);
        },
        error: function(xhr, status, error) {

        }
    });
}





// jQuery(document).ready(function($) {
//     $('#product_size').change(function() {
//         var selectedSize = $(this).val();

//         // Send AJAX request to get product details
//         $.ajax({
//             url: ajax_object.ajax_url,
//             type: 'POST',
//             data: {
//                 action: 'get_product_details',
//                 size: selectedSize
//             },
//             success: function(response) {
//                 // Update price and stock status elements on the frontend
//                 $('#product_price').text(response.data.price);
//                 $('#stock_status').text(response.data.stock_status);
//             },
//             error: function(xhr, status, error) {
//                 console.error('Error:', error);
//             }
//         });
//     });
// });





