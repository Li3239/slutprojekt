//-----------------------------------------------------------
// 无 【Show more products】button 的lazyload
//-----------------------------------------------------------
jQuery(function($) {
    var page = 2; // 从第二页开始加载
    var loading = false; // 用来防止重复加载
    var max_pages = 5; // 假设最多有5页内容，你可能需要根据实际情况调整

    $(window).scroll(function() {
        // 检查用户是否滚动到页面底部
        if ($(window).scrollTop() + $(window).height() > $(document).height() - 100 && !loading && page <= max_pages) {
            loading = true; // 防止在加载过程中重复请求

            var data = {
                //指定了AJAX请求的action参数为my_load_more_products。
                //在ajax.php中需要 使用wp_ajax_（登录用户）和wp_ajax_nopriv_（未登录用户）钩子来挂载这个函数
                'action': 'my_load_more_products', 
                'page': page,
                'nonce': ajax_params.nonce // 从 ajax.php 传递的（数字签名）的安全令牌
            };

            //ajax_params.ajax_url： ajax.php 中传递到 js 的参数，从而js 可以发送 AJAX 请求到 WordPress 后端
            $.post(ajax_params.ajax_url, data, function(response) {
                if (response && response != 'No more products to load.') {
                    $('div.custom-products-list > ul.products.columns-4').append(response);
                    page++;
                    loading = false; // 加载完成后允许再次加载
                } else {
                    // 可选：如果没有更多产品加载，可以移除滚动监听或显示消息
                    $(window).off('scroll');
                    // 或者显示一条消息
                    // $('div.custom-products-list').append('<p>No more products to load.</p>');
                }
            });
        }
    });
});

//-----------------------------------------------------------
// 使用 【Show more products】button
// 1. 需要将以下代码添加到 archive-product.php
// <!-- Add "Load More Products" button -->
// <button id="load_more_products">Load More Products</button>
//-----------------------------------------------------------
// jQuery(function($) {
//     var page = 2; // 从第二页开始加载
//     $('body').on('click', '#load_more_products', function(e) {
//         e.preventDefault();
//         var button = $(this);
//         var data = {
//             'action': 'my_load_more_products',
//             'page': page,
//             'nonce': ajax_params.nonce // 确保你已经正确定义并传递了 nonce
//         };
//         $.post(ajax_params.ajax_url, data, function(response) {
//             if (response && response != 'No more products to load.') {
//                 // 这里指定了要插入内容的具体位置
//                 $('div.custom-products-list > ul.products.columns-4').append(response);
//                 page++;
//             } else {
//                 button.text('No more products').prop('disabled', true);
//             }
//         });
//     });
// });





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


