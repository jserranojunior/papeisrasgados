//validate email function
function validateEmail($email) {
    var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
    if (!emailReg.test($email)) {
        return 0;
    } else {
        return 1;
    }
}

//clear the error
function removeMe(arg) {
    jQuery('.' + arg).html('');
}


jQuery(document).ready(function($) {

    $('.apss-social-share-sidebar.apss-theme-2 .apss-single-icon').hover(function() {
        var html = $(this).find('.apss-social-text').html();
        $('.apss-temp').html(html);
        var width = $('.apss-temp').width();
        $('.apss-temp').html('');
        console.log(width);
        $(this).find('.apss-icon-block').outerWidth(width + 60);
        var margin = width / 1.9;
        if ($(this).closest('.apss-social-share-sidebar').hasClass('apss-sidebar-bottom_right') || $(this).closest('.apss-social-share-sidebar').hasClass('apss-sidebar-bottom_left')) {
            $(this).find('.apss-icon-block').css({
                'margin-left': '-' + margin + 'px',
                'margin-right': '-' + margin + 'px'
            });
        }

    }, function() {
         $(this).find('.apss-icon-block').outerWidth(40);
        if ($(this).closest('.apss-social-share-sidebar').hasClass('apss-sidebar-bottom_right') || $(this).closest('.apss-social-share-sidebar').hasClass('apss-sidebar-bottom_left')) {

            $(this).find('.apss-icon-block').css({
                'margin-left': '',
                'margin-right': ''
            });
        }
    });

    $('.apss-social-share-sidebar.apss-theme-1 .apss-single-icon').hover(function() {
        var html = $(this).find('.apss-share').html();
        $('.apss-temp').html(html);
        var width = $('.apss-temp').width();
        $('.apss-temp').html('');
        console.log(width);
        $(this).find('.apss-icon-block').outerWidth(width + 80);

    }, function() {
         $(this).find('.apss-icon-block').outerWidth(40);
    });

        $('.apss-social-share-sidebar.apss-theme-4 .apss-single-icon').hover(function() {
        var html = $(this).find('.apss-share').html();
        $('.apss-temp').html(html);
        var width = $('.apss-temp').width();
        $('.apss-temp').html('');
        console.log(width);
        $(this).find('.apss-share').outerWidth(width + 60);

    }, function() {
         $(this).find('.apss-share').outerWidth(width);
    });

    $('#apss_close_popup').click(function() {
        $('.apss-popup-overlay').hide();
        $('.apss-social-share-popup').hide();
        var current_page_url = $('#apss-current-url').val();
        $.ajax({
            type: 'post',
            url: frontend_ajax_object.ajax_url,
            data: 'action=frontend_session&_wpnonce=' + frontend_ajax_object.ajax_nonce + '&current_page_url=' + current_page_url,
            success: function(res) {
                if (res == 'success') {
                    $('.apss-social-share-popup').hide();
                }
            }


        });
    });


    $('.share-email-popup').click(function() {
        $('.apss-popup-overlay').show();
        $('.apss_email_share_popup').show();
        $('.apss-social-share-popup').hide();
        $('#apss-popup-overlay-start').hide();
        return false;
    });

    $('#apss_email_popup_send_email').click(function() {
        var name = $('#apss_email_popup_name').val();
        var from_email = $('#apss_email_popup_from').val();
        var receiver_email = $('#apss_email_popup_receiver').val();
        var email_subject = $('#apss_email_popup_subject').val();
        var email_message = $('#apss_email_popup_message').val();

        var from_email_validate = validateEmail(from_email);
        var receiver_email_validate = validateEmail(receiver_email);

        if (name == '') {
            $('.apss_email_popup_name_error').html('This field is required');
            $('#apss_email_popup_name').focus();
            return false;
        }

        if (from_email == '') {
            $('.apss_email_popup_from_error').html('Please enter your email address.');
            $('#apss_email_popup_from').focus();
            return false;
        }

        if (from_email_validate == 0) {
            $('.apss_email_popup_from_error').html('Please enter your valid email address.');
            $('#apss_email_popup_from').focus();
            return false;

        }

        if (receiver_email == '') {
            $('.apss_email_popup_sendto_error').html('Please enter receivers email address.');
            $('#apss_email_popup_receiver').focus();
            return false;
        }

        if (receiver_email_validate == 0) {
            $('.apss_email_popup_sendto_error').html('Please enter receivers valid email address.');
            $('#apss_email_popup_receiver').focus();
            return false;
        }


        $('#apss_email_popup_send_email').prop('disabled', true);
        $('.apss_email_popup_loading').show();
        $.ajax({
            type: 'post',
            url: frontend_ajax_object.ajax_url,
            data: 'action=frontend_popup_email_send&_wpnonce=' + frontend_ajax_object.ajax_nonce + '&name=' + name + '&from_email=' + from_email + '&receiver_email=' + receiver_email + '&email_subject=' + email_subject + '&email_message=' + email_message,
            success: function(res) {
                if (res == 'success') {
                    $('.apss_email_popup_loading').hide();
                    $('.apss_email_popup_result').html('Email has been send successfully. Thankyou.');

                } else {
                    $('.apss_email_popup_loading').hide();
                    $('.apss_email_popup_result').html('Some error has occured.Please try again later. Thankyou.');
                }
            }


        });

    });

    $('.apss_email_share_popup_close').click(function() {
        $('.apss_email_share_popup').hide();
        $('.apss-popup-overlay').hide();
        return false;
    });

    $('.apss-popup-overlay').click(function() {
        $('.apss-popup-overlay').hide();
        $('.apss_email_share_popup').hide();
        $('.apss-social-share-popup').hide();

    });

    $('.apss-bp-social-button').click(function() {
        $(this).closest('.activity-meta').find('.apss-social-share-buddypress').slideToggle('fast');;
    });

    var shortcode_profile_array = [];
    $('.apss-count').each(function() {
        var social_detail = $(this).attr('data-social-detail');
        if ($.inArray(social_detail, shortcode_profile_array) == -1) {
            shortcode_profile_array.push(social_detail);
        }
    });
    if (shortcode_profile_array.length > 0) {
        $.ajax({
            type: 'post',
            url: frontend_ajax_object.ajax_url + '/?action=frontend_counter&_wpnonce=' + frontend_ajax_object.ajax_nonce,
            data: {
                shortcode_data: shortcode_profile_array
            },
            success: function(res) {
                res = $.parseJSON(res);
                for (var i = 0; i <= shortcode_profile_array.length; i++) {
                    var social_detail = shortcode_profile_array[i];
                    var count = (res[i]) ? res[i] : 0;
                    $('.apss-count[data-social-detail="' + social_detail + '"]').html(count);
                }
            }
        });
    }
    $(document).keydown(function(e) {
        // alert(e.keyCode);
        //     alert('testing');
        // Enable esc
        if (e.keyCode == 27) {
            $('.apss_email_share_popup').hide();
            $('.apss-popup-overlay').hide();
            $('.apss_email_share_popup').hide();
            $('.apss-social-share-popup').hide();
        }

    });

});
