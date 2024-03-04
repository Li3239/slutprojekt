//---------------------------------------------------
// FILTER & SORT 按下处理
//---------------------------------------------------
//jQuery(document).ready(function($) 的意思是 DOM完全加载后再执行脚本
jQuery(document).ready(function($) {
    $('.sort-button').click(function(e) {
        e.preventDefault();
        console.log('Sort button clicked'); // 确认点击事件
        //.slideToggle('fast') 是一个 jQuery 方法，用于切换元素的可见性。如果元素是可见的，这个方法会使其以滑动动画的形式隐藏；如果元素是隐藏的，这个方法会使其以滑动动画的形式变为可见。
        $('.sorting-options').slideToggle('fast');
    });

    // 处理排序选项点击事件
    $('.sorting-options a').on('click', function(e) {
        e.preventDefault();
        var orderbyText = $(this).text(); // 获取点击的排序选项的文本内容
        console.log('order by selected Text:', orderbyText);

        $('#selected-sort').text(orderbyText); // 将所选内容显示在sort-button右边
        $('.sorting-options').hide(); // 选项点击后隐藏

        var orderby = $(this).data('orderby');
        console.log('Sort by:', orderby);

        var currentUrl = window.location.href;
        var newUrl = updateURLParameter(currentUrl, 'orderby', orderby);
        window.location.href = newUrl;
    });

    // 点击页面其他位置隐藏.sorting-options
    $(document).on('click', function(e) {
        if (!$(e.target).closest('.custom-products-list').length) {
            $('.sorting-options').hide();
        }
    });

    function updateURLParameter(url, param, paramVal) {
        var newAdditionalURL = "";
        var tempArray = url.split("?");
        var baseURL = tempArray[0];
        var additionalURL = tempArray[1];
        var temp = "";
        if (additionalURL) {
            tempArray = additionalURL.split("&");
            for (var i = 0; i < tempArray.length; i++) {
                if (tempArray[i].split('=')[0] != param) {
                    newAdditionalURL += temp + tempArray[i];
                    temp = "&";
                }
            }
        }

        var rows_txt = temp + "" + param + "=" + paramVal;
        return baseURL + "?" + newAdditionalURL + rows_txt;
    }
});

//---------------------------------------------------
// Sidebar 按下处理
//---------------------------------------------------
document.addEventListener('DOMContentLoaded', function() {
    // 监听点击事件
    document.querySelectorAll('.wpfFilterTaxNameWrapper').forEach(function(item) {
        item.addEventListener('click', function() {
            // 移除所有li的高亮样式
            document.querySelectorAll('.wpfFilterVerScroll li').forEach(function(li) {
                li.style.color = 'black'; // 重置文字颜色
            });
            
            // 设置当前点击的文字的颜色为红色
            this.style.color = 'red';
            
            // 显示选中的过滤器文本
            //document.getElementById('selected-filter').textContent = 'Selected Filter: ' + this.textContent;
        });
    });
});
