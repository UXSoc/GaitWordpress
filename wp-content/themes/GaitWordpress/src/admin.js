import $ from 'jquery'
console.log("found button");
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
})();