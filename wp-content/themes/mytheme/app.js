// document.addEventListener("DOMContentLoaded", function() {
//     console.log('App.js loaded successfully');

//     document.querySelectorAll('.custom-select__trigger').forEach(function(trigger) {
//         trigger.addEventListener('click', function() {
//             var options = ['Small', 'Medium', 'Large']; // Array of sizes

//             // Generate select options dynamically
//             var optionsHTML = '';
//             options.forEach(function(option) {
//                 optionsHTML += '<option value="' + option.toLowerCase() + '">' + option + '</option>';
//             });

//             // Update select options
//             var select = this.closest('.custom-select').querySelector('select');
//             select.innerHTML = optionsHTML;

//             // Toggle open class
//             this.closest('.custom-select').classList.toggle('open');
//         });
//     });

//     document.querySelectorAll('.custom-option').forEach(function(option) {
//         option.addEventListener('click', function() {
//             var value = this.getAttribute('data-value');
//             var select = this.closest('.custom-select').querySelector('.custom-select__trigger span');
//             select.textContent = value;
//             this.closest('.custom-select').classList.remove('open');
//         });
//     });
// });


jQuery(document).ready(function($) {
    $('.woocommerce-Tabs-panel.woocommerce-Tabs-panel--additional_information .product-image').remove();
});

//to take the .summery to the top of the page
document.addEventListener("DOMContentLoaded", function() {
    var summary = document.querySelector('.summary.entry-summary');
    var mainContent = document.querySelector('.product');

    if (summary && mainContent) {
        mainContent.parentNode.insertBefore(summary, mainContent);
    }
});

//to move the 
document.addEventListener("DOMContentLoaded", function() {
    var description = document.querySelector('.woocommerce-product-details__short-description');
    var actionHook = document.querySelector('.woocommerce-before-single-product-summary');

    if (description && actionHook) {
        // Hide the description element
        description.style.display = 'none';
    }
});






jQuery(document).ready(function($) {
    // Define your action name
    var actionName = 'your_action_name';

    // Make AJAX POST request
    $.ajax({
        url: ajax_object.ajax_url, // Use the AJAX URL localized in your functions.php
        type: 'POST',
        data: {
            action: actionName, // specify the action name to be handled in your backend
            // add any additional data you want to send with the request
        },
        success: function(response) {
            // handle the successful response from the server
            console.log('AJAX request successful');
            console.log('Response:', response);
        },
        error: function(xhr, status, error) {
            // handle errors
            console.error('AJAX request failed');
            console.error('Status:', status);
            console.error('Error:', error);
        }
    });
});



