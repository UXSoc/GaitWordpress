import $ from 'jquery'

(function() {
    $('.button-image-upload').each(function (index) {
        let root = $(this);
        $(this).find('.upload-image').click(function () {
            tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');
            window.send_to_editor = function(html) {
                let  imgurl = jQuery(html).attr('src');
                root.find('.preview').attr('src',imgurl);
                root.find('.payload').val(imgurl);

                tb_remove();
            }
        });
    });

    $("#gait_research_posts").each(function (index) {

        let root = $(this);

        function bind_remove(target,row) {
            let r = row;
            target.click(function (event) {
                let button = $(this);
                event.preventDefault();
                let target_post = $(this).attr('post_id');
                $.post(ajaxurl,{
                    'action': 'gait_query_remove_post',
                    'research_post_id': root.attr('data-post_id'),
                    'post_id': target_post,
                    'nonce':  root.attr('data-nonce')
                },function (response) {
                    r.remove();
                });
            });
        }
        $(this).find(".linked-post tr").each(function () {
           bind_remove($(this).find("button"),$(this));
        });

        function search_post(root,search) {
            $.post(ajaxurl,{
                'action': 'gait_query_search_post',
                'research_post_id': root.attr('data-post_id'),
                'nonce':  root.attr('data-nonce'),
                's': search
            },function (response) {
                let search_container = root.find(".post-search-container");
                search_container.empty();
                for(let i = 0; i < response.data.length; i++){
                    // response.data[i];
                    let add_row = $("<tr/>");
                    let title = response.data[i].title;
                    let button = $("<button post_id='"+response.data[i].id+"' class='button'>Add</button>");
                    button.click(function (event) {

                        event.preventDefault();
                        let target_post = $(this).attr('post_id');

                        $.post(ajaxurl,{
                            'action': 'gait_query_add_post',
                            'research_post_id': root.attr('data-post_id'),
                            'post_id': target_post,
                            'nonce':  root.attr('data-nonce')
                        },function (response) {
                            let row = $("<tr/>");
                            let button = $("<button post_id='"+target_post+"' class='button'>remove</button>");
                            bind_remove(button,row);
                            row.append(button);
                            row.append('<td>' +title+'</td>');
                            add_row.remove();

                            root.find(".linked-post").append(row);
                        });
                    });

                    add_row.append(button);
                    add_row.append('<td>' + response.data[i].title+'</td>')
                    search_container.append(add_row);


                }
            });
        }
        search_post(root,'');

        $(this).find('#gait_post_search').on("input",function () {
            search_post(root,$(this).val());
        });

    });
})();