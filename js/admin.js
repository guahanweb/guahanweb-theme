'use strict';

jQuery(document).ready(function ($) {
    var frame;
    var $image_id = $('#term_meta\\[image\\]');
    var $image_wrapper = $('#category-image-wrapper');

    $('.button.gw-tax-media-button').click(function (e) {
        e.preventDefault();
        if (!!frame) return frame.open();

        frame = wp.media({
            title: 'Select or Upload your Category Image',
            button: {
                text: 'Use this image'
            },
            multiple: false
        });

        frame.on('select', function () {
            var attachment = frame.state().get('selection').first().toJSON();
            $image_id.val(attachment.id);
            $image_wrapper.html('<img src="' + attachment.sizes.thumbnail.url + '" class="custom_media_image" style="display:block;height:100px;width:100px;" />');
        });

        frame.open();
    });

    $('.button.gw-tax-media-remove').click(function (e) {
        e.preventDefault();
        $image_id.val('');
        $image_wrapper.html('');
    });
});
