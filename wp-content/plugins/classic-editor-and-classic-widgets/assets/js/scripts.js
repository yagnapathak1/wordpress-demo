"use strict";

(function($){
    $(document).ready(function () {
        let activeIndex = $('.active-tab').index(),
            $contentList = $('.tabs-content section'),
            $tabsList = $('.tabs-list li');

        if ( location.hash.length > 0 ) {
            let currentIndex = $(`.tabs-list li[data-id="${location.hash.substr(1)}"]`).index();
            activeIndex = currentIndex > -1 ? currentIndex : activeIndex;

            $tabsList.removeClass('active-tab');
            $tabsList.eq(activeIndex).addClass('active-tab');
        }

        $contentList.eq(activeIndex).show();

        $('.tabs-list').on('click', 'li', function (e) {
            e.preventDefault();

            let $current = $(e.currentTarget),
                index = $current.index(),
                id = $current.data('id');

            $tabsList.removeClass('active-tab');
            $current.addClass('active-tab');
            $contentList.hide().eq(index).show();
            location.hash = id;
        });

        $("input[type='radio']:checked").parent().addClass('selected');
        $("input[type='radio']").on('change', function (e) {
            $(this).parents().siblings().removeClass('selected');
            $(this).parent().addClass('selected');
        });
    });
})(jQuery);