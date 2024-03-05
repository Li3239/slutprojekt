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
