function UPKPR_copykey() {
    var copyText = document.getElementById("upkepr_maintainance_validationkey");
    copyText.select();
    copyText.setSelectionRange(0, 99999); /* For mobile devices */
    navigator.clipboard.writeText(copyText.value);
    alert('Key Copied');
}

function UPKPR_check_connection(type, eventhis) {
    jQuery(eventhis).attr('disabled', true);
    jQuery('#upkepr-loader').show();
    jQuery('#upkepr-loader-2').show();
    
    jQuery('.registerButton').addClass('disabled');
    var xhr = new XMLHttpRequest();
    xhr.open('POST', upkpr_ajax_object.upkpr_ajax_url, true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=UTF-8');
    xhr.onreadystatechange = function () {

        if (xhr.readyState === 4 && xhr.status === 200) {
            jQuery('#upkepr-loader').hide();
            respose = JSON.parse(xhr.responseText);

            if (respose.status == 1 && respose.type == 'get_details') {
                jQuery('.vulnerability_section').html(respose.html);
                triggerUPkprAccordian();
                jQuery(eventhis).show();

                jQuery('.upkpr-success').html('Data retrieval successful. <i class="fa fa-check" aria-hidden="true"></i>');
                jQuery('.upkpr-success').show();

                jQuery('#upkpr-Modal').find('.step1').addClass('completed');
                jQuery('#upkpr-Modal').find('.step2').addClass('completed');
                jQuery('#upkpr-Modal').find('.step3').addClass('completed');

                setTimeout(function () {
                    window.location.reload();
                    jQuery('.upkpr-success').html('');
                    jQuery('.upkpr-success').hide();
                }, 1000);

            } else {
                jQuery('.registerButton').removeClass('disabled');
                setTimeout(function () {
                    jQuery('.upkpr-errors').text('');
                    jQuery('.upkpr-errors').hide();
                }, 5000);
                jQuery('.upkpr-errors').show();
                jQuery('.upkpr-errors').html(respose.message + '<i class="fa fa-times" aria-hidden="true"></i>');
                jQuery(eventhis).show();
            }
        } else {
            jQuery('.registerButton').removeClass('disabled');
            jQuery('#upkepr-loader').hide();
            jQuery(eventhis).show();
        }
        jQuery('#upkepr-loader-2').hide();
    };
    xhr.send('action=upkpr_ajax_action&scan_type=' + type);
}

function UPKPR_check_user(type, eventhis) {

    jQuery(eventhis).attr('disabled', true);
    jQuery('#upkepr-loader').show();
    //jQuery('#upkepr-loader-2').show();
    var xhr = new XMLHttpRequest();
    xhr.open('POST', upkpr_ajax_object.upkpr_ajax_url, true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=UTF-8');
    xhr.onreadystatechange = function () {

        if (xhr.readyState === 4 && xhr.status === 200) {
            jQuery('#upkepr-loader').hide();
            respose = JSON.parse(xhr.responseText);

            if (respose.status == 1 && respose.type == 'get_details') {
                var text = "Project Configured, Kindly scan now for fetch details";
                jQuery('#upkpr-Modal').find('.step1').addClass('completed');
                jQuery('#upkpr-Modal').find('.step2').addClass('completed');
                jQuery('#upkpr-Modal').find('.step3').addClass('active');
                jQuery(eventhis).hide();
                UPKPR_OpneModal(text);
                //'<a href="https://app.upkepr.com/register" class="usButton primary-btn registerButton" target="_blank"> Click Here </a>'
                jQuery('#upkpr-Modal .addButton').html(`<a href="javascript:void(0);" onclick="UPKPR_check_connection('all',this)" class="primary-btn scan-now registerButton"> Scan Now </a>`);
                /*setTimeout(function(){
                    //window.location.reload();
                },3000); */
                triggerUPkprAccordian();
                jQuery(eventhis).show();

                //jQuery('.upkpr-success').html('Data retrieval successful. <i class="dashicons dashicons-yes"></i>');                
                //jQuery('.upkpr-success').show();
                /* setTimeout(function () {
                    jQuery('.upkpr-success').html('');
                    jQuery('.upkpr-success').hide();
                }, 2000); */

            } else {
                if (respose.message == 'Website is not added.') {
                    jQuery('#upkpr-Modal').find('.step1').addClass('active');
                    UPKPR_OpneModal('We detected that this website is not added on upkepr, Please create your account OR login to your account and add your  website to configure your key.');
                } else if (respose.message == 'No connecton found.') {
                    jQuery('#upkpr-Modal').find('.step2').addClass('active');
                    jQuery('#upkpr-Modal').find('.step2-key').show();
                    UPKPR_OpneModal('Nice! Website is already added on upkepr, please configure you key on upkepr, Click on link to login to upkepr');
                } else if (respose.type == 'key_invalid') {
                    jQuery('#upkpr-Modal').find('.step1').addClass('completed');
                    jQuery('#upkpr-Modal').find('.step2').addClass('active');
                    jQuery('#upkpr-Modal').find('.step2-key').show();
                    UPKPR_OpneModal('Nice! Website is already added on upkepr, please configure you key on upkepr, Click on link to login to upkepr.');
                } else if (respose.message) {
                    jQuery('#upkpr-Modal').find('.step1').addClass('active');
                    UPKPR_OpneModal(respose.message);
                } else {
                    UPKPR_OpneModal('Something went wrong.');
                }
                jQuery(eventhis).show();
                jQuery('#upkepr-loader').hide();
            }
        } else {
            jQuery(eventhis).show();
            jQuery('#upkepr-loader').hide();
        }
        // jQuery('#upkepr-loader').hide();
    };
    // xhr.send('action=upkpr_ajax_action&scan_type=' + type);
    xhr.send('action=upkpr_check_ajax_action&scan_type=' + type);
}

//upkprLoadListToCheckConnected
if (jQuery('.upkprLoadListToCheckConnected')) {
    //alert();
    UPKPR_check_ConnectedWithUpkpr('check');
}
function UPKPR_check_ConnectedWithUpkpr(type = 'check') {
    var xhr = new XMLHttpRequest();
    xhr.open('POST', upkpr_ajax_object.upkpr_ajax_url, true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=UTF-8');
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            jQuery('#upkepr-loader').hide();
            respose = JSON.parse(xhr.responseText);

            if (respose.status == 1 && respose.type == 'get_details') {
                var text = "Project Configured, Kindly scan now for fetch details";
                jQuery('.upkprLoadListToCheckConnected').show();
                jQuery('.upkprLoadListToCheckConnected').html(`<div class="list siteAdded"><span class="connect-list-icon"></span><p>Site is added on upkepr</p></div>
                <div class="list keyConnectedOrConnected"><span class="connect-list-icon"></span><p>Key configured properly</p></div>
                <div class="list scanPendingOrScanned"><span class="connect-list-icon"></span><p>Scanning pending</p></div>`);
                jQuery('.upkprConnect').hide();
                
            } else {
                if (respose.message == 'Website is not added.') {
                    jQuery('.upkprLoadListToCheckConnected').show();
                    jQuery('.upkprLoadListToCheckConnected').html(`<div class="list siteAdded"><span class="connect-list-icon"></span><p>Site is not added</p></div>`);

                } else if (respose.message == 'No connecton found.') {
                    jQuery('.upkprLoadListToCheckConnected').show();
                    jQuery('.upkprLoadListToCheckConnected').html(`<div class="list siteAdded"><span class="connect-list-icon"></span><p>Site is added on upkepr</p></div>
                    <div class="list keyConnectedOrConnected"><span class="connect-list-icon"></span><p>Key configured properly</p></div>`);
                } else if (respose.type == 'key_invalid') {
                    jQuery('.upkprLoadListToCheckConnected').show();
                    jQuery('.upkprLoadListToCheckConnected').html(`<div class="list siteAdded"><span class="connect-list-icon"></span><p>Site is added on upkepr</p></div>
                    <div class="list keyConnectedOrConnected"><span class="connect-list-icon"></span><p>Key mismatch issue</p></div>`);
                } else if (respose.message) {
                    jQuery('.upkprLoadListToCheckConnected').show();
                    jQuery('.upkprLoadListToCheckConnected').find('.list').hide();
                } else {
                    jQuery('.upkprLoadListToCheckConnected').show();
                    jQuery('.upkprLoadListToCheckConnected').find('.list').hide();
                }
            }
        } else {

        }
    };
    xhr.send('action=upkpr_check_ajax_action&scan_type=' + type);
}

function triggerUPkprAccordian() {
    var accToggles = document.querySelectorAll('.upkpr-accordion-toggle');
    accToggles.forEach(function (toggle) {
        toggle.addEventListener('click', function () {
            this.classList.toggle('active');
            var content = this.closest('tr').nextElementSibling;
            if (content.style.display === "none") {
                content.style.display = "";
            } else {
                content.style.display = "none";
            }
        });
    });
}

function UPKPR_OpneModal(text) {
    jQuery('#upkpr-Modal .model-body').html(text);
    var modal = jQuery('#upkpr-Modal');
    modal.show();
}
jQuery(document).ready(function ($) {
    new DataTable('.upkepr-vulnerable-datatable');

    var modal = $('#upkpr-Modal');
    var span = $(".upkpr-close");
    $('.upkpr-ModalVieDetails').click(function () {
        modal.show();
    });
    span.click(function () {
        modal.hide();
    });

    $(window).click(function (event) {
        if (event.target == modal) {
            modal.hide();
        }
    });
});
jQuery('#upkepr-loader').hide();
jQuery('#upkepr-loader-2').hide();