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

// call the function
// mytheme_getbyajax("kalle anka");