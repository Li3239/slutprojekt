jQuery(function($) {
    var page = 2; // load from the 2nd page
    $('body').on('click', '#load_more_products', function(e) {
        e.preventDefault();
        var button = $(this);
        var data = {
            'action': 'my_load_more_products',
            'page': page,
            'nonce': ajax_params.nonce // send nonce !!!! 解决这个问题的？POST http://slutprojekt.test/wp-admin/admin-ajax.php 400 (Bad Request)
        };
        $.post(ajax_params.ajax_url, data, function(response) {
            if (response && response != 'No more products to load.') {
                button.before(response);
                page++;
            } else {
                button.text('No more products').prop('disabled', true);
            }
        });
    });
});

// jQuery(function($){
//     var page = 2; // 开始从第二页加载，因为第一页默认已加载
//     $('body').on('click', '#load_more_products', function(e){
//         e.preventDefault();
//         var button = $(this); // 获取按钮本身
//         var data = {
//             'action': 'my_load_more_products',
//             'page': page
//         };
//         $.post(ajax_params.ajax_url, data, function(response) {
//             if(response){
//                 button.before(response); // 在按钮前插入新加载的产品
//                 page++; // 增加页码
//             } else {
//                 button.remove(); // 如果没有更多产品加载，则移除按钮
//             }
//         });
//     });
// });



// jQuery(document).ready(function($) {
//     var canLoadMore = true; // 防止多次加载

//     $(window).scroll(function() {
//         if ($(window).scrollTop() == $(document).height() - $(window).height() && canLoadMore) {
//             canLoadMore = false;
//             $.ajax({
//                 url: '/wp-admin/admin-ajax.php',
//                 type: 'POST',
//                 data: {
//                     action: 'load_more_products',
//                     // 传递其他可能需要的参数，例如当前已加载的产品数量
//                 },
//                 success: function(response) {
//                     // 将返回的产品添加到页面上
//                     canLoadMore = true; // 重新允许加载更多
//                 }
//             });
//         }
//     });
// });


