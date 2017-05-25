(function ($) {
    'use strict';

    const $contact_overlay = document.querySelector('div.contact-overlay');
    const $contact_link = document.querySelectorAll('a.nav-link.contact');
    const $close_link = document.querySelector('.contact-overlay a.close-link');

    // Contact form event listeners
    $close_link.addEventListener('click', hideContactForm);
    $contact_link.forEach(function (el, i) {
        el.addEventListener('click', showContactForm);
    });

    const $contact_form = $('form#email-form');
    $contact_form.on('click', 'input[type=submit]', submitContactForm);
    function submitContactForm(e) {
        e.preventDefault();
        e.stopPropagation();
        console.log($contact_form.val());
    }

    function showContactForm(e) {
        e.preventDefault();
        e.stopPropagation();
        $contact_overlay.style.display = 'block';
        setTimeout(function () {
            $contact_overlay.style.opacity = '1';
            $contact_overlay.style.transform = 'scaleX(1) scaleY(1) scaleZ(1)';
        }, 100);
    }

    function hideContactForm(e) {
        e.preventDefault();
        e.stopPropagation();
        $contact_overlay.style.opacity = '0';
        $contact_overlay.style.transform = null;
        setTimeout(function () {
            $contact_overlay.style.display = 'none';
        }, 600);
    }
})(jQuery);
