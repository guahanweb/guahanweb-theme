(function ($) {
    'use strict';

    const $contact_overlay = $('div.contact-overlay');
    const $close_link = $('.contact-overlay a.close-link');
    const $success_container = $contact_overlay.find('.w-form-done');
    const $failure_container = $contact_overlay.find('.w-form-fail');

    // Contact form event listeners
    $close_link.on('click', hideContactForm);
    $(document).on('click', 'a.nav-link.contact', showContactForm);

    const $contact_form = $('form#email-form');
    $contact_form.on('click', 'input[type=submit]', submitContactForm);
    function submitContactForm(e) {
        e.preventDefault();
        e.stopPropagation();

        let data = { action: 'gw_send_message' };
        $contact_form.serializeArray().forEach(function (field) {
            if (field.name == 'name' || field.name == 'email') {
                data[field.name] = field.value;
            } else if (field.name == 'project-details') {
                data.message = field.value;
            }
        });

        $.post(GW_AJAXURL, data, function (response) {
            if (!!response.success) {
                $contact_form.hide();
                $success_container.show();
            } else {
                $contact_form.hide();
                $failure_container.show();
            }
            console.log(response);
        });
    }

    function showContactForm(e) {
        e.preventDefault();
        e.stopPropagation();
        $contact_overlay.css('display', 'block');
        setTimeout(function () {
            $contact_overlay.css({
                'opacity': '1',
                'transform': 'scaleX(1) scaleY(1) scaleZ(1)'
            });
        }, 100);
    }

    function hideContactForm(e) {
        e.preventDefault();
        e.stopPropagation();
        $contact_overlay.css({
            'opacity': '0',
            'transform': null
        });
        setTimeout(function () {
            // reset form visibility
            $contact_overlay.css('display', 'none');
            $contact_form.show();
            $success_container.hide();
            $failure_container.hide();
        }, 600);
    }
})(jQuery);
