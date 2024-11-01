<?php
if (isset($_POST['cwebco_updatekey'])) {
    if (wp_verify_nonce($_POST['cwebcoupkeper_key_cstm_field'], 'cwebcoupkeper_key_cstm')) {
        UPKPR_upkepr_regenerate_key();
    }
}

$_upkepr_maintainance_validationkey = get_option('upkeprvalidationkeycstm', true);
$upkepr_admin_page = admin_url("admin.php?page=vulnerability-detector#upkr-formsection");

$tabSection = isset($_GET['section']) ? $_GET['section'] : 'apikey';
$subsection = isset($_GET['sub-section']) ? $_GET['sub-section'] : 'all';
//delete_option('upkpr_vulnerability_all');
$isConnected = get_option('upkpr_vulnerability_all');
?>

<div id="upkepr-loader"></div>
<div class="wrap" id="community-profile-page">
    <!--  <h1 class="wp-heading-inline">Upkepr Maintenance</h1> -->

    <hr class="wp-header-end">
</div>
<div class="upkepr-div-tabmain-section">
    <header>
        <div class="container">
            <div class="row justify-content-between align-items-center">
                <div class="col-md-6">
                    <a target="_blank" href="https://upkepr.com/"><img src="<?php echo esc_html(UPKPR_UPKEPR_WS_PATH1); ?>images/logo.png" /></a>
                </div>
                <div class="col-md-4 text-end">
                    <a href="https://upkepr.com/" target="_blank"><i class="fa fa-external-link by-webgarh" aria-hidden="true"></i> https://upkepr.com/</a>
                </div>
            </div>
        </div>
    </header>
    <?php if (!empty($isConnected)) : ?>
        <!-- <div class="container">
        <div class="upkepr-nav-pluginInfo">
            <h2 id="profile-nav" class="nav-tab-wrapper main-upkepr-ulactiv">
                <a class="upkep-nav-main-section-tab nav-tab <? //= ($tabSection == 'apikey') ? 'nav-tab-active' : '' 
                                                                ?>" href="<? //= menu_page_url('upkepr-Maintenance', false) . '&section=apikey' 
                                                                                                                                ?>">Key Details</a>
                <a class="upkep-nav-main-section-tab nav-tab <? //= ($tabSection == 'vulnerabilities') ? 'nav-tab-active' : '' 
                                                                ?>" href="<? //= menu_page_url('upkepr-Maintenance', false) . '&section=vulnerabilities&sub-section=all' 
                                                                                                                                        ?>">Vulnerabilities</a>
            </h2>
        </div>
    </div> -->
    <?php endif; ?>
    <?php if (isset($isConnected) && !empty($isConnected)) :
        $subsection = 'all';
        $pluginVulnebility = get_option('upkpr_vulnerability_all');
    ?>

        <!--<a href="javascript:void(0)" class="usButton upkpr_scannow_refresh" onclick="UPKPR_check_connection('plugin',this)">Refresh Data </a> -->
        
        <div class="vulnerability_section">
            <?= UPKPRRenderVulnerabiliy(strtolower('all'), $pluginVulnebility) ?>
        </div>
    <?php endif; ?>
    <? //php if ($tabSection == 'apikey') : 
    ?>
    <section class="wordpress-pulgin-welcome" id="upkr-formsection">
        <div class="container">
            <div class="cstm-card pulgin-welcome-banner">
                <div class="pulgin-welcome-banner-text">
                    <h2 class="plugin-heading">Configure Key with <span class="highlight">Upkepr!</span></h2>
                    <p>
                    Upkepr is a suite of security-focused tools designed by WordPress experts to safeguard your WordPress site while enhancing performance and growth.
                        <br>
                    </p>

                    <form action="<?php echo esc_html($upkepr_admin_page); ?>" method="post">
                        <div class="">
                            <?php if ($tabSection == 'apikey') : ?>
                                
                                <div class="key-configration-input-copy">
                                    <div class="key-configration-input">

                                        <input type="text" id="upkepr_maintainance_validationkey" value="<?php if (isset($_upkepr_maintainance_validationkey)) {
                                                                                                                echo esc_html($_upkepr_maintainance_validationkey);
                                                                                                            } ?>" readonly>
                                        <i alt="upkepr" onclick="UPKPR_copykey()" class="fa-solid fa-copy"></i>
                                    </div>
                                </div>
                            <?php endif; ?>
                            <div class="health-report-banner-header">
                                <div class="health-report-header-right">
                                    <?php if (empty($isConnected)) : ?>
                                        <a href="javascript:void(0);" onclick="UPKPR_check_user('check',this)" class="primary-btn click-to-complete"> Click to complete setup </a>
                                    <?php else : ?>
                                       <!--  <a href="javascript:void(0);" onclick="UPKPR_check_connection('all',this)" class="primary-btn scan-now"> Scan Now </a> -->
                                    <?php endif; ?>
                                    <?php if ($tabSection == 'apikey') : ?>
                                        <a href="#popup1" class="primary-btn " class="usButton">Regenerate</a>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <div id="popup1" class="overlay">
                            <div class="popup signup-more-details-popup">
                                <a class="close" href="#upkr-formsection">&times;</a>
                                <div class="signUpPopupPage">
                                    <h2>IMPORTANT <span class="highlight">ALERT</span></h2>
                                    <p> Regenerating the key will render old key as invalid. If you have already used the old key in upkepr, you
                                        have to update new key in Upkepr.</p>
                                    <?php wp_nonce_field("cwebcoupkeper_key_cstm", "cwebcoupkeper_key_cstm_field"); ?>
                                    <input type="submit" name="cwebco_updatekey" class="usButton primary-btn" value="Yes, I am aware Update the Key">
                                </div>
                            </div>

                        </div>

                    </form>
                </div>

                <div class="pulgin-welcome-banner-text">
                    <h2 class="plugin-heading">How to Configure <span class="highlight">Upkepr</span></h2>
                    <ul class="how-configure-list">
                      <li><strong>Add Your Website:</strong> Log in to Upkepr and add your WordPress website.</li>
                      <li><strong>Configure Connection:</strong>
                        <ul class="how-configure-inner-list">
                          <li>Go to the WordPress CMS section in Upkepr.</li>
                          <li>Enter the key name and your WordPress admin username.</li>
                        </ul>
                      </li>
                      <li><strong>Connect:</strong> This will connect your Upkepr account with your WordPress site.</li>
                      <li><strong>Scan for Updates:</strong> Press the scan button in Upkepr inside the wordpress to fetch the latest information from your site.</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <? //php endif; 
    ?>

    <?php if ($tabSection == 'apikey') : 
        // Key details
        ?>
        
    <?php elseif ($tabSection == 'vulnerabilities') : ?>
        <!-- sub-section -->

        <!-- <h2 id="profile-nav" class="nav-tab-wrapper upkepr-subnav-section">
            <a class="nav-tab upkepr-sub-nav-tab <? //= ($subsection == 'core') ? 'nav-tab-active' : '' 
                                                    ?>" href="<//?= menu_page_url('upkepr-Maintenance', false) . '&section=vulnerabilities&sub-section=core' ?>" style="padding-left:0px">Core Vulnerabilities</a>
            <a class="nav-tab upkepr-sub-nav-tab <? //= ($subsection == 'plugin') ? 'nav-tab-active' : '' 
                                                    ?>" href="<? //= menu_page_url('upkepr-Maintenance', false) . '&section=vulnerabilities&sub-section=plugin' 
                                                                ?>">Plugin Vulnerabilities</a>
            <a class="nav-tab upkepr-sub-nav-tab <? //= ($subsection == 'theme') ? 'nav-tab-active' : '' 
                                                    ?>" href="<? //= menu_page_url('upkepr-Maintenance', false) . '&section=vulnerabilities&sub-section=theme' 
                                                                ?>">Theme Vulnerabilities </a>
            <a class="nav-tab upkepr-sub-nav-tab <? //= ($subsection == 'all') ? 'nav-tab-active' : '' 
                                                    ?>" href="<? //= menu_page_url('upkepr-Maintenance', false) . '&section=vulnerabilities&sub-section=all' 
                                                                ?>">All Vulnerabilities </a>
        </h2> -->
        <p class="upkpr-success " style=" text-align: center; font-size: 15px; color: #6f746f;display: none;"></p>
        <p class="upkpr-errors errors error" style=" text-align: center; font-size: 15px;display: none;"></p>
        <?php
        if ($subsection == 'core') :
            $coreVulnebility = get_option('upkpr_vulnerability_' . strtolower($subsection));
        ?>
            <div class="vulnerability_section">
                <?= UPKPRRenderVulnerabiliy(strtolower('core'), $coreVulnebility) ?>
            </div>

        <?php elseif ($subsection == 'theme') :
            $themeVulnebility = get_option('upkpr_vulnerability_' . strtolower($subsection));

        ?>
           
            <!--  <a href="javascript:void(0)" class="usButton upkpr_scannow_refresh" onclick="UPKPR_check_connection('theme',this)"> Refresh Data </a> -->
            <div class="vulnerability_section">
                <?= UPKPRRenderVulnerabiliy(strtolower('theme'), $themeVulnebility) ?>
            </div>

        <?php elseif ($subsection == 'plugin') :
            $pluginVulnebility = get_option('upkpr_vulnerability_' . strtolower($subsection));
        ?>

           
            <!--<a href="javascript:void(0)" class="usButton upkpr_scannow_refresh" onclick="UPKPR_check_connection('plugin',this)">Refresh Data </a> -->
            <div class="vulnerability_section">
                <?= UPKPRRenderVulnerabiliy(strtolower('plugin'), $pluginVulnebility) ?>
            </div>

        <?php elseif ($subsection == 'all') :
            $pluginVulnebility = get_option('upkpr_vulnerability_' . strtolower($subsection));
        ?>

            
            <!--<a href="javascript:void(0)" class="usButton upkpr_scannow_refresh" onclick="UPKPR_check_connection('plugin',this)">Refresh Data </a> -->
            <div class="vulnerability_section">
                <?= UPKPRRenderVulnerabiliy(strtolower('all'), $pluginVulnebility) ?>
            </div>
        <?php else : ?>
            <p>Status 404, Page not found.</p>
        <?php endif; ?>

    <?php endif; ?>

    <section class="plan-and-connection">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-md-6">
                    <div class="plan-connetion-inner plans-inner">
                        <?php $plandetails = !empty($isConnected) ? json_decode($isConnected) : '' ?>
                        <h2 class="plugin-heading">Your plans</span></h2>

                        <?php if (isset($plandetails->plan) && $plandetails->plan != 'upgraded') : ?>
                            <p>Currently you are on FREE Plan, Power up your plan for more features</p>
                        <?php elseif (isset($plandetails->plan) && $plandetails->plan == 'upgraded') : ?>
                            <p>Currently you are on <?= $plandetails->plan_name ?> paid plan.</p>
                        <?php else : ?>
                            <p>Want to power up your Upkepr?</p>
                        <?php endif; ?>

                        <div class="b-tns">
                            <a href="https://app.upkepr.com/checkpayment" target="_blank" class="bg-btn">View Plan</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="plan-connetion-inner Connection-inner">
                        <div class="site-connected-heading">
                            <h2 class="plugin-heading">Connection</h2>
                            <div class="site-connected">
                               <!--  <span class="connetion-site-logo"><img src="<?//php echo esc_html(UPKPR_UPKEPR_WS_PATH1); ?>images/small-logo.png" /></span>
                                <span class="site-connected-line"></span>
                                <span class="connetion-cms-logo"> <img src="<?//php echo esc_html(UPKPR_UPKEPR_WS_PATH1); ?>images/wordpress.png" /></span> -->
                            </div>
                        </div>
                        <p>This will connect your site to Upkepr.</p>
                        <div class="b-tns">
                            <!--  <a href="#" class="bg-btn">Learn More</a> -->
                            <?php if (empty($isConnected)) : ?>
                                <a href="javascript:void(0);" onclick="UPKPR_check_user('check',this)" class="upkprConnect brdr-btn">Connect</a>
                            <?php endif; ?>
                        </div>
                    <div class="connect-list-outer">
                        <?php if (!empty($isConnected)) :
                            $responseData=json_decode($isConnected);
                            ?>
                            <div class="list">
                                <span class="connect-list-icon"></span>
                                <p>Site is added on upkepr</p>
                            </div>
                            <div class="list">
                            <span class="connect-list-icon"></span>
                                <p>Key is connected </p>
                            </div>
                            <div class="list">
                            <span class="connect-list-icon"></span>
                                <p>Last scan on <?= date('d F, Y H:i:s', strtotime($responseData->created_at)); ?></p>
                            </div>
                        <?php else: ?>
                            <span class="upkprLoadListToCheckConnected" style="display: none;">
                                
                            </span>
                        <?php endif; ?>
                    </div>
                    </div>
                </div>
            </div>
        </div>
</section>

<footer>
    <div class="container">
        <div class="row justify-content-between">
            <div class="col-md-8">
                <ul>
                    <li><a href="https://upkepr.com/" target="_blank" title="Upkepr"><img src="<?php echo esc_html(UPKPR_UPKEPR_WS_PATH1); ?>images/logo.png" /></a></li>
                    <li><a href="https://upkepr.com/about/" target="_blank">About</a></li>
                    <li><a href="https://upkepr.com/terms-and-conditions/" target="_blank">Privacy Policy & Terms</a></li>
                   
                </ul>
            </div>
            <div class="col-md-4 text-end">
                <a href="https://upkepr.com/"  target="_blank" class="by-webgarh">By Upkepr</a>
            </div>
        </div>
    </div>
</footer>


</div>
<div id="upkpr-Modal" class="upkpr-modal connect-popup">
    <div class="upkpr-modal-content signup-more-details-popup">
        <span class="upkpr-close">&times;</span>
        <div class="header">
            <h2> Connect with <span class="highlight">Upkepr </span></h2>
        </div>
        <p class="upkpr-errors errors error" style=" text-align: center; font-size: 15px;display: none;"></p>
        <p class="upkpr-success " style=" text-align: center; font-size: 15px; color: #6f746f;display: none;"></p>
        <div class="stepper-wrapper">
            <div class="stepper-item step1">
                <div class="step-counter">1</div>
                <div class="step-name">Add website to Upkepr</div>
            </div>
            <div class="stepper-item step2">
                <div class="step-counter">2</div>
                <div class="step-name">Configure key on upkepr</div>
            </div>
            <div class="stepper-item step3">
                <div class="step-counter">3</div>
                <div class="step-name">Scan to fetch website details</div>
            </div>
        </div>
        <div id="upkepr-loader-2"></div>
        <div class="key-configration-input step2-key" style="display: none;">
                <input type="text" id="upkepr_maintainance_validationkey" value="<?php if (isset($_upkepr_maintainance_validationkey)) {
                                                                        echo esc_html($_upkepr_maintainance_validationkey);
                                                                    } ?>" readonly>
                <i alt="upkepr" onclick="UPKPR_copykey()" class="fa-solid fa-copy"></i>
                </div>
        <p class="model-body"></p>
        <div class="addButton">
            <a href="https://app.upkepr.com/register" class="usButton primary-btn registerButton" target="_blank"><i class="fa-solid fa-lock"></i> Login to Upkepr </a>
        </div>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var accToggles = document.querySelectorAll('.upkpr-accordion-togglere');
        accToggles.forEach(function(toggle) {
            toggle.addEventListener('click', function() {
                this.classList.toggle('active');
                var content = this.closest('tr').nextElementSibling;
                if (content.style.display === "none") {
                    content.style.display = "";
                } else {
                    content.style.display = "none";
                }
            });
        });
    });
</script>